<?php

namespace IsmoilNosr\ReqrespLogger\Middleware;

use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Support\Facades\Event;
use IsmoilNosr\ReqrespLogger\Contracts\Loggable;

class RequestLoggerClientMiddleware
{
    protected Loggable $logger;

    public function __construct(Loggable $logger)
    {
        $this->logger = $logger;
    }

    public function register(): void
    {
        Event::listen(RequestSending::class, function ($event) {
            $logData = [
                'url' => $event->request->url(),
                'method' => $event->request->method(),
                'body' => $event->request->body(),
                'headers' => $event->request->headers(),
            ];

            $this->logger->logRequest($logData);
        });

        Event::listen(ResponseReceived::class, function ($event) {
            $logData = [
                'body' => $event->response->body(),
                'status' => $event->response->status(),
            ];

            $this->logger->logResponse($logData);
        });
    }
}
