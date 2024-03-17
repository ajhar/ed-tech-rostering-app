<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    protected function response(array $messages, $statusCode = 200): JsonResponse
    {
        $msg = '';
        foreach ($messages as $message)
            $msg .= "<li> " . $message;

        return response()->json(['message' => $msg], $statusCode);
    }
}
