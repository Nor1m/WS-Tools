<?php

namespace App\Services\Tools\ServerResponse;

class ServerResponseResultDTO
{
    /**
     * @param float $totalTime
     * @param string $primaryIp
     * @param string $localIp
     * @param array $curlServerResponses
     */
    public function __construct(
        public readonly float $totalTime,
        public readonly string $primaryIp,
        public readonly string $localIp,
        public readonly array $curlServerResponses,
    )
    {
    }
}