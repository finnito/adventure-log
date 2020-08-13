<?php namespace Finnito\PlacesModule\Feedback\Form;

use \Finnito\PlacesModule\Feedback\Form\FeedbackFormBuilder;
use \nickurt\Akismet\Akismet;
use Illuminate\Http\Request;
use \Anomaly\Streams\Platform\Message\MessageBag;
use \Anomaly\Streams\Platform\Http\HttpCache;

class FeedbackFormHandler
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
        FeedbackFormBuilder $builder,
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
            "comment_content" => $values["title"]."\n".$values["description"],
            "blog" => env("AKISMET_BLOGURL")

        ]);
        if ($akismet->validateKey()) {
            if ($akismet->isSpam()) {
                $bag->info("Your feedback was marked as SPAM. If this is an error, please email Finn.");
            } else {
                $bag->success("Thank you for your feedback! You can view it <a href='https://github.com/finnito/adventure-log/issues'>by clicking here</a>.");
                if (!$builder->canSave()) {
                    return;
                }

                $access_token = env("GITHUB_ACCESS_TOKEN");
                $url = "https://api.github.com/repos/finnito/adventure-log/issues";
                $title = htmlspecialchars(stripslashes($values["title"]), ENT_QUOTES);
                $body = htmlspecialchars(stripslashes($values["description"]), ENT_QUOTES);
                $post = array(
                    "title" => $title,
                    "body" => $body,
                    "assignees" => array("finnito"),
                    "labels" => array("Website Feedback")
                );
                $opts = [
                    'http' => [
                            'method' => 'POST',
                            'header' => [
                                    'User-Agent: PHP',
                                    'Content-type: application/x-www-form-urlencoded',
                                    'Authorization: token ' . $access_token
                            ],
                            'content' => json_encode($post)
                    ]
                ];
                $context = stream_context_create($opts);
                $content = json_decode(file_get_contents($url, false, $context));
                $builder->saveForm();
                $cache->purge('/feedback');
            }
        } else {
            $bag->info("There was an error with Akismet");
        }    
    }
}
