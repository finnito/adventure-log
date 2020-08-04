<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class ExceptionTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ExceptionTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.content.name'               => [
            'heading' => 'Exception',
            'wrapper' => '
                        {value.class}
                        <br>
                        <small class="text-muted">{value.message}</small>
                    ',
            'value'   => [
                'class'   => 'entry.content.class',
                'message' => 'entry.content.message',
            ],
        ],
        'entry.content.occurrences'        => [
            'heading' => 'Occurrences',
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
