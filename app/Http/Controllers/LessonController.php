<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Section $section)
    {
        $lessons = $section->lessons;

        return response()->json($lessons);
    }

    public function store(Request $request, Section $section)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $lesson = $section->lessons()->create(array_merge($validated, [
            'course_id' => $section->course_id,
        ]));

        return response()->json($lesson, 201);
    }

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
