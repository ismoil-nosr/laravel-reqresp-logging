<?php

namespace RequestLogger\Contracts;

interface Loggable
{
    public function logRequest(array $data): void;
    public function logResponse(array $data): void;
}