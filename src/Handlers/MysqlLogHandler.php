<?php

namespace IsmoilNosr\ReqrespLogger\Handlers;

use Illuminate\Support\Facades\DB;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use function json_encode;

class MysqlLogHandler extends AbstractProcessingHandler
{
    protected function write(LogRecord $record): void
    {
        DB::table('reqresp_logs')->insert([
            'message' => $record->message,
            'context' => json_encode($record->context),
            'level' => $record->level->value,
            'level_name' => $record->level->name,
            'channel' => $record->channel,
            'datetime' => $record->datetime->format('Y-m-d H:i:s'),
            'extra' => json_encode($record->extra),
        ]);
    }
}
