<?php namespace Finnito\PlacesModule\Log;

use Finnito\PlacesModule\Log\Contract\LogRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class LogRepository extends EntryRepository implements LogRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var LogModel
     */
    protected $model;

    /**
     * Create a new LogRepository instance.
     *
     * @param LogModel $model
     */
    public function __construct(LogModel $model)
    {
        $this->model = $model;
    }
}
