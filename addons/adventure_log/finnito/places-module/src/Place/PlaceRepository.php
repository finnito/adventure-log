<?php namespace Finnito\PlacesModule\Place;

use Finnito\PlacesModule\Place\Contract\PlaceRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class PlaceRepository extends EntryRepository implements PlaceRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var PlaceModel
     */
    protected $model;

    /**
     * Create a new PlaceRepository instance.
     *
     * @param PlaceModel $model
     */
    public function __construct(PlaceModel $model)
    {
        $this->model = $model;
    }
}
