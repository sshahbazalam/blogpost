<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    /**
     * Standard success response
     *
     * @param string $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function successApiResponse(string $message, mixed $data = [], int $statusCode = 200): JsonResponse
    {
        return new JsonResponse([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'errors' => null
        ], $statusCode);
    }

    /**
     * Standard error response
     *
     * @param string $message
     * @param mixed $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorApiResponse(string $message, mixed $errors = null, int $statusCode = 400): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'message' => $message,
            'data' => null,
            'errors' => $errors
        ], $statusCode);
    }
}
