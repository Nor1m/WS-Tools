<?php

namespace App\Services\Tools\ServerResponse;

interface ServerResponseTool
{
    public function run(string $url): ServerResponseResultDTO;
}