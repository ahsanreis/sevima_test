<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Welcome to InstaApp</title>
</head>
<body>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
        @yield('content')
    </div>
</body>
</html>
