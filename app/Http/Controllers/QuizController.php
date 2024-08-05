<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
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

        return response()->json($quiz, 201);
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
}
