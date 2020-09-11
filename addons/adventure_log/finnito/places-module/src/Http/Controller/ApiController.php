<?php namespace Finnito\PlacesModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Finnito\PlacesModule\Place\PlaceModel;
use Illuminate\Http\Request;

class ApiController extends PublicController
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
            ->get(["name", "name_slug", "place", "place_slug", "latitude", "longitude"]);

        $results = $hutResults->sortBy(function ($entry) {
            return $entry["place"];
        });

        return response()->json($results);
    }
}
