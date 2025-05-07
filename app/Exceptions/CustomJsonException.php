<?php

namespace App\Exceptions;

use Exception;
use App\Enums\ErrorType;

class CustomJsonException extends Exception
{
    private ErrorType $errorType;

    public function __construct(ErrorType $errorType)
    {

        //  private int $statusCode = Response::HTTP_BAD_REQUEST,
        parent::__construct(
            $errorType->message(),
            $errorType->statusCode()
        );
        $this->errorType = $errorType;
    }

    public function render()
    {
        return response()->json(
            [
                'error_code' => $this->errorType->errorCode(),
                'message' => $this->errorType->message(),
            ],
            $this->errorType->statusCode(),
        );
    }
}
