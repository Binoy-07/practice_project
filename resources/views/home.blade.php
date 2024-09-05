<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body>
    <h1>Welcome to the Home Page</h1>
    <p>Click the button below to download your PDF.</p>

    <!-- Button to trigger PDF download -->
    <a href="{{ route('download.pdf') }}" class="btn btn-primary">Download PDF</a>
</body>
</html>