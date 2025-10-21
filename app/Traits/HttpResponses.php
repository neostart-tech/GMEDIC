<?php

namespace App\Traits;

trait HttpResponses
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Succes',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($message, $code = 404)
    {
        return response([
            'message' => $message,
        ], $code);
    }
}
