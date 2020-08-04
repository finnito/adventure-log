<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class FinnitoModulePlacesCreatePlacesStream extends Migration
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
        'slug' => 'places',
        'title_column' => 'name',
        'translatable' => false,
        'versionable' => true,
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
        'name' => [
            'translatable' => true,
            'required' => true,
        ],
        'slug' => [
            'unique' => true,
            'required' => true,
        ],
        "fid",
        "place",
        "region",
        "facilities",
        "static_link",
        "asset_id",
        "date_loaded_to_gis",
        "latitude",
        "longitude",
        "thumbnail"
    ];

}
