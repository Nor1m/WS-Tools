<?php

namespace App\Services\Tools\ServerResponse\View;

use App\Services\Tools\ServerResponse\ServerResponseResultDTO;

interface ServerResponseHtmlViewInterface
{
    public function response(ServerResponseResultDTO $dto): string;
}