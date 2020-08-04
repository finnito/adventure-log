<?php

namespace Anomaly\SitemapExtension\Event;

use Laravelium\Sitemap\Sitemap;

/**
 * Class GatherSitemaps
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GatherSitemaps
{

    /**
     * The sitemap instance.
     *
     * @var Sitemap
     */
    protected $sitemap;

    /**
     * Create a new class instance.
     *
     * @param Sitemap $sitemap
     */
    public function __construct(Sitemap $sitemap)
    {
        $this->sitemap = $sitemap;
    }

    /**
     * Get the sitemap.
     * 
     * @return Sitemap
     */
    public function getSitemap()
    {
        return $this->sitemap;
    }
}
