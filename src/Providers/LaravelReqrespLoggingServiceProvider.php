<?php

namespace IsmoilNosr\ReqrespLogger\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use IsmoilNosr\ReqrespLogger\Contracts\Loggable;
use IsmoilNosr\ReqrespLogger\LaravelReqrespLogging;
use IsmoilNosr\ReqrespLogger\Middleware\RequestLoggerClientMiddleware;

class LaravelReqrespLoggingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/reqresp.php', 'reqresp');

        $this->app->singleton(Loggable::class, LaravelReqrespLogging::class);
    }

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/reqresp.php' => config_path('reqresp.php'),
        ]);

        /** @phpstan-ignore-next-line  */
        $router = $this->app['router'];
        $router->aliasMiddleware('reqresp', \IsmoilNosr\ReqrespLogger\Middleware\RequestLoggerMiddleware::class);

        $logger = $this->app->make(Loggable::class);
        (new RequestLoggerClientMiddleware($logger))->register();
    }
}
