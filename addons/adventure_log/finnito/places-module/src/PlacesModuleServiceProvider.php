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
     * Additional addon plugins.
     *
     * @type array|null
     */
    protected $plugins = [];

    /**
     * The addon Artisan commands.
     *
     * @type array|null
     */
    protected $commands = [];

    /**
     * The addon's scheduled commands.
     *
     * @type array|null
     */
    protected $schedules = [];

    /**
     * The addon API routes.
     *
     * @type array|null
     */
    protected $api = [];

    /**
     * The addon routes.
     *
     * @type array|null
     */
    protected $routes = [
        'admin/places/feedback'           => 'Finnito\PlacesModule\Http\Controller\Admin\FeedbackController@index',
        'admin/places/feedback/create'    => 'Finnito\PlacesModule\Http\Controller\Admin\FeedbackController@create',
        'admin/places/feedback/edit/{id}' => 'Finnito\PlacesModule\Http\Controller\Admin\FeedbackController@edit',
        'admin/places/logs'           => 'Finnito\PlacesModule\Http\Controller\Admin\LogsController@index',
        'admin/places/logs/create'    => 'Finnito\PlacesModule\Http\Controller\Admin\LogsController@create',
        'admin/places/logs/edit/{id}' => 'Finnito\PlacesModule\Http\Controller\Admin\LogsController@edit',
        'admin/places'           => 'Finnito\PlacesModule\Http\Controller\Admin\PlacesController@index',
        'admin/places/create'    => 'Finnito\PlacesModule\Http\Controller\Admin\PlacesController@create',
        'admin/places/edit/{id}' => 'Finnito\PlacesModule\Http\Controller\Admin\PlacesController@edit',
        '/places/search/'         => 'Finnito\PlacesModule\Http\Controller\SearchController@search',
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
    ];

    /**
     * The addon middleware.
     *
     * @type array|null
     */
    protected $middleware = [
        //Finnito\PlacesModule\Http\Middleware\ExampleMiddleware::class
    ];

    /**
     * Addon group middleware.
     *
     * @var array
     */
    protected $groupMiddleware = [
        //'web' => [
        //    Finnito\PlacesModule\Http\Middleware\ExampleMiddleware::class,
        //],
    ];

    /**
     * Addon route middleware.
     *
     * @type array|null
     */
    protected $routeMiddleware = [];

    /**
     * The addon event listeners.
     *
     * @type array|null
     */
    protected $listeners = [
        //Finnito\PlacesModule\Event\ExampleEvent::class => [
        //    Finnito\PlacesModule\Listener\ExampleListener::class,
        //],
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

    /**
     * Additional service providers.
     *
     * @type array|null
     */
    protected $providers = [
        //\ExamplePackage\Provider\ExampleProvider::class
    ];

    /**
     * The addon view overrides.
     *
     * @type array|null
     */
    protected $overrides = [
        //'streams::errors/404' => 'module::errors/404',
        //'streams::errors/500' => 'module::errors/500',
    ];

    /**
     * The addon mobile-only view overrides.
     *
     * @type array|null
     */
    protected $mobile = [
        //'streams::errors/404' => 'module::mobile/errors/404',
        //'streams::errors/500' => 'module::mobile/errors/500',
    ];

    /**
     * Register the addon.
     */
    public function register()
    {
        // Run extra pre-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Boot the addon.
     */
    public function boot()
    {
        // Run extra post-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Map additional addon routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Register dynamic routes here for example.
        // Use method injection or commands to bring in services.
    }

}
