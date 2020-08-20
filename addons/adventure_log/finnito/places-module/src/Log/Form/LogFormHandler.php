<?php namespace Finnito\PlacesModule\Log\Form;

use \Finnito\PlacesModule\Log\Form\LogFormBuilder;
use \nickurt\Akismet\Akismet;
use Illuminate\Http\Request;
use \Anomaly\Streams\Platform\Message\MessageBag;
use \Anomaly\Streams\Platform\Http\HttpCache;

class LogFormHandler
{

    /**
     * Handle the form.
     *
     * @param FormBuilder $builder
     */
    public function handle(
        Request $request,
        MessageBag $bag,
        Akismet $akismet,
        LogFormBuilder $builder,
        HttpCache $cache
    ) {
        $values = $builder->getFormValues();
        $akismet->setApiKey(env("AKISMET_APIKEY"));
        $akismet->fill([
            "user_ip" => $request->headers->get("origin"),
            "user_agent" => $request->headers->get("user_agent"),
            "referrer" => $request->headers->get("referer"),
            "permalink" => $request->headers->get("origin"),
            "comment_type" => "forum-post",
            "comment_author" => $values["name"],
            "comment_content" => $values["log"],
            "blog" => env("AKISMET_BLOGURL")

        ]);
        if($akismet->validateKey()) {
            if($akismet->isSpam()) {
                $bag->info("Your log was marked as SPAM. If this is an error, please email Finn.");
            } else {
                $bag->success("Thank you for your log!");
                if (!$builder->canSave()) {
                    return;
                }

                $builder->saveForm();
                $cache->purge($request->headers->get("referer"));
            }
        } else {
            $bag->info("There was an error with Akismet");
        }   
    }
}