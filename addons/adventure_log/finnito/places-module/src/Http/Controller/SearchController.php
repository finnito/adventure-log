<?php namespace Finnito\PlacesModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Finnito\PlacesModule\Place\PlaceModel;
use Illuminate\Http\Request;

class SearchController extends PublicController
{

    /**
     * Search the places table.
     *
     * @param PlaceModel $model
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(PlaceModel $model, Request $request)
    {
        $results = $model->search($request->q)->get();
        $this->template->set("meta_title", "Search results for '" . $request->q . "'");
        return $this->view->make(
            'finnito.module.places::places/search',
            [
                'results' => $results,
                "query" => $request->q
            ]
        );
    }

}
