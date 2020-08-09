<?php namespace Finnito\PlacesModule\Feedback;

use Finnito\PlacesModule\Feedback\Contract\FeedbackRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class FeedbackRepository extends EntryRepository implements FeedbackRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var FeedbackModel
     */
    protected $model;

    /**
     * Create a new FeedbackRepository instance.
     *
     * @param FeedbackModel $model
     */
    public function __construct(FeedbackModel $model)
    {
        $this->model = $model;
    }
}
