<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReportController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'throttle:api'])
    ->group(function () {
        Route::get('/profile', [UserController::class, 'profile']);
        Route::get('/user/avatar', [UserController::class, 'getAvatar']);
        Route::post('/user/avatar', [UserController::class, 'uploadAvatar']);
        // Other protected routes
    });

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::get('/courses/{course}', [CourseController::class, 'show']);
    Route::put('/courses/{course}', [CourseController::class, 'update']);
    Route::delete('/courses/{course}', [CourseController::class, 'destroy']);

    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll']);
    Route::post('/courses/{course}/unenroll', [EnrollmentController::class, 'unenroll']);

    Route::post('/courses/{course}/certificate', [CertificateController::class, 'generateCertificate']);
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'downloadCertificate']);

    // Quiz routes
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::post('/quizzes', [QuizController::class, 'store']);
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
    Route::put('/quizzes/{quiz}', [QuizController::class, 'update']);
    Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy']);

    // Quiz attempt routes
    Route::post('/quizzes/{quiz}/attempts', [QuizAttemptController::class, 'store']);
    Route::get('/quiz-attempts/{quizAttempt}', [QuizAttemptController::class, 'show']);

    // Exam routes
    Route::get('/exams', [ExamController::class, 'index']);
    Route::post('/exams', [ExamController::class, 'store']);
    Route::get('/exams/{exam}', [ExamController::class, 'show']);
    Route::put('/exams/{exam}', [ExamController::class, 'update']);
    Route::delete('/exams/{exam}', [ExamController::class, 'destroy']);


    Route::get('/reports/student/{student}/progress', [ReportController::class, 'generateStudentProgressReport']);
});
