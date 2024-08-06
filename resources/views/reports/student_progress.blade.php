<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Progress Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .section {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Student Progress Report</h1>
    <div class="section">
        <h2>Student Information</h2>
        <p>Name: {{ $student->name }}</p>
        <p>Email: {{ $student->email }}</p>
    </div>

    <div class="section">
        <h2>Courses Enrolled</h2>
        @if($courses && $courses->isNotEmpty())
            <ul>
                @foreach($courses as $course)
                    <li>{{ $course->title }}</li>
                @endforeach
            </ul>
        @else
            <p>No courses found.</p>
        @endif
    </div>

    <div class="section">
        <h2>Quiz Scores</h2>
        @if($quizzes && $quizzes->isNotEmpty())
            <ul>
                @foreach($quizzes as $quiz)
                    <li>{{ $quiz->title }}: {{ $quiz->pivot->score }}%</li>
                @endforeach
            </ul>
        @else
            <p>No quizzes found.</p>
        @endif
    </div>
</body>
</html>
