<?php

namespace IsmoilNosr\ReqrespLogger\Middleware;

use Closure;
use Illuminate\Http\Request;
use IsmoilNosr\ReqrespLogger\Contracts\Loggable;

class RequestLoggerRouteMiddleware
{
    protected Loggable $logger;

    public function __construct(Loggable $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Request $request, Closure $next): mixed
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
