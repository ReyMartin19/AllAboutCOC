<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clash Intel</title>
    @vite('resources/css/app.css')
    <style>
        @import url(https://fonts.googleapis.com/css2?family=Lato&display=swap);
        @import url(https://fonts.googleapis.com/css2?family=Open+Sans&display=swap);
        @import url(https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&text=shield,search,trophy,construction,group,engineering,apartment);
        @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css);
    </style>
</head>
<body class="bg-black text-white font-sans">

    <header>
        @include('nav')
    </header>

    <main class="pt-16">
        @yield('content')
    </main>
    
</body>
</html>