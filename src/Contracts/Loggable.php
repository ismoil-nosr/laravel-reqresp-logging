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

    public function setLogChannel(string $channel): static;

    public function setFilterRequestEnabled(bool $value): static;

    public function setFilterResponseEnabled(bool $value): static;

    /**
     * @param  array<string, mixed>  $keys
     */
    public function setFilterableKeys(array $keys): static;
}
