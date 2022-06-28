<?php

namespace App\Utils;

trait ResponseFormatter
{
    public function successResponse($data = [], $message = 'success', $code = 200)
    {
        $data = array_merge([
            'code' => $code,
            'success' => true,
            'message' => $message,
        ], $data);

        return response($data);
    }

    public function failedResponse($data = [], $message = 'Something is missing out!', $code = 400)
    {
        $data = array_merge([
            'code' => $code,
            'success' => false,
            'message' => $message,
        ], $data);

        return response([$data], 422);
    }

    public function sendSuccessResponse($data = [], $message = 'success', $code = 200)
    {
        $this->successResponse($data, $message, $code)->send();
        exit;
    }

    public function sendFailedResponse($data = [], $message = 'Something is missing out!', $code = 400)
    {
        $this->failedResponse($data, $message, $code)->send();
        exit;
    }
}
