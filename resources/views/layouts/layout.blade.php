<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clash Intel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-200">

    <header class=""> <!-- Ensure header does not extend background -->
        @include('nav')
    </header>

    <main class="pt-30"> <!-- Add margin-top to create space -->
        @yield('content')
    </main>
    
</body>
</html>