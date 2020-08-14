<?php namespace Finnito\PlacesModule\Log\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class LogTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [
        "is_reviewed",
        "is_flagged",
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        "is_flagged" => [
            "heading" => "🔶"
        ],
        "is_reviewed" => [
            "heading" => "👁"
        ],
        "related_hut",
        "log",
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit',
        "review" => [
            'text' => 'Review',
        ],
        "unflag" => [
            "text" => "Un-Flag",
        ],
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}
