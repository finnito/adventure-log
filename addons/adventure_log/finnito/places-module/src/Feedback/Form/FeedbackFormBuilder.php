<?php namespace Finnito\PlacesModule\Feedback\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class FeedbackFormBuilder extends FormBuilder
{

    protected $handler = \Finnito\PlacesModule\Feedback\Form\FeedbackFormHandler::class;

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [
        "*",
        "honeypot" => [
            "type" => "fritzandandre.field_type.honeypot",
        ],
    ];

    /**
     * Additional validation rules.
     *
     * @var array|string
     */
    protected $rules = [];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [
        "save",
    ];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [];

}
