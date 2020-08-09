<?php namespace Finnito\PlacesModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class PlacesModule extends Module
{

    /**
     * The navigation display flag.
     *
     * @var bool
     */
    protected $navigation = true;

    /**
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-map-marker';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'places' => [
            'buttons' => [
                'new_place',
            ],
        ],
        'logs' => [
            'buttons' => [
                'new_log',
            ],
        ],
        'feedback' => [
            'buttons' => [
                'new_feedback',
            ],
        ],
    ];

}
