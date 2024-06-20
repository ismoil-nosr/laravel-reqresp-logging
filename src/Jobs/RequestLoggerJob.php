<?php

namespace RequestLogger\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RequestLoggerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $logData;

    public function __construct($logData)
    {
        $this->logData = $logData;
    }

    public function handle()
    {
        Log::info('Request Details', $this->logData);
    }
}