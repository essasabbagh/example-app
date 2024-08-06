<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Notifications\QuizNotification;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        return Quiz::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $quiz = Quiz::create($request->all());

        // Notify all students enrolled in the course
        $course = $quiz->course;
        $students = $course->students;

        foreach ($students as $student) {
            $student->notify(new QuizNotification($quiz, $course));
        }

        // return response()->json($quiz, 201);
        return response()->json([
            'data' =>  $quiz,
            'message' => 'Quiz created and students notified'
        ], 201);
    }

    public function show(Quiz $quiz)
    {
        return $quiz;
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $quiz->update($request->all());

        return response()->json($quiz, 200);
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return response()->json(null, 204);
    }

    public function attempt(Request $request, Quiz $quiz)
    {
        // Logic to handle the quiz attempt
        $validated = $request->validate([
            'answers' => 'required|array',
        ]);

        // Example of grading the quiz
        $result = $quiz->grade($validated['answers']);

        return response()->json([
            'score' => $result['score'],
            'passed' => $result['passed'],
        ], 200);
    }
}
