<?php namespace Anomaly\SystemModule\Telescope\Table;

use Laravel\Telescope\Storage\EntryModel;

/**
 * Class RequestTableColumns
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RequestTableColumns
{

    /**
     * Handle the columns.
     *
     * @param RequestTableBuilder $builder
     */
    public function handle(RequestTableBuilder $builder)
    {
        $builder->setColumns(
            [
                'entry.content.method'             => [
                    'heading' => 'Verb',
                    'wrapper' => function (EntryModel $entry) {

                        $context = 'default';

                        if ($entry->content['method'] == 'POST') {
                            $context = 'info';
                        }

                        if ($entry->content['method'] == 'DELETE') {
                            $context = 'danger';
                        }

                        if (in_array($entry->content['method'], ['PUT', 'PATCH'])) {
                            $context = 'warning';
                        }

                        return '<span class="tag tag-' . $context . '">{value}</span>';
                    },
                ],
                'entry.content.uri'                => [
                    'heading' => 'Path',
                ],
                'entry.content.response_status'    => [
                    'heading' => 'Status',
                    'wrapper' => function (EntryModel $entry) {

                        $context = 'default';

                        if (substr($entry->content['response_status'], 0, 1) == 3) {
                            $context = 'info';
                        }

                        if (substr($entry->content['response_status'], 0, 1) == 4) {
                            $context = 'warning';
                        }

                        if (substr($entry->content['response_status'], 0, 1) == 5) {
                            $context = 'danger';
                        }

                        return '<span class="tag tag-' . $context . '">{value}</span>';
                    },
                ],
                'entry.content.duration'           => [
                    'heading' => 'Duration',
                    'wrapper' => '{value}ms',
                ],
                'entry.created_at.diffForHumans()' => [
                    'heading' => 'Happened',
                ],
            ]
        );
    }
}
