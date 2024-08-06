<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use App\Models\SectionProgress;
use App\Models\User;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(Course $course)
    {
        $sections = $course->sections;

        return response()->json($sections);
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $section = $course->sections()->create($validated);

        return response()->json($section, 201);
    }

    public function completeSection(Request $request, Section $section)
    {
        $user = $request->user(); // Assuming you have user authentication

        $progress = SectionProgress::firstOrCreate([
            'user_id' => $user->id,
            'section_id' => $section->id,
        ]);

        $progress->is_completed = true;
        $progress->save();

        return response()->json(['message' => 'Section marked as completed']);
    }

    public function canAccessNextSection(User $user, Section $section)
    {
        $previousSection = $section->course->sections()->where('id', '<', $section->id)->orderBy('id', 'desc')->first();

        if ($previousSection) {
            $progress = $user->sectionProgress()->where('section_id', $previousSection->id)->first();
            if (!$progress || !$progress->is_completed) {
                return false; // User cannot access the next section
            }
        }

        return true; // User can access the section
    }
}
