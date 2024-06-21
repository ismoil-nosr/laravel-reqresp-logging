<?php

namespace IsmoilNosr\ReqrespLogger;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use IsmoilNosr\ReqrespLogger\Contracts\Loggable;
use IsmoilNosr\ReqrespLogger\Jobs\RequestLoggerJob;

use function config;

class LaravelReqrespLogging implements Loggable
{
    protected string $logChannel;

    protected bool $filter_request;

    protected bool $filter_response;

    /**
     * @var array<string, mixed>
     */
    protected array $filter_keys;

    public function __construct()
    {
        $this->filter_keys = config('reqresp.filter_keys', []);
        $this->logChannel = config('reqresp.log_channel', 'default');
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function logRequest(array $data): void
    {
        if (config('reqresp.enabled')) {
            $data['input'] = $this->filterContent($data['input'], config('reqresp.filter_request'), $this->filter_keys);

            if (config('reqresp.queue')) {
                Bus::dispatch(new RequestLoggerJob($data));
            } else {
                $this->log('Request Details', $data);
            }
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function logResponse(array $data): void
    {
        if (config('reqresp.enabled')) {
            $data['response'] = $this->filterContent($data['response'], config('reqresp.filter_response'), $this->filter_keys);

            if (config('reqresp.queue')) {
                Bus::dispatch(new RequestLoggerJob($data));
            } else {
                $this->log('Response Details', $data);
            }
        }
    }

    /**
     * @param  array<string, mixed>  $content
     * @param  array<string, mixed>  $filterKeys
     * @return array<string, mixed>
     */
    protected function filterContent(array $content, bool $shouldFilter, array $filterKeys): array
    {
        if (! $shouldFilter) {
            return $content;
        }

        $filterKeys = $filterKeys ?: config('reqresp.filter_keys', []);

        array_walk_recursive($content, function (&$item, $key) use ($filterKeys) {
            if (in_array($key, $filterKeys)) {
                $item = '[FILTERED]';
            }
        });

        return $content;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function log(string $message, array $data): void
    {
        $logger = Log::channel($this->logChannel);
        $logger->info($message, $data);
    }

    public function setLogChannel(string $channel): static
    {
        $this->logChannel = $channel; //TODO: check does channel exists

        return $this;
    }

    public function setFilterRequestEnabled(bool $value): static
    {
        $this->filter_request = $value;

        return $this;
    }

    public function setFilterResponseEnabled(bool $value): static
    {
        $this->filter_response = $value;

        return $this;
    }

    /**
     * @param  array<string, mixed>  $keys
     * @return $this
     */
    public function setFilterableKeys(array $keys): static
    {
        $this->filter_keys = $keys;

        return $this;
    }
}
