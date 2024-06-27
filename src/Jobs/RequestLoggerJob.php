<?php

namespace IsmoilNosr\ReqrespLogger\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RequestLoggerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array|mixed[]
     */
    protected array $logData;

    private string $logChannel;

    /**
     * @param  array<string, mixed>  $logData
     */
    public function __construct(array $logData)
    {
        $this->queue = config('reqresp.queue_name');
        $this->logData = $logData;
        $this->logChannel = config('reqresp.log_channel', 'daily');
    }

    public function handle(): void
    {
        Log::channel($this->logChannel)->info('Request Details', $this->logData);
    }
}
