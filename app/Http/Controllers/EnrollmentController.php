<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Request $request, Course $course)
    {
        $user = $request->user();

        // Ensure the user is not already enrolled
        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return response()->json(['message' => 'Already enrolled in this course.'], 400);
        }

        // Enroll the user
        // $user->enrolledCourses()->attach($course->id);
        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        return response()->json(['message' => 'Successfully enrolled in the course.'], 200);
    }

    public function unenroll(Request $request, Course $course)
    {
        $user = $request->user();

        // Ensure the user is enrolled in the course
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return response()->json(['message' => 'Not enrolled in this course.'], 400);
        }

        // Unenroll the user
        $enrollment->delete();

        return response()->json(['message' => 'Successfully unenrolled from the course.'], 200);
    }
}
