<?php namespace Finnito\PlacesModule\Http\Controller\Admin;

use Finnito\PlacesModule\Place\Form\PlaceFormBuilder;
use Finnito\PlacesModule\Place\Table\PlaceTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class PlacesController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param PlaceTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PlaceTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param PlaceFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(PlaceFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param PlaceFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(PlaceFormBuilder $form, $place_id)
    {
        return $form->render($place_id);
    }
}
