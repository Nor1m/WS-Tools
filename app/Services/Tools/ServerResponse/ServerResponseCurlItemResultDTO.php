<?php

namespace App\Services\Tools\ServerResponse;

class ServerResponseCurlItemResultDTO
{
    public function __construct(
        public readonly string $url,
        public readonly int $httpCode,
        public readonly string $response,
        public readonly float $totalTime,
    ) {}
}