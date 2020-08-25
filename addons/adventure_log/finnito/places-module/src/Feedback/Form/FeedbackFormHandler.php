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
        if (!$akismet->validateKey()) {
            $bag->info("There was an error with Akismet");
            return;
        }

        if ($akismet->isSpam()) {
            $bag->info("Your feedback was marked as SPAM. If this is an error, please email Finn.");
            return;
        }

        if (!$builder->canSave()) {
            $bag->info("There was an issue saving your feedback. Please email Finn!");
            return;
        }
        $builder->saveForm();

        $cache->purge('/feedback');
        
        $url = "https://api.github.com/repos/finnito/adventure-log/issues";
        $curl = curl_init($url);
        $payload = json_encode(array(
            "title" => $values["title"],
            "body" => $values["description"],
            "assignees" => array("finnito"),
            "labels" => array("Website Feedback")
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'User-Agent: PHP',
            'Content-Type:application/json',
            'Authorization: token ' . env("GITHUB_ACCESS_TOKEN"),
            'Accept: application/vnd.github.v3+json'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($curl), true);

        if (array_key_exists("message", $result)) {
            $bag->info("Your log could not be logged to GitHub, but it has been saved. Thank you!\n".$result["message"]);
            return;
        }
        
        $bag->success("Thank you for your feedback! You can view it <a href='".$result["html_url"]."'>by clicking here</a>.");
        curl_close($curl);
    }
}
