<?php

namespace App\Helper;

class ReturnData
{
    public function create(array $errors, int $code, $data = null, array $message = []): array
    {
        return [
            'errors' => $errors,
            'code' => $code,
            'data' => $data,
            'messages' => $message,
        ];
    }
}
