<?php

namespace RequestLogger\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Middleware;
use RequestLogger\Contracts\Loggable;

class RequestLoggerGuzzleMiddleware
{
    protected $logger;

    public function __construct(Loggable $logger)
    {
        $this->logger = $logger;
    }

    public function middleware()
    {
        return Middleware::tap(function (RequestInterface $request) {
            $logData = [
                'url' => (string) $request->getUri(),
                'method' => $request->getMethod(),
                'body' => (string) $request->getBody(),
                'headers' => $request->getHeaders(),
            ];

            $this->logger->logRequest($logData);
        }, function (ResponseInterface $response) {
            $logData = [
                'body' => (string) $response->getBody(),
                'status' => $response->getStatusCode(),
            ];

            $this->logger->logResponse($logData);
        });
    }
}