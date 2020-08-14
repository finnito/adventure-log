<?php namespace Finnito\PlacesModule\Http\Controller\Admin;

use Finnito\PlacesModule\Log\Form\LogFormBuilder;
use Finnito\PlacesModule\Log\Table\LogTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Finnito\PlacesModule\Log\Contract\LogRepositoryInterface;

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

    public function review(LogRepositoryInterface $logs, $id)
    {
        $logs
            ->newQuery()
            ->where('id', $id)
            ->update(array("is_reviewed" => 1));
        return redirect()->back();
    }

    public function unflag(LogRepositoryInterface $logs, $id)
    {
        $logs
            ->newQuery()
            ->where('id', $id)
            ->update(array("is_flagged" => 0));
        return redirect()->back();
    }
}
