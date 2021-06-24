<?php

namespace App\Helper;

class ErroreableResponse {

    public $response;

    public function __construct()
    {
        $this->errors = [];
    }

    public function setResponse(array $response): void
    {
        $this->response = $response;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setError($error): void
    {
        array_push($this->errors, $error);
    }

    public function hasErrors(): bool
    {
        return count($this->getErrors()) > 0;
    }

    public function getFirstError()
    {
        return $this->errors[0] ?? null;
    }
}