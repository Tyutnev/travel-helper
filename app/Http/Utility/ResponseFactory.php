<?php

namespace App\Http\Utility;

use Illuminate\Http\JsonResponse;

class ResponseFactory
{
    public function success(string $message, array $data = []): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'data'    => $data
        ]);
    }

    public function error(string $message, array $data = [], int $code = 403): JsonResponse
    {
        return new JsonResponse([
            'message' => $message,
            'data'    => $data
        ], $code);
    }
}
