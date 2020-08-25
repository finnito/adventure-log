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

        $txt = "There are " . $huts->count() . " huts in " . $huts->first()->getAttribute("place") . ".";
        if ($huts->count() == 1) {
            $txt = "There is " . $huts->count() . " hut in " . $huts->first()->getAttribute("place") . ".";
        }

        $this->template->set("meta_title", $huts->first()->getAttribute("place"));
        $this->template->set("meta_description", $txt . " Click through to view them and their logs.");

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
        $place_slug,
        $name_slug
    ) {
        $hut = $places
            ->newQuery()
            ->where([
                ["place_slug", "=", $place_slug],
                ["name_slug", "=", $name_slug]
            ])
            ->first();

        $txt = $hut->getAttribute("name") . " has " . $hut->logs()->count() . " logs.";
        if ($hut->logs()->count() == 1) {
            $txt = $hut->getAttribute("name") . " has " . $hut->logs()->count() . " log.";
        }

        $this->template->set("meta_title", $hut->getAttribute("name"));
        $this->template->set("meta_description", $txt . " Click through to read and create logs!");

        return $this->view->make(
            'finnito.module.places::places/hut',
            [
                'hut' => $hut
            ]
        );
    }


    public function flagLog(LogRepositoryInterface $logs, $log_id)
    {
        $logs
            ->newQuery()
            ->where('id', $log_id)
            ->update(array("is_flagged" => 1));
        return redirect()->back();
    }
}
