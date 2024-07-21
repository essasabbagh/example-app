<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Edit Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        form {
            max-width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <form action="{{route('computers.update', $computer)}}" method="POST">
    @csrf
    @method('PUT')
        <label for="computer-name">Computer Name:</label>
        <input type="text" id="computer-name" name="computer-name" value="{{$computer->name}}">

        @error('computer-name')
            {{$message}}
        @enderror

        <label for="computer-price">Computer Price:</label>
        <input type="number" id="computer-price" name="computer-price"  min="0" step="0.01" value="{{$computer->price}}">
        @error('computer-price')
            {{$message}}
        @enderror

        <input type="submit" value="Submit">
    </form>

</body>
</html>
