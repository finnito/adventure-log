<?php

namespace Anomaly\SitemapExtension\Http\Controller;

use Anomaly\SitemapExtension\Event\BuildSitemap;
use Anomaly\SitemapExtension\Event\GatherSitemaps;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Command\GetAddon;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Traits\Hookable;
use Laravelium\Sitemap\Sitemap;

/**
 * Class SitemapController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SitemapController extends PublicController
{

    /**
     * Return an index of sitemaps.
     *
     * @param AddonCollection $addons
     * @param Sitemap $sitemap
     * @return string
     */
    public function index(AddonCollection $addons, Sitemap $sitemap)
    {
        /* @var Addon $addon */
        foreach ($addons->withConfig('sitemap')->forget(['anomaly.extension.sitemap']) as $addon) {

            /* @var Module|Extension $addon */
            if (in_array($addon->getType(), ['module', 'extension']) && !$addon->isEnabled()) {
                continue;
            }

            /**
             * Loop over the various
             * sitemaps for this addon.
             */
            foreach (config($addon->getNamespace('sitemap')) as $file => $configuration) {

                if (is_string($configuration)) {
                    $configuration = [
                        'repository' => $configuration,
                    ];
                }

                if (isset($configuration['repository'])) {

                    $repository = array_get($configuration, 'repository');

                    if (is_string($repository) && (class_exists($repository) || interface_exists($repository))) {

                        /* @var EntryRepositoryInterface|Hookable $repository */
                        $repository = $this->container->make($repository);
                    }

                    if (is_callable($repository)) {

                        /* @var EntryRepositoryInterface|Hookable $repository */
                        $repository = app(Resolver::class)->resolve($repository);
                    }

                    if ($lastModifiedEntry = $repository->lastModified()) {
                        $lastModifiedTime = $lastModifiedEntry->lastModified() // Grabs Carbon
                        ->toAtomString(); // Returns String

                        $sitemap->addSitemap(
                            $this->url->to('sitemap/' . $addon->getNamespace() . '/' . $file . '.xml'),
                            $lastModifiedTime
                        );
                    }

                    continue;
                }

                if (isset($configuration['lastmod']) && is_callable($configuration['lastmod'])) {

                    $lastmod = app(Resolver::class)->resolve($configuration['lastmod']);

                    $sitemap->addSitemap(
                        $this->url->to('sitemap/' . $addon->getNamespace() . '/' . $file . '.xml'),
                        $lastmod
                    );

                    continue;
                }
            }
        }

        event(new GatherSitemaps($sitemap));

        return $this->response->make(
            $sitemap->generate('sitemapindex')['content'],
            200,
            [
                'Content-Type' => 'application/xml',
            ]
        );
    }

    /**
     * Return a sitemap.
     *
     * @param Sitemap $sitemap
     * @param $addon
     * @param $file
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function view(Sitemap $sitemap, $addon, $file)
    {
        $addon = $this->dispatchNow(new GetAddon($addon));

        $configuration = config($hint = $addon->getNamespace('sitemap.' . $file));

        if (is_string($configuration)) {
            $configuration = [
                'repository' => $configuration,
            ];
        }

        $repository = array_get($configuration, 'repository');

        if (is_string($repository) && (class_exists($repository) || interface_exists($repository))) {

            /* @var EntryRepositoryInterface|Hookable $repository */
            $repository = $this->container->make($repository);
        }

        if (is_callable($repository)) {

            /* @var EntryRepositoryInterface|Hookable $repository */
            $repository = app(Resolver::class)->resolve($repository);
        }

        // Cache TTL (1hr)
        $ttl = array_get($configuration, 'ttl', 60 * 60);

        /**
         * Cache everything using the repository.
         *
         * @var Sitemap
         */
        $sitemap = $repository->cache(
            md5($addon . $file),
            $ttl,
            function () use ($sitemap, $repository, $configuration) {

                /* @var EntryInterface $model */
                $model = $repository->getModel();

                /* @var StreamInterface $stream */
                $stream = $model->getStream();

                $translatable = $stream->isTranslatable();

                $locales = config('streams::locales.enabled');
                $default = config('streams::locales.default');

                $priority  = array_get($configuration, 'priority', 0.5);
                $frequency = array_get($configuration, 'frequency', 'weekly');
                $route     = array_get($configuration, 'route', 'view');

                /* @var EntryInterface $entry */
                foreach ($repository->call('get_sitemap') as $entry) {

                    $images       = []; // @todo Make this around hookable.
                    $translations = [];

                    $lastmod = $entry
                        ->lastModified()
                        ->toAtomString();

                    if ($translatable) {

                        foreach ($locales as $locale) {
                            if ($locale != $default) {

                                $translations[] = [
                                    'language' => $locale,
                                    'url'      => $entry->route($route),
                                ];
                            }
                        }
                    }

                    //            Default hook returns []
                    //            foreach ($entry->call('SOMETHING FOR IMAGES') as $image) {
                    //                <image:image>
                    //                  <image:loc>http://example.com/image.jpg</image:loc>
                    //                </image:image>
                    //            }

                    $url = url($entry->route($route) ?: '/');

                    if ($entry->hasHook('view_route')) {
                        $url = $entry->call('view_route', compact('entry'));
                    }

                    $sitemap->add(
                        $url,
                        $lastmod,
                        $priority,
                        $frequency,
                        $images,
                        null,
                        $translations
                    );
                }

                return $sitemap->generate('xml')['content'];
            }
        );

        if (gettype($sitemap) == 'object' && get_class($sitemap) == Sitemap::class) {
            event(new BuildSitemap($sitemap));
        }

        return $this->response->make(
            $sitemap,
            200,
            [
                'Content-Type' => 'application/xml',
            ]
        );
    }
}
