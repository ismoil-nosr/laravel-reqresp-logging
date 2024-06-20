<?php

namespace RequestLogger\Middleware;

use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Support\Facades\Event;
use RequestLogger\Contracts\Loggable;

class RequestLoggerClientMiddleware
{
    protected $logger;

    public function __construct(Loggable $logger)
    {
        $this->logger = $logger;
    }

    public function register()
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