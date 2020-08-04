<?php

return [
    'telescope_enabled' => [
        'env'  => 'TELESCOPE_ENABLED',
        'type' => 'anomaly.field_type.boolean',
        'bind' => 'anomaly.module.system::telescope.enabled',
    ],
    'admin_enabled'     => [
        'env'  => 'TELESCOPE_ADMIN_ENABLED',
        'type' => 'anomaly.field_type.boolean',
        'bind' => 'anomaly.module.system::telescope.admin_enabled',
    ],
    'ignore_paths'      => [
        'bind' => 'anomaly.module.system::telescope.ignore_paths',
        'type' => 'anomaly.field_type.textarea',
    ],
    'enabled_watchers'  => [
        'type'   => 'anomaly.field_type.checkboxes',
        'env'    => env('TELESCOPE_ENABLED_WATCHERS'),
        'bind'   => 'anomaly.module.system::telescope.enabled_watchers',
        'config' => [
            'mode'    => 'tags',
            'handler' => \Anomaly\SystemModule\Telescope\Support\CheckboxesFieldType\EnabledWatchersOptions::class,
        ],
    ],
    'max_entries'       => [
        'type'   => 'anomaly.field_type.integer',
        'env'    => env('TELESCOPE_MAX_ENTRIES'),
        'bind'   => 'anomaly.module.system::telescope.max_entries',
        'config' => [
            'default_value' => config('anomaly.module.system::telescope.max_entries', 10000),
        ],
    ],
];
