<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class DumpTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DumpTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'description' => [
            'heading' => 'Description',
            'wrapper' => '
                {value.type}: {value.description}
                <br>
                <small>Hash: {value.hash}</small>
                <br>
                <small class="text-muted">
                    {value.time} ({value.ago})
                </small>',
            'value'   => [
                'hash'        => '{{ md5(entry.content.entry_point_description) }}',
                'type'        => 'entry.content.entry_point_type|capitalize',
                'description' => 'entry.content.entry_point_description',
                'time'        => 'entry.created_at',
                'ago'         => 'entry.created_at.diffForHumans()',
            ],
        ],
    ];

    /**
     * The options array.
     *
     * @var array
     */
    protected $options = [
        'title'       => 'Please keep this window open.',
        'description' => 'The dump watcher tab must be open in a browser for recording to occur, otherwise the dumps will be ignored.',
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [
        'scripts.js' => [
            'anomaly.module.system::js/dumps.js',
        ],
    ];
}
