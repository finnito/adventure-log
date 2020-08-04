<?php namespace Anomaly\SystemModule\Telescope\Command;

use Laravel\Telescope\Storage\EntryModel;
use Laravel\Telescope\Telescope;

/**
 * Class ConfigureTelescope
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigureTelescope
{

    /**
     * Handle the command.
     */
    public function handle()
    {

        /**
         * Check if monitoring is enabled at all.
         */
        if (!config('anomaly.module.system::telescope.enabled', false)) {
            return;
        }

        /**
         * Check if disabled for control panel.
         */
        if (!config('anomaly.module.system::telescope.admin_enabled', false) && request()->is('admin*')) {
            return;
        }

        /**
         * Never track within the
         * System Module itself.
         */
        if (request()->is('admin/system*')) {
            return;
        }

        /**
         * Check if system has been left on
         * and unattended or is being flooded.
         */
        $count = cache()->remember(
            'anomaly.module.system::telescope.count',
            5,
            function () {
                return EntryModel::count();
            }
        );

        if ($count >= config('anomaly.module.system::telescope.max_entries', 10000)) {

            // @todo maybe add a flash message here if within System module

            return;
        }

        /**
         * Loop over and configure.
         */
        $watchers = config('anomaly.module.system::telescope.watchers', []);
        $enabled  = config('anomaly.module.system::telescope.enabled_watchers', []);

        foreach ($watchers as $watcher => $config) {

            $status = in_array($watcher, $enabled);

            config(
                [
                    $config['key']                                                 => $status,
                    "anomaly.module.system::telescope.watchers.{$watcher}.enabled" => $status,
                ]
            );
        }

        // Disable this one completely for now.
        config(['telescope.watchers.Laravel\Telescope\Watchers\GateWatcher.enabled' => false]);

        Telescope::start(app());

        Telescope::listenForStorageOpportunities(app());
    }
}
