<?php

namespace App\Services\Tools\ServerResponse;

interface ServerResponseTool
{
    /**
     * @param string $url
     * @return ServerResponseResultDTO
     */
    public function run(string $url): ServerResponseResultDTO;
}