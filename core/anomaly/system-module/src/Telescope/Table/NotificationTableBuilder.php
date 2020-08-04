<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class NotificationTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class NotificationTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.content.notification' => [
            'heading' => 'Notification',
        ],
        'entry.content.channel' => [
            'heading' => 'Channel',
        ],
        'entry.created_at.diffForHumans()' => [
            'heading' => 'Happened',
        ],
    ];
}
