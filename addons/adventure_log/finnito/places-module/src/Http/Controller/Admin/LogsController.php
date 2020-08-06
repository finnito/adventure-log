<?php namespace Finnito\PlacesModule\Http\Controller\Admin;

use Finnito\PlacesModule\Log\Form\LogFormBuilder;
use Finnito\PlacesModule\Log\Table\LogTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class LogsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param LogTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(LogTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param LogFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(LogFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param LogFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(LogFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
