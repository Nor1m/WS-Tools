<?php

namespace App\Services\Http\HttpRequest;

use CurlHandle;

class CurlRequest implements HttpRequest
{
    private null|false|CurlHandle $handle = null;

    public function __construct($url)
    {
        $this->handle = curl_init($url);
    }

    public function setOption($name, $value): void
    {
        curl_setopt($this->handle, $name, $value);
    }

    public function exec(): bool|string
    {
        return curl_exec($this->handle);
    }

    public function getInfo(?int $name = null): mixed
    {
        return curl_getinfo($this->handle, $name);
    }

    public function close(): void
    {
        curl_close($this->handle);
    }
}