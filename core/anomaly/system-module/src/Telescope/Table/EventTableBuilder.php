<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class EventTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EventTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'event'                            => [
            'heading' => 'Event',
            'wrapper' => '
                {value.name}
                <br>
                <small class="text-muted">
                    Dispatched at {value.time} ({value.ago})
                </small>',
            'value'   => [
                'name' => 'entry.content.name',
                'time' => 'entry.created_at',
                'ago'  => 'entry.created_at.diffForHumans()',
            ],
        ],
        'entry.content.listeners|length'   => [
            'heading' => 'Listeners',
        ],
    ];
}
