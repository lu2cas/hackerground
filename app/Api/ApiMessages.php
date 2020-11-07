<?php


namespace App\Api;


class ApiMessages
{
    private $message;
    private $errors;

    public function __construct(string $message, $errors = []) {
        $this->message = $message;
        $this->errors = $errors;
    }

    public function getMessage() {
        return [
            'message' => $this->message,
            'errors' => $this->errors
        ];
    }
}
