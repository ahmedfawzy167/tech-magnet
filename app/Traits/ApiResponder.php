<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    protected function success($data = null, $message = 'Success', $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function created($data = null, $message = 'Created successfully', $statusCode = 201): JsonResponse
    {
        return $this->success($data, $message, $statusCode);
    }

    protected function error($message = 'Error', $statusCode = 400): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $statusCode);
    }

    protected function notFound($message = 'Not Found'): JsonResponse
    {
        return $this->error($message, 404);
    }

    protected function conflict($message = 'Conflict'): JsonResponse
    {
        return $this->error($message, 409);
    }

    protected function unauthorized($message = 'Unauthorized'): JsonResponse
    {
        return $this->error($message, 401);
    }

    protected function forbidden($message = 'Forbidden'): JsonResponse
    {
        return $this->error($message, 403);
    }

    protected function validationError($message = 'Unprocessable Content'): JsonResponse
    {
        return $this->error($message, 422);
    }

    protected function serverError($message = 'Internal Server Error'): JsonResponse
    {
        return $this->error($message, 500);
    }
}
