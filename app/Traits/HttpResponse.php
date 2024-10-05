<?php

namespace App\Traits;

trait HttpResponse
{
    public function success($message, $data = null, $status = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public function error($message, $data = null, $status = 400)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}