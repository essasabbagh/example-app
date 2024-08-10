<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get all courses
        $courses = Course::all();

        // Create sections for each course
        $courses->each(function ($course) {
            // Create a random number of sections per course
            Section::factory(rand(2, 5))->create([
                'course_id' => $course->id,
            ]);
        });
    }
}
