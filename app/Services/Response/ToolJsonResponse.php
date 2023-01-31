<?php

namespace App\Services\Response;

use Illuminate\Http\JsonResponse;

interface ToolJsonResponse
{
    public function response(mixed $data, string $status, string $message, int $code): JsonResponse;
}