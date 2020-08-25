<?php namespace Finnito\PlacesModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
// use Finnito\PlacesModule\Place\PlaceModel;
use Illuminate\Http\Request;

class FeedbackController extends PublicController
{

    /**
     * Search the places table.
     *
     * @param PlaceModel $model
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $this->template->set("meta_title", "Feedback");
        return $this->view->make(
            'finnito.module.places::places/feedback',
            []
        );
    }
}
