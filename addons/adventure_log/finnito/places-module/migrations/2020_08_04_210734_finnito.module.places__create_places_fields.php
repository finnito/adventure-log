<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class FinnitoModulePlacesCreatePlacesFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'name' => 'anomaly.field_type.text',
        'slug' => [
            'type' => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
                'type' => '-'
            ],
        ],
        "fid" => [
            "type" => "anomaly.field_type.integer",
            "config" => [
                "separator" => null
            ]
        ],
        'place' => 'anomaly.field_type.text',
        'region' => 'anomaly.field_type.text',
        'facilities' => 'anomaly.field_type.text',
        'static_link' => 'anomaly.field_type.text',
        "asset_id" => [
            "type" => "anomaly.field_type.integer",
            "config" => [
                "separator" => ""
            ]
        ],
        'date_loaded_to_gis' => 'anomaly.field_type.text',
        'latitude' => 'anomaly.field_type.text',
        'longitude' => 'anomaly.field_type.text',
        'thumbnail' => 'anomaly.field_type.text',
    ];

}
