<?php namespace Finnito\PlacesModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Finnito\PlacesModule\Place\Contract\PlaceRepositoryInterface;
use Finnito\PlacesModule\Log\Contract\LogRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends PublicController
{
    public function index(PlaceRepositoryInterface $places)
    {
        $index = $places
            ->newQuery()
            ->select(DB::raw('place, place_slug, count(*) as "count"'))
            ->where("place", "!=", "null")
            ->orderBy("place")
            ->groupBy("place_slug")
            ->get();

        $this->template->set("meta_title", "All Places");
        
        return $this->view->make(
            'finnito.module.places::places/index',
            [
                'places' => $index,
            ]
        );
    }

    /**
     * Search the places table.
     *
     * @param PlaceModel $model
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function place(PlaceRepositoryInterface $places, $place_slug)
    {
        $huts = $places
            ->newQuery()
            ->where("place_slug", "=", $place_slug)
            ->get();

        $this->template->set("meta_title", $huts->first()->getAttribute("place"));

        return $this->view->make(
            'finnito.module.places::places/place',
            [
                "place" => $huts->first()->getAttribute("place"),
                'huts' => $huts,
            ]
        );
    }

    /**
     * Search the places table.
     *
     * @param PlaceModel $model
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function hut(
        PlaceRepositoryInterface $places,
        LogRepositoryInterface $logs,
        $place_slug,
        $name_slug)
    {
        $hut = $places
            ->newQuery()
            ->where([
                ["place_slug", "=", $place_slug],
                ["name_slug", "=", $name_slug]
            ])
            ->first();

        $related_logs = $logs
            ->newQuery()
            ->where([
                ["related_hut_id", "=", $hut->id]
            ])
            ->orderBy("log_date", "DESC")
            ->get();

        $this->template->set("meta_title", $hut->getAttribute("name"));

        return $this->view->make(
            'finnito.module.places::places/hut',
            [
                'hut' => $hut,
                "logs" => $related_logs
            ]
        );
    }

}
