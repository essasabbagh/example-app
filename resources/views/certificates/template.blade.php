<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .certificate {
            border: 10px solid #ccc;
            padding: 20px;
            width: 80%;
            margin: 50px auto;
        }
        h1 {
            font-size: 50px;
        }
        p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>Certificate of Completion</h1>
        <p>This is to certify that</p>
        <h2>{{ $user->name }}</h2>
        <p>has successfully completed the course</p>
        <h2>{{ $course->title }}</h2>
        <p>on {{ now()->format('F j, Y') }}</p>
    </div>
</body>
</html>
