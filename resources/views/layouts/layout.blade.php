<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clash Intel</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        @import url(https://fonts.googleapis.com/css2?family=Lato&display=swap);
        @import url(https://fonts.googleapis.com/css2?family=Open+Sans&display=swap);
        @import url(https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&text=shield,search,trophy,construction,group,engineering,apartment);
        @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css);
    </style>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- In your layout.blade.php inside <head> -->
</head>
<body class="bg-black text-white font-sans">

    <header>
        @include('layouts.nav')
    </header>

    <main class="pt-16">
        @yield('content')
    </main>
    
    <footer class="bg-gray-950 border-t border-gray-800 py-12">
        @include('layouts.footer')
    </footer>
</body>
</html>