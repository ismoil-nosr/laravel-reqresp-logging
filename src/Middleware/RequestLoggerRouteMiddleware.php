<?php

namespace IsmoilNosr\ReqrespLogger\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
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
        /** @var JsonResponse $response */
        $response = $next($request);

        $logData = [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'input' => $request->all(),
            'response' => $response->getData(true),
        ];

        $this->logger->logRequest($logData);

        return $response;
    }
}
