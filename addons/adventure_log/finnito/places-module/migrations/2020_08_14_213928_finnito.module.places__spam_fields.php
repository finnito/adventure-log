<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class FinnitoModulePlacesSpamFields extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;

    protected $fields = [
        "is_spam" => [
            "type"   => "anomaly.field_type.boolean",
            "config" => [
                "default_value" => false,
                "on_color"      => "danger",
                "off_color"     => "success",
                "on_text"       => "Yes",
                "off_text"      => "No",
                "mode"          => "checkbox",
            ]
        ],
        "is_reviewed" => [
            "type"   => "anomaly.field_type.boolean",
            "config" => [
                "default_value" => false,
                "on_color"      => "success",
                "off_color"     => "danger",
                "on_text"       => "Yes",
                "off_text"      => "No",
                "mode"          => "checkbox",
            ]
        ],
        "is_flagged" => [
            "type"   => "anomaly.field_type.boolean",
            "config" => [
                "default_value" => false,
                "on_color"      => "success",
                "off_color"     => "danger",
                "on_text"       => "Yes",
                "off_text"      => "No",
                "mode"          => "checkbox",
            ]
        ],
    ];

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'logs',
        'title_column' => 'name',
        'translatable' => true,
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
        "is_flagged",
        "is_reviewed",
        "is_spam",
    ];

}
