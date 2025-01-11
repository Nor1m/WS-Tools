<?php

namespace App\Services\Tools\ServerResponse\View;

use App\Services\Tools\ServerResponse\ServerResponseResultDTO;

interface ServerResponseHtmlView
{
    /**
     * @param ServerResponseResultDTO $dto
     * @return string
     */
    public function response(ServerResponseResultDTO $dto): string;
}