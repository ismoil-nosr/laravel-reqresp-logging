<?php

namespace IsmoilNosr\ReqrespLogger\Contracts;

interface Loggable
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function logRequest(array $data): void;

    /**
     * @param  array<string, mixed>  $data
     */
    public function logResponse(array $data): void;
}
