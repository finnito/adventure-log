<?php namespace Fritzandandre\HoneypotFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Fritzandandre\HoneypotFieldType\Validation\ValidateHoneyPot;
use Illuminate\Http\Request;

/**
 * Class HoneypotFieldType
 *
 * @link    http://fritzandandre.com
 * @author  Brennon Loveless <brennon@fritzandandre.com>
 * @package Fritzandandre\HoneypotFieldType
 */
class HoneypotFieldType extends FieldType
{

    protected $columnType = null;

    protected $rules = [
        'must_be_empty'
    ];

    protected $validators = [
        'must_be_empty' => [
            'message' => 'fritzandandre.field_type.honeypot::message.no_bots_allowed',
            'handler' => ValidateHoneyPot::class
        ]
    ];

    public function __construct(Request $request)
    {
        /**
         * If this request is not in the admin then we will use our custom views which hide the field from the user.
         */
        if ($request->segment(1) != 'admin') {
            $this->inputView   = 'fritzandandre.field_type.honeypot::input';
            $this->wrapperView = 'fritzandandre.field_type.honeypot::wrapper';
        }
    }

    /**
     * When the field is being saved it will both add itself to the skips array and remove itself from the builder form.
     *
     * @param FormBuilder $builder
     */
    public function onFormSaving(FormBuilder $builder)
    {
        $skips = $builder->getSkips();

        if(!in_array($this->getField(), $skips)) {
            $skips[] = $this->getField();
            $builder->getForm()->removeField($this->getField());
        }

        $builder->setSkips($skips);
    }
}
