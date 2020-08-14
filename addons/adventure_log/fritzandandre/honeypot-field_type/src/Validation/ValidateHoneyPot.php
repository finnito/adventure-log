<?php namespace Fritzandandre\HoneypotFieldType\Validation;

use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class ValidateHoneyPot
 *
 * @link    http://fritzandandre.com
 * @author  Brennon Loveless <brennon@fritzandandre.com>
 * @package Fritzandandre\HoneypotFieldType\Validation
 */
class ValidateHoneyPot
{
    /**
     * The honey pot field is invalid if any value is submitted for it.
     * All submissions that are ignored will be recorded into the ignored submissions log file.
     *
     * @param Request $request
     * @param null    $value
     * @return bool
     */
    public function handle(Request $request, $value = null)
    {
        if ($value) {
            $logger = new Logger('Honeypot Ignored Submissions');
            $logger->pushHandler(new StreamHandler(storage_path('logs/honeypot_ignored_submissions.log'),
                Logger::INFO));
            $logger->addInfo(json_encode($request->input()));

            return false;
        }

        return true;
    }
}