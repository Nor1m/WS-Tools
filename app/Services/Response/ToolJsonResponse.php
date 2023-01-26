<?php

namespace App\Services\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ToolJsonResponse implements ToolJsonResponseInterface
{
    public function response(mixed $data, string $status = 'success', string $message = "", int $code = 200): JsonResponse
    {
        return Response::json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
            'code' => $code,
        ], $code);
    }
}