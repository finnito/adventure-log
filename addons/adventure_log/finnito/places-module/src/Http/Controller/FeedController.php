<?php namespace Finnito\PlacesModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Finnito\PlacesModule\Log\Contract\LogRepositoryInterface;
use Finnito\PlacesModule\Place\Contract\PlaceRepositoryInterface;
use Anomaly\PostsModule\Post\Contract\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FeedController extends PublicController
{

    /**
     * Search the places table.
     *
     * @param PlaceModel $model
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(LogRepositoryInterface $logs, PostRepositoryInterface $posts)
    {
        $entries = $logs->all()
            ->concat($posts->all())
            ->sortByDesc("created_at");
        $content = $this->view->make(
            'finnito.module.places::feeds/master',
            [
                "entries" => $entries
            ]
        );
        return response($content)
            ->withHeaders([
                'Content-Type' => "application/xml",
            ]);
    }

    public function place(
        PlaceRepositoryInterface $places,
        LogRepositoryInterface $logs,
        $place_slug
    ) {
        $place = $places
            ->newQuery()
            ->where("place_slug", $place_slug)
            ->groupBy("place_slug")
            ->first();
        $entries = $logs
            ->newQuery()
            ->whereHas("relatedHut", function (Builder $query) use ($place_slug) {
                $query->where("place_slug", $place_slug);
            })
            ->orderBy("created_at", "DESC")
            ->get();
        $content = $this->view->make(
            'finnito.module.places::feeds/logs',
            [
                "entries" => $entries,
                "title" => $place->place
            ]
        );
        return response($content)
            ->withHeaders([
                'Content-Type' => "application/xml",
            ]);
    }

    public function hut(
        PlaceRepositoryInterface $places,
        LogRepositoryInterface $logs,
        $place_slug,
        $name_slug
    ) {
        $hut = $places
            ->newQuery()
            ->where([
                ["place_slug", $place_slug],
                ["name_slug", $name_slug]
            ])
            ->first();
        $entries = $logs
            ->newQuery()
            ->whereHas("relatedHut", function (Builder $query) use ($place_slug, $name_slug) {
                $query->where([
                    ["place_slug", $place_slug],
                    ["name_slug", $name_slug]
                ]);
            })
            ->orderBy("created_at", "DESC")
            ->get();
        $content = $this->view->make(
            'finnito.module.places::feeds/logs',
            [
                "entries" => $entries,
                "title" => $hut->name,
            ]
        );
        return response($content)
            ->withHeaders([
                'Content-Type' => "application/xml",
            ]);
    }
}
