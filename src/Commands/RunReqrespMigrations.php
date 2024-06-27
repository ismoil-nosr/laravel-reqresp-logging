<?php

namespace IsmoilNosr\ReqrespLogger\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RunReqrespMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reqresp:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Schema::create('reqresp_logs', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->json('context')->nullable();
            $table->string('level');
            $table->string('level_name');
            $table->string('channel');
            $table->timestamp('datetime');
            $table->json('extra')->nullable();
        });

        $this->info('reqresp_logs table created.');
    }
}
