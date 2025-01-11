<?php

namespace App\Services\Tools\ServerResponse;

class ServerResponseCurlItemResultDTO
{
    /**
     * @param string $url
     * @param int $httpCode
     * @param string $response
     * @param float $totalTime
     */
    public function __construct(
        public readonly string $url,
        public readonly int $httpCode,
        public readonly string $response,
        public readonly float $totalTime,
    ) {}
}