<?php

namespace App\Services\Response;

use Illuminate\Http\JsonResponse;

interface ToolJsonResponse
{
    /**
     * @param mixed $data
     * @param string $status
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function response(mixed $data, string $status, string $message, int $code): JsonResponse;
}