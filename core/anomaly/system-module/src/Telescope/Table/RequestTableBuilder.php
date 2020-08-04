<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class RequestTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RequestTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'view',
    ];

    /**
     * The table columns.
     *
     * @var string
     */
    protected $columns = RequestTableColumns::class;
}
