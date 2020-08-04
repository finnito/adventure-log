<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class JobsTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class JobsTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.content.name'               => [
            'heading' => 'Job',
            'wrapper' => '
                        {value.name}
                        <br>
                        <small class="text-muted">Connection: {value.connection} | Queue: {value.queue}</small>
                    ',
            'value'   => [
                'name'       => 'entry.content.name',
                'queue'      => 'entry.content.queue',
                'connection' => 'entry.content.connection',
            ],
        ],
        'entry.content.status'             => [
            'heading' => 'Status',
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
