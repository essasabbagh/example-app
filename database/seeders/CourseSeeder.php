<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // Get all teachers (assuming 'Teacher' role is already assigned)
        $teachers = User::role('Teacher')->get();

        // Create courses for each teacher
        $teachers->each(function ($teacher) {
            // Assign a random number of courses per teacher
            Course::factory(rand(3, 5))->create([
                'teacher_id' => $teacher->id, // Assuming the Course model has a 'teacher_id' foreign key
            ]);
        });


        // // Ensure there are teachers in the users table
        // $teacher = User::where('role', 'Teacher')->first();

        // if (!$teacher)
        //     return;

        // // Seed the courses table
        // Course::create([
        //     'teacher_id' => $teacher->id,
        //     'title' => 'Introduction to Psychology',
        //     'description' => 'An introductory course on psychology covering the basics of human behavior.',
        // ]);

        // Course::create([
        //     'teacher_id' => $teacher->id,
        //     'title' => 'Advanced Mathematics',
        //     'description' => 'A comprehensive course on advanced mathematical concepts.',
        // ]);

        // Add more courses as needed
    }
}
