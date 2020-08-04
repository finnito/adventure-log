<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class CommandTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CommandTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.content.command'            => [
            'heading' => 'Command',
        ],
        'entry.content.exit_code'          => [
            'heading' => 'Exit Code',
        ],
        'entry.created_at.diffForHumans()' => [
            'heading' => 'Happened',
        ],
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'view',
    ];
}
