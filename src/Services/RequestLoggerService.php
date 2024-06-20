<?php

namespace RequestLogger\Services;

use RequestLogger\Contracts\Loggable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Bus;
use RequestLogger\Jobs\RequestLoggerJob;

class RequestLoggerService implements Loggable
{
    public function logRequest(array $data): void
    {
        if (config('requestlogger.enabled')) {
            $data['input'] = $this->filterContent($data['input'], config('requestlogger.filter_request'));

            if (config('requestlogger.queue')) {
                Bus::dispatch(new RequestLoggerJob($data));
            } else {
                Log::info('Request Details', $data);
            }
        }
    }

    public function logResponse(array $data): void
    {
        if (config('requestlogger.enabled')) {
            $data['response'] = $this->filterContent($data['response'], config('requestlogger.filter_response'));

            if (config('requestlogger.queue')) {
                Bus::dispatch(new RequestLoggerJob($data));
            } else {
                Log::info('Response Details', $data);
            }
        }
    }

    protected function filterContent($content, $shouldFilter)
    {
        if (!$shouldFilter) {
            return $content;
        }

        $filterKeys = config('requestlogger.filter_keys');
        array_walk_recursive($content, function (&$item, $key) use ($filterKeys) {
            if (in_array($key, $filterKeys)) {
                $item = 'FILTERED';
            }
        });

        return $content;
    }
}