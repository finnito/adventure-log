<?php namespace Anomaly\SystemModule\Telescope\Support\CheckboxesFieldType;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;

/**
 * Class EnabledWatchersOptions
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EnabledWatchersOptions
{

    /**
     * Handle the options.
     *
     * @param CheckboxesFieldType $fieldType
     */
    public function handle(CheckboxesFieldType $fieldType)
    {
        $fieldType->setOptions(
            array_combine(
                $keys = array_keys(config('anomaly.module.system::telescope.watchers')),
                array_map(
                    function ($monitor) {
                        return trans("anomaly.module.system::tab.{$monitor}");
                    },
                    $keys
                )
            )
        );
    }
}
