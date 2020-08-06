<?php namespace Finnito\PlacesModule\Place\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class PlaceTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        "name" => [
            "heading" => "Name",
            "wrapper" => "<a href='/{entry.slug}'>{entry.name}</a><br><small>{entry.place} ({entry.latitude},{entry.longitude})</small>"
        ]
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'Open' => [
            'href' => '/{entry.place_slug}/{entry.name_slug}/',
            'text' => 'View',
            'icon' => 'folder-open',
            'type' => 'success',
        ],
        'TopoMap' => [
            'href' => 'http://www.topomap.co.nz/NZTopoMap?v=2&ll={entry.longitude},{entry.latitude}&z=14',
            'text' => 'TopoMap',
            'icon' => 'map-marker',
            'type' => 'success',
        ],
        'edit'
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}
