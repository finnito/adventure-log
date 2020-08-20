<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class FinnitoModulePlacesAddPlaceTypeField extends Migration
{

    protected $fields = [
        "place_type" => "anomaly.field_type.text",
    ];

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'places',
        'title_column' => 'name',
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
        "place_type",
    ];
}
