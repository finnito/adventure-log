<?php namespace Anomaly\SystemModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class CacheController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheController extends AdminController
{

    /**
     * Clear the cache.
     */
    public function clear()
    {
        cache()->clear();

        return $this->redirect->back();
    }
}
