<?php

namespace App\Services\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ToolJsonResponseImpl implements ToolJsonResponse
{
    /**
     * @param mixed $data
     * @param string $status
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function response(mixed $data, string $status = 'success', string $message = '', int $code = 200): JsonResponse
    {
        return Response::json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
            'code' => $code,
        ], $code);
    }
}