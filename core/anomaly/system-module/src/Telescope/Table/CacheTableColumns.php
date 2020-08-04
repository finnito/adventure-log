<?php namespace Anomaly\SystemModule\Telescope\Table;

use Laravel\Telescope\Storage\EntryModel;

/**
 * Class CacheTableColumns
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheTableColumns
{

    /**
     * Handle the columns.
     *
     * @param CacheTableBuilder $builder
     */
    public function handle(CacheTableBuilder $builder)
    {
        $builder->setColumns(
            [
                'message'            => [
                    'heading' => 'Key',
                    'wrapper' => '
                        {value.key}
                        <br>
                        <small class="text-muted">
                            {value.time} ({value.ago})
                        </small>',
                    'value'   => [
                        'key'  => 'entry.content.key',
                        'time' => 'entry.created_at',
                        'ago'  => 'entry.created_at.diffForHumans()',
                    ],
                ],
                'entry.content.type' => [
                    'heading' => 'Action',
                    'wrapper' => function (EntryModel $entry) {

                        $context = 'default';

                        if ($entry->content['type'] == 'forget') {
                            $context = 'danger';
                        }

                        if ($entry->content['type'] == 'set') {
                            $context = 'info';
                        }

                        if ($entry->content['type'] == 'missed') {
                            $context = 'warning';
                        }

                        return '<span class="tag tag-' . $context . '">{value}</span>';
                    },
                ],
            ]
        );
    }
}
