<?php namespace Finnito\PlacesModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Finnito\PlacesModule\Feedback\Contract\FeedbackRepositoryInterface;
use Finnito\PlacesModule\Feedback\FeedbackRepository;
use Anomaly\Streams\Platform\Model\Places\PlacesFeedbackEntryModel;
use Finnito\PlacesModule\Feedback\FeedbackModel;
use Finnito\PlacesModule\Log\Contract\LogRepositoryInterface;
use Finnito\PlacesModule\Log\LogRepository;
use Anomaly\Streams\Platform\Model\Places\PlacesLogsEntryModel;
use Finnito\PlacesModule\Log\LogModel;
use Finnito\PlacesModule\Place\Contract\PlaceRepositoryInterface;
use Finnito\PlacesModule\Place\PlaceRepository;
use Anomaly\Streams\Platform\Model\Places\PlacesPlacesEntryModel;
use Finnito\PlacesModule\Place\PlaceModel;
use Illuminate\Routing\Router;
use \Finnito\PlacesModule\Log\Form\LogFormBuilder;
use \Finnito\PlacesModule\Feedback\Form\FeedbackFormBuilder;

class PlacesModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @type array|null
     */
    protected $routes = [
        'admin/places/feedback'           => 'Finnito\PlacesModule\Http\Controller\Admin\FeedbackController@index',
        'admin/places/feedback/create'    => 'Finnito\PlacesModule\Http\Controller\Admin\FeedbackController@create',
        'admin/places/feedback/edit/{feedback_id}' => 'Finnito\PlacesModule\Http\Controller\Admin\FeedbackController@edit',
        'admin/places/logs'           => 'Finnito\PlacesModule\Http\Controller\Admin\LogsController@index',
        'admin/places/logs/create'    => 'Finnito\PlacesModule\Http\Controller\Admin\LogsController@create',
        'admin/places/logs/edit/{log_id}' => 'Finnito\PlacesModule\Http\Controller\Admin\LogsController@edit',
        'admin/places'           => 'Finnito\PlacesModule\Http\Controller\Admin\PlacesController@index',
        'admin/places/create'    => 'Finnito\PlacesModule\Http\Controller\Admin\PlacesController@create',
        'admin/places/edit/{place_id}' => 'Finnito\PlacesModule\Http\Controller\Admin\PlacesController@edit',
        '/places/search/'         => 'Finnito\PlacesModule\Http\Controller\SearchController@search',
        '/api/search/'         => 'Finnito\PlacesModule\Http\Controller\ApiController@search',
        '/feed.xml' => 'Finnito\PlacesModule\Http\Controller\FeedController@index',
        "/places/{place_slug}/feed.xml" => 'Finnito\PlacesModule\Http\Controller\FeedController@place',
        "/places/{place_slug}/{name_slug}/feed.xml" => 'Finnito\PlacesModule\Http\Controller\FeedController@hut',
        "/places/" => 'Finnito\PlacesModule\Http\Controller\PlaceController@index',
        "/places/{place_slug}/" => [
            "as" => "finnito.module.places::places.place",
            "uses" => 'Finnito\PlacesModule\Http\Controller\PlaceController@place',
        ],
        "/places/{place_slug}/{name_slug}/" => [
            'as' => 'finnito.module.places::places.hut',
            "uses" => 'Finnito\PlacesModule\Http\Controller\PlaceController@hut'
        ],
        "/feedback" => 'Finnito\PlacesModule\Http\Controller\FeedbackController@index',
        "/flag/log/{feedback_id}" => "Finnito\PlacesModule\Http\Controller\PlaceController@flagLog",
    ];

    /**
     * The addon alias bindings.
     *
     * @type array|null
     */
    protected $aliases = [
        'LogFormBuilder' => LogFormBuilder::class,
        'FeedbackFormBuilder' => FeedbackFormBuilder::class
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        PlacesFeedbackEntryModel::class => FeedbackModel::class,
        PlacesLogsEntryModel::class => LogModel::class,
        PlacesPlacesEntryModel::class => PlaceModel::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        FeedbackRepositoryInterface::class => FeedbackRepository::class,
        LogRepositoryInterface::class => LogRepository::class,
        PlaceRepositoryInterface::class => PlaceRepository::class,
    ];
}
