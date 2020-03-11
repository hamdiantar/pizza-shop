<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse extends Response
{
    /**
     * Messages.
     *
     * @var array
     */
    protected $messages = [];

    public function create(): JsonResponse
    {
        return new JsonResponse(
            [
                'code' => $this->getCode(),
                'errors' => $this->getErrors(),
                'data' => $this->getData(),
                'messages' => $this->getMessages()
            ],
            $this->getCode()
        );
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function setMessages(array $messages): ApiResponse
    {
        $this->messages = $messages;
        return $this;
    }
}
