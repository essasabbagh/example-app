<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{

    public function generateStudentProgressReport(User $student)
    {
        $courses = $student->courses()->get();
        $quizzes = $student->quizzes()->get();

        if ($courses->isEmpty() || $quizzes->isEmpty()) {
            return response()->json([
                'user_name' => $student->name,
                'message' => 'No courses or quizzes found for the student'
            ], 404);
        }

        $pdf = Pdf::loadView('reports.student_progress', compact('student', 'courses', 'quizzes'));

        return $pdf->download('student_progress_report.pdf');
    }
}
