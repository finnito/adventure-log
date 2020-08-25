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
        
        $hutResults = $model
            ->newQuery()
            ->where("name", "LIKE", "%".$request->q."%")
            ->get();

        $placeResults = $model
            ->newQuery()
            ->where("place", "like", "%".$request->q."%")
            ->groupBy("place")
            ->get();
        foreach ($placeResults as $entry) {
            $entry["place_type"] = "place";
        }

        $results = $hutResults->concat($placeResults)->sortBy(function ($entry) {
            if ($entry["place_type"] == "place") {
                return $entry["place"];
            }
            return $entry["name"];
        });

        $this->template->set("meta_title", "Search");
        $this->template->set("meta_description", "Search results for '" . $request->q . "'");
        
        return $this->view->make(
            'finnito.module.places::places/search',
            [
                'results' => $results,
                "query" => $request->q,
            ]
        );
    }

}
