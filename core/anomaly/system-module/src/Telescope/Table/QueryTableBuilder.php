<?php namespace Anomaly\SystemModule\Telescope\Table;

/**
 * Class QueryTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class QueryTableBuilder extends TelescopeTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'query' => [
            'heading' => 'Query',
            'wrapper' => '
                {value.query}
                <br>
                <small class="text-muted">
                    Executed at {value.time} in {value.duration} ms ({value.ago})
                </small>',
            'value'   => [
                'query'    => 'entry.content.sql',
                'duration' => 'entry.content.time',
                'time'     => 'entry.created_at',
                'ago'      => 'entry.created_at.diffForHumans()',
            ],
        ],
    ];
}
