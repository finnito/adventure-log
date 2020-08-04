<?php

return [
    'system'     => [
        'fields' => [
            'telescope_enabled',
            'admin_enabled',
            'ignore_paths',
            'enabled_watchers',
            'max_entries',
        ],
    ],
    'monitoring' => [
        'stacked' => true,
        'tabs'    => [
            'requests'      => [
                'title'  => 'anomaly.module.system::tab.requests',
                'fields' => [
                    'requests_ignore_paths',
                    'requests_include_paths',
                ],
            ],
            'commands'      => [
                'title'  => 'anomaly.module.system::tab.commands',
                'fields' => [
                    'commands_enabled',
                ],
            ],
            'schedule'      => [
                'title'  => 'anomaly.module.system::tab.schedule',
                'fields' => [
                    'schedule_enabled',
                ],
            ],
            'jobs'          => [
                'title'  => 'anomaly.module.system::tab.jobs',
                'fields' => [
                    'jobs_enabled',
                ],
            ],
            'exceptions'    => [
                'title'  => 'anomaly.module.system::tab.exceptions',
                'fields' => [
                    'exceptions_enabled',
                ],
            ],
            'logs'          => [
                'title'  => 'anomaly.module.system::tab.logs',
                'fields' => [
                    'logs_enabled',
                ],
            ],
            'dumps'         => [
                'title'  => 'anomaly.module.system::tab.dumps',
                'fields' => [
                    'dumps_enabled',
                ],
            ],
            'queries'       => [
                'title'  => 'anomaly.module.system::tab.queries',
                'fields' => [
                    'queries_enabled',
                ],
            ],
            'models'        => [
                'title'  => 'anomaly.module.system::tab.models',
                'fields' => [
                    'models_enabled',
                ],
            ],
            'events'        => [
                'title'  => 'anomaly.module.system::tab.events',
                'fields' => [
                    'events_enabled',
                ],
            ],
            'mail'          => [
                'title'  => 'anomaly.module.system::tab.mail',
                'fields' => [
                    'mail_enabled',
                ],
            ],
            'notifications' => [
                'title'  => 'anomaly.module.system::tab.notifications',
                'fields' => [
                    'notifications_enabled',
                ],
            ],
            'cache'         => [
                'title'  => 'anomaly.module.system::tab.cache',
                'fields' => [
                    'cache_enabled',
                ],
            ],
//            'redis'         => [
//                'title'  => 'anomaly.module.system::tab.redis',
//                'fields' => [
//                    'redis_enabled',
//                ],
//            ],
        ],
    ],
];
