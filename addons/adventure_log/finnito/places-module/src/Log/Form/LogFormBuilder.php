<?php namespace Finnito\PlacesModule\Log\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use \nickurt\Akismet\Rules\AkismetRule;

class LogFormBuilder extends FormBuilder
{

    protected $handler = \Finnito\PlacesModule\Log\Form\LogFormHandler::class;

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
    protected $skips = [
        "related_hut",
        "is_flagged",
        "is_spam",
        "is_reviewed",
    ];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [
        "save"
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
