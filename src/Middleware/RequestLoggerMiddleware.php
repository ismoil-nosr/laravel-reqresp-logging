<?php

namespace RequestLogger\Middleware;

use Closure;
use RequestLogger\Contracts\Loggable;

class RequestLoggerMiddleware
{
    protected $logger;

    public function __construct(Loggable $logger)
    {
        $this->logger = $logger;
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $logData = [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'input' => $request->all(),
            'response' => $response->getContent(),
        ];

        $this->logger->logRequest($logData);
        $this->logger->logResponse($logData);

        return $response;
    }
}