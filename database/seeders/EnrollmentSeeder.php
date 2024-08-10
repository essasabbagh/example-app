<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get all students (assuming 'Student' role is already assigned)
        $students = User::role('Student')->get();

        // Get all courses
        $courses = Course::all();

        // Enroll each student in a random number of courses
        $students->each(function ($student) use ($courses) {
            // Pick a random number of courses for the student to enroll in
            $enrolledCourses = $courses->random(rand(1, 3));

            $enrolledCourses->each(function ($course) use ($student) {
                Enrollment::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                ]);
            });
        });
    }
}
