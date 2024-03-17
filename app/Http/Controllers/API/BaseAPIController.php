<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseAPIController extends Controller
{
    public function notFoundMessage()
    {
        return response()->json(['message' => 'Resource not found'], Response::HTTP_NOT_FOUND);
    }

    protected function errorMessage(array $messages, $statusCode = 422): JsonResponse
    {
        return response()->json(['errors' => $messages], $statusCode);
    }
}
