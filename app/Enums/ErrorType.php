<?php
namespace App\Enums;

use Illuminate\Http\Response;

enum ErrorType
{
    // Enum cases with associated data: errorCode, statusCode, and message
    case FAILED_EXAM;
    case HAVE_TO_COMPLETE_LESSON;
    case UNAUTHORIZED_ACCESS;
    case INVALID_INPUT;

    public function details(): array
    {
        return match ($this) {
            self::FAILED_EXAM => [
                'errorCode' => 1001,
                'statusCode' => 422,
                'message' => 'Failed the exam.',
            ],
            self::HAVE_TO_COMPLETE_LESSON => [
                'errorCode' => 1002,
                'statusCode' => 403,
                'message' => 'You must complete the lesson.',
            ],
            self::UNAUTHORIZED_ACCESS => [
                'errorCode' => 1003,
                'statusCode' => 401,
                'message' => 'Unauthorized access.',
            ],
            self::INVALID_INPUT => [
                'errorCode' => 1004,
                'statusCode' => Response::HTTP_BAD_REQUEST,
                'message' => 'Invalid input provided.',
            ],
        };
    }

    public function errorCode(): int
    {
        return $this->details()['errorCode'];
    }

    public function statusCode(): int
    {
        return $this->details()['statusCode'];
    }

    public function message(): string
    {
        return $this->details()['message'];
    }
}
