<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class LogTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LogTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = LogTableColumns::class;

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'view',
    ];
}
