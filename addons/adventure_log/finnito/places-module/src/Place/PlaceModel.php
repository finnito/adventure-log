<?php namespace Finnito\PlacesModule\Place;

use Finnito\PlacesModule\Place\Contract\PlaceInterface;
use Anomaly\Streams\Platform\Model\Places\PlacesPlacesEntryModel;
use Finnito\PlacesModule\Log\LogModel;

class PlaceModel extends PlacesPlacesEntryModel implements PlaceInterface
{
    public function logs()
    {
        return $this
        ->hasMany(LogModel::class, "related_hut_id", "id")
        ->orderBy("log_date", "DESC")
        ->get();
    }
}
