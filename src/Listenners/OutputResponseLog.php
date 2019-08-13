<?php

namespace HT\LaravelSqlLogger\Listeners;

use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Http\Events\RequestHandled;

/**
 * Output Response Log
 *
 * @package App\Listeners
 */
class OutputResponseLog
{
    /**
     * Handle the event.
     *
     * @param \Illuminate\Foundation\Http\Events\RequestHandled $request_handled
     */
    public function handle(RequestHandled $request_handled): void
    {
        $response = $request_handled->response;
        if ($response instanceof RedirectResponse) {
            logger()->debug('Redirect', ['to' =>$response->getTargetUrl()]);
        } else if (app()->isLocal()) {
            logger()->debug('Response', ['code' => $response->getStatusCode(), 'class' => get_class($response)]);
        }
    }
}
