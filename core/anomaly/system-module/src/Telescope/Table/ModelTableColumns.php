<?php namespace Anomaly\SystemModule\Telescope\Table;

use Laravel\Telescope\Storage\EntryModel;

/**
 * Class ModelTableColumns
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ModelTableColumns
{

    /**
     * Handle the columns.
     *
     * @param ModelTableBuilder $builder
     */
    public function handle(ModelTableBuilder $builder)
    {
        $builder->setColumns(
            [
                'entry.content.model'              => [
                    'heading' => 'Model',
                ],
                'entry.content.action'             => [
                    'heading' => 'Action',
                    'wrapper' => function (EntryModel $entry) {

                        $context = 'default';

                        if (in_array($entry->content['action'], ['deleted', 'deletedMultiple'])) {
                            $context = 'danger';
                        }

                        if (in_array($entry->content['action'], ['updated', 'updatedMultiple'])) {
                            $context = 'info';
                        }

                        if (in_array($entry->content['action'], ['created'])) {
                            $context = 'success';
                        }

                        return '<span class="tag tag-' . $context . '">{value}</span>';
                    },
                ],
                'entry.created_at.diffForHumans()' => [
                    'heading' => 'Happened',
                ],
            ]
        );
    }
}
