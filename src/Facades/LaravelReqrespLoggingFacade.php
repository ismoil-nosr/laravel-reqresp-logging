<?php

namespace IsmoilNosr\LaravelReqrespLogging;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IsmoilNosr\LaravelReqrespLogging\Skeleton\SkeletonClass
 */
class LaravelReqrespLoggingFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-reqresp-logging';
    }
}
