<?php

namespace IsmoilNosr\ReqrespLogger\Handlers;

use Illuminate\Support\Facades\DB;
use Monolog\Handler\AbstractProcessingHandler;

class MysqlLogHandler extends AbstractProcessingHandler
{
    protected function write(array $record): void
    {
        DB::table('reqresp_logs')->insert([
            'message' => $record['message'],
            'context' => json_encode($record['context']),
            'level' => $record['level'],
            'level_name' => $record['level_name'],
            'channel' => $record['channel'],
            'datetime' => $record['datetime']->format('Y-m-d H:i:s'),
            'extra' => json_encode($record['extra']),
        ]);
    }
}
