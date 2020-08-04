<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class CacheTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table columns.
     *
     * @var string|array
     */
    protected $columns = CacheTableColumns::class;

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'view',
    ];
}
