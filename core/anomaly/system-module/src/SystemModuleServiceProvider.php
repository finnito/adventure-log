<?php namespace Anomaly\SystemModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\SystemModule\Telescope\Command\ConfigureTelescope;
use Laravel\Telescope\Console\ClearCommand;
use Laravel\Telescope\Console\PruneCommand;
use Laravel\Telescope\Contracts\ClearableRepository;
use Laravel\Telescope\Contracts\EntriesRepository;
use Laravel\Telescope\Contracts\PrunableRepository;
use Laravel\Telescope\Storage\DatabaseEntriesRepository;

/**
 * Class SystemModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SystemModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon commands.
     *
     * @var array
     */
    protected $commands = [
        ClearCommand::class,
        PruneCommand::class,
    ];

    /**
     * The scheduled commands.
     *
     * @var array
     */
    protected $schedules = [
        'daily' => [
            PruneCommand::class,
        ],
    ];

    /**
     * The addon routes.
     *
     * @type array|null
     */
    protected $routes = [
        'admin/system/{type?}'          => 'Anomaly\SystemModule\Http\Controller\Admin\TelescopeController@index',
        'admin/system/{type}/toggle'    => 'Anomaly\SystemModule\Http\Controller\Admin\TelescopeController@toggle',
        'admin/system/{type}/view/{id}' => 'Anomaly\SystemModule\Http\Controller\Admin\TelescopeController@view',
    ];

    /**
     * Register the addon.
     */
    public function register()
    {
        config(['telescope' => require base_path('vendor/laravel/telescope/config/telescope.php')]);

        $this->app->singleton(
            EntriesRepository::class,
            DatabaseEntriesRepository::class
        );

        $this->app->singleton(
            ClearableRepository::class,
            DatabaseEntriesRepository::class
        );

        $this->app->singleton(
            PrunableRepository::class,
            DatabaseEntriesRepository::class
        );

        $this->app->when(DatabaseEntriesRepository::class)
            ->needs('$connection')
            ->give(config('telescope.storage.database.connection'));
    }

    /**
     * Boot the addon.
     */
    public function boot()
    {
        dispatch_now(new ConfigureTelescope());
    }

}
