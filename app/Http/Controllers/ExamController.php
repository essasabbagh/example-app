<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return Exam::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $exam = Exam::create($request->all());

        return response()->json($exam, 201);
    }

    public function show(Exam $exam)
    {
        return $exam;
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $exam->update($request->all());

        return response()->json($exam, 200);
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return response()->json(null, 204);
    }
}
