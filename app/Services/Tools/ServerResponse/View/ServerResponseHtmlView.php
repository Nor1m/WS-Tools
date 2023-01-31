<?php

namespace App\Services\Tools\ServerResponse\View;

use App\Services\Tools\ServerResponse\ServerResponseResultDTO;

interface ServerResponseHtmlView
{
    public function response(ServerResponseResultDTO $dto): string;
}