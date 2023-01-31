<?php

namespace App\Services\Tools\ServerResponse;

class ServerResponseResultDTO
{
    public function __construct(
        public readonly float $totalTime,
        public readonly string $primaryIp,
        public readonly string $localIp,
        public readonly array $curlServerResponses,
    ) {}
}