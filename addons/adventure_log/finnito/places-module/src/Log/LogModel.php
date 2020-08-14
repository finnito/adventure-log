<?php namespace Finnito\PlacesModule\Log;

use Finnito\PlacesModule\Log\Contract\LogInterface;
use Anomaly\Streams\Platform\Model\Places\PlacesLogsEntryModel;
use Finnito\PlacesModule\Place\PlaceModel;

class LogModel extends PlacesLogsEntryModel implements LogInterface
{

    public function relatedHut()
    {
        return $this->hasOne(PlaceModel::class, "id", "related_hut_id");
    }

}
