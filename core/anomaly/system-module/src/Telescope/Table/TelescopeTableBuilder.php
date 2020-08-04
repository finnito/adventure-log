<?php namespace Anomaly\SystemModule\Telescope\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Anomaly\SystemModule\Entry\EntryModel;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class TelescopeTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TelescopeTableBuilder extends TableBuilder
{

    /**
     * The type of Telescope
     * data to access.
     *
     * @var null|string
     */
    protected $type = null;

    /**
     * The entry model.
     *
     * @var string
     */
    protected $model = EntryModel::class;

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'search' => [
            'columns' => [
                'content',
            ],
        ],
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'view',
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $actions = [
        'delete',
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'order_by' => [
            'created_at' => 'DESC',
        ],
    ];

    /**
     * Fired when ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getType()) {
            throw new \Exception('The $type parameter is required when displaying Telescope data.');
        }

        if (!$this->getColumns()) {
            $this->setColumns(
                config(
                    'anomaly.module.system::telescope.' . $this->getType() . '.table.columns',
                    ['entry.id', '{{ entry|json_encode }}']
                )
            );
        }
    }

    /**
     * Fired just before querying.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        $query->where('type', str_singular($this->getType()));
    }

    /**
     * Get the data type.
     *
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

}
