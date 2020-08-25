<?php namespace Finnito\PlacesModule\Http\Controller\Admin;

use Finnito\PlacesModule\Feedback\Form\FeedbackFormBuilder;
use Finnito\PlacesModule\Feedback\Table\FeedbackTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class FeedbackController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param FeedbackTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FeedbackTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param FeedbackFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(FeedbackFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param FeedbackFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(FeedbackFormBuilder $form, $feedback_id)
    {
        return $form->render($id);
    }
}
