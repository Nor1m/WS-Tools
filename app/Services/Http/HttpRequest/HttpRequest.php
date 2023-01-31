<?php

namespace App\Services\Http\HttpRequest;

interface HttpRequest
{
    public function exec(): bool|string;
    public function close(): void;
    public function setOption($name, $value): void;
    public function getInfo(?int $name = null): mixed;
}