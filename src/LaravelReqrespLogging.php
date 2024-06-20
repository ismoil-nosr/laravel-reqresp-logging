<?php

namespace IsmoilNosr\ReqrespLogger;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use IsmoilNosr\ReqrespLogger\Contracts\Loggable;
use IsmoilNosr\ReqrespLogger\Jobs\RequestLoggerJob;

class LaravelReqrespLogging implements Loggable
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function logRequest(array $data): void
    {
        if (config('reqresp.enabled')) {
            $data['input'] = $this->filterContent($data['input'], config('reqresp.filter_request'));

            if (config('reqresp.queue')) {
                Bus::dispatch(new RequestLoggerJob($data));
            } else {
                Log::info('Request Details', $data);
            }
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function logResponse(array $data): void
    {
        if (config('reqresp.enabled')) {
            $data['response'] = $this->filterContent($data['response'], config('reqresp.filter_response'));

            if (config('reqresp.queue')) {
                Bus::dispatch(new RequestLoggerJob($data));
            } else {
                Log::info('Response Details', $data);
            }
        }
    }

    /**
     * @param  array<string, mixed>  $content
     * @return array<string, mixed>
     */
    protected function filterContent(array $content, bool $shouldFilter): array
    {
        if (! $shouldFilter) {
            return $content;
        }

        $filterKeys = config('reqresp.filter_keys');
        array_walk_recursive($content, function (&$item, $key) use ($filterKeys) {
            if (in_array($key, $filterKeys)) {
                $item = 'FILTERED';
            }
        });

        return $content;
    }
}
