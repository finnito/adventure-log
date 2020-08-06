<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class FinnitoModulePlacesCreateLogsStream extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'logs',
        'title_column' => 'log',
        'translatable' => false,
        'versionable' => false,
        'trashable' => true,
        'searchable' => true,
        'sortable' => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        "related_hut" => [
            "required" => true
        ],
        'log_date' => [
            "required" => true
        ],
        'log' => [
            "required" => true
        ],
        'name' => [
            'required' => false,
        ],
    ];

}
