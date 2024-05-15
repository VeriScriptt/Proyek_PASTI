<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $message }}</p>
    <a href="{{ url()->previous() }}">Go Back</a>
</body>
</html>