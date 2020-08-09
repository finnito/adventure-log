<?php namespace Finnito\PlacesModule\Feedback\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class FeedbackTableBuilder extends TableBuilder
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
    protected $filters = [];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        "feedback" => [
            "heading" => "Feedback",
            "wrapper" => "<p><strong>{entry.title}</strong> <small>{entry.created_at}</small><br>{entry.description}</p>"
        ]
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [];

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
    protected $options = [
        'order_by' => ['created_at' => 'desc']
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}
