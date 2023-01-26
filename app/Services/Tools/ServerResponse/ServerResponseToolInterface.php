<?php

namespace App\Services\Tools\ServerResponse;

interface ServerResponseToolInterface
{
    public function run(string $url): ServerResponseResultDTO;
}