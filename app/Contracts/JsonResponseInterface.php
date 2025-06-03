<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

interface JsonResponseInterface
{
    /**
     * Return a successful JSON response.
     *
     * @param mixed  $data
     * @param string $message
     * @param int    $code
     * @return JsonResponse
     */
    public function success($data = null, string $message = 'Success', int $code = 200): JsonResponse;

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int    $code
     * @param mixed  $errors  Optional additional errors/details
     * @return JsonResponse
     */
    public function error(string $message = 'Error', int $code = 400, $errors = null): JsonResponse;
}
