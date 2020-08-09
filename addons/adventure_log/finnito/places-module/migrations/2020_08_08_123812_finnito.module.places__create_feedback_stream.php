<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class FinnitoModulePlacesCreateFeedbackStream extends Migration
{
    
    protected $fields = [
        'title' => 'anomaly.field_type.text',
        'description' => [
            "type" => 'anomaly.field_type.textarea',
            "config" => [
                "max" => 1000
            ]
        ],
    ];

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
        'slug' => 'feedback',
        'title_column' => 'title',
        'translatable' => false,
        'versionable' => false,
        'trashable' => false,
        'searchable' => false,
        'sortable' => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title' => [
            "required" => true,
        ],
        'description' => [
            'required' => true,
        ],
    ];

}
