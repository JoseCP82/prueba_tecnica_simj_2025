<?php

namespace App\Http\Responses;

use App\Contracts\JsonResponseInterface;
use Illuminate\Http\JsonResponse;

class ApiResponse implements JsonResponseInterface
{
    /**
     * {@inheritdoc}
     */
    public function success($data = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    /**
     * {@inheritdoc}
     */
    public function error(string $message = 'Error', int $code = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'errors'  => $errors,
        ], $code);
    }
}
