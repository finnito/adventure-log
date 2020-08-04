<?php namespace Anomaly\SitemapExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\EloquentRepository;
use Laravelium\Sitemap\SitemapServiceProvider;

/**
 * Class SitemapExtensionServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SitemapExtensionServiceProvider extends AddonServiceProvider
{

    /**
     * The addon providers.
     *
     * @var array
     */
    protected $providers = [
        SitemapServiceProvider::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'sitemap.xml'                => 'Anomaly\SitemapExtension\Http\Controller\SitemapController@index',
        'sitemap/{addon}/{file}.xml' => 'Anomaly\SitemapExtension\Http\Controller\SitemapController@view',
    ];


    /**
     * Register the addon.
     *
     * @param EloquentRepository $repository
     */
    public function register(EloquentRepository $repository)
    {
        $repository->bind(
            'sitemap',
            function () {

                /* @var EloquentRepository $this */
                return $this->model->newQuery();
            }
        );

        $repository->bind(
            'get_sitemap',
            function () {

                /* @var EloquentRepository $this */
                return $this->call('sitemap')->get();
            }
        );
    }

}
