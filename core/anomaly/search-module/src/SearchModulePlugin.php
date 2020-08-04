<?php

namespace Anomaly\SearchModule;

use Illuminate\Database\Eloquent\Builder;
use Anomaly\SearchModule\Search\SearchCriteria;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\SearchModule\Item\Contract\ItemRepositoryInterface;

/**
 * Class SearchModulePlugin
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SearchModulePlugin extends Plugin
{

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'search',
                function ($search, $options = []) {

                    /* @var ItemRepositoryInterface $repository */
                    $repository = app(ItemRepositoryInterface::class);

                    /* @var EntryInterface $model */
                    $query = $repository->newQuery();
                    $model = $repository->getModel();

                    /**
                     * Configure parameters.
                     */
                    $term = str_replace(['-', '+', '<', '>', '@', '(', ')', '~'], '', $search);

                    $threshold = array_get($options, 'threshold', 3);

                    $words = explode(' ', $term);

                    /**
                     * Select the matches we are using
                     * and prioritize the results.
                     */
                    $query->addSelect('*');

                    $query->addSelect(app('db')->raw(
                        'MATCH (title,description) AGAINST ("' . implode(' ', $words) . '") AS _primary_score'
                    ));

                    $query->addSelect(app('db')->raw(
                        'MATCH (searchable) AGAINST ("' . implode(' ', $words) . '") AS _secondary_score'
                    ));

                    $query->orderBy('_primary_score', 'DESC');
                    $query->orderBy('_secondary_score', 'DESC');
                        
                    /**
                     * Restrict the query to the active locale.
                     */
                    $query->where('locale', array_get($options, 'locale', config('app.locale')));

                    /**
                     * Filter the results using the above matches.
                     */
                    $query->where(
                        function (Builder $query) use ($search, $threshold, $words) {

                            foreach ($words as $key => $word) {

                                /*
                                 * applying + operator (required word) only big words
                                 * because smaller ones are not indexed by mysql
                                 */
                                if (strlen($word) >= 3) {
                                    $words[$key] = '+' . $word . '*';
                                }
                            }

                            /**
                             * Match the primary index fields.
                             * Title and description should trump
                             * anything else that get's matched.
                             */
                            $match = app('db')->raw(
                                'MATCH (title,description) AGAINST ("' . implode(' ', $words) . '")'
                            );

                            $query->where($match, '>=', $threshold);

                            /**
                             * Match in the searchable data
                             * if possible. Expect lower scores.
                             */
                            $match = app('db')->raw(
                                'MATCH (searchable) AGAINST ("' . implode(' ', $words) . '")'
                            );

                            $query->orWhere($match, '>=', $threshold);

                            /**
                             * Match multiple words against
                             * the primary fields as well.
                             * 
                             * @todo is this needed?
                             */
                            if (count($words) > 1) {
                                foreach ($words as $k => $word) {

                                    //$match = app('db')->raw('MATCH (title,description) AGAINST ("' . $word . '")');

                                    //$query->addSelect($match . ' AS _score' . ($k + 1));
                                    //$query->orWhere($match, '>=', $threshold);
                                    //$query->orderBy($match, 'ASC');
                                }
                            }

                            $query->orWhere('title', 'LIKE', '%' . $search . '%');
                            $query->orWhere('description', 'LIKE', '%' . $search . '%');
                        }
                    );

                    return new SearchCriteria($query, $model->getStream(), 'get');
                }
            ),
        ];
    }
}
