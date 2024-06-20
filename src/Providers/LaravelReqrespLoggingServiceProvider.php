<?php

namespace RequestLogger;

use Illuminate\Support\ServiceProvider;
use RequestLogger\Middleware\RequestLoggerClientMiddleware;
use RequestLogger\Services\RequestLoggerService;
use RequestLogger\Contracts\Loggable;

class RequestLoggerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/requestlogger.php', 'requestlogger');

        $this->app->singleton(Loggable::class, RequestLoggerService::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/requestlogger.php' => config_path('requestlogger.php'),
        ]);

        $router = $this->app['router'];
        $router->aliasMiddleware('requestlogger', \RequestLogger\Middleware\RequestLoggerMiddleware::class);

        $logger = $this->app->make(Loggable::class);
        (new RequestLoggerClientMiddleware($logger))->register();
    }
}