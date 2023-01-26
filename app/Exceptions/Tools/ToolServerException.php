<?php

namespace App\Exceptions\Tools;

use Throwable;

class ToolServerException extends ToolException
{
    public function __construct($message, $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
