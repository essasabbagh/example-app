<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function showLesson(User $user, Lesson $lesson)
    {
        $section = $lesson->section;

        if (!$this->canAccessNextSection($user, $section)) {
            return response()->json(['message' => 'Complete the previous section\'s quiz to access this section'], 403);
        }

        // Return the lesson content
        return view('lessons.show', compact('lesson'));
    }
}
