<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course = new Course();
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->teacher_id = Auth::id();
        $course->save();

        return response()->json($course, 201);
    }

    public function show(Course $course)
    {
        return $course;
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course->update($request->all());

        return response()->json($course, 200);
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json(null, 204);
    }
}
