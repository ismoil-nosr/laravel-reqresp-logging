<?php

namespace IsmoilNosr\ReqrespLogger\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use IsmoilNosr\ReqrespLogger\Contracts\Loggable;
use IsmoilNosr\ReqrespLogger\LaravelReqrespLogging;

use function config_path;

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
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/reqresp.php' => config_path('reqresp.php'),
            ], 'reqresp-config');
        }

        /** @phpstan-ignore-next-line  */
        $router = $this->app['router'];
        $router->aliasMiddleware('reqresp', \IsmoilNosr\ReqrespLogger\Middleware\RequestLoggerRouteMiddleware::class);
    }
}
