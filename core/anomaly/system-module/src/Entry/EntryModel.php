<?php namespace Anomaly\SystemModule\Entry;

/**
 * Class EntryModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryModel extends \Laravel\Telescope\Storage\EntryModel
{

    /**
     * Return the model as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        $array['id'] = $this->getId();

        return $array;
    }


    /**
     * Return the ID (uuid).
     *
     * @return string
     */
    public function getId()
    {
        return $this->getKey();
    }
}
