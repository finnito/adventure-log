<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class MailTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MailTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.content.mailable'           => [
            'heading' => 'Mailable',
        ],
        'entry.content.to|keys|join(", ")' => [
            'heading' => 'Recipients',
        ],
        'entry.created_at.diffForHumans()' => [
            'heading' => 'Happened',
        ],
    ];
}
