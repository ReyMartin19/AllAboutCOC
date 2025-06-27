<!DOCTYPE html>
<html>
<head>
    <title>All About COC - Player Search</title>
    @vite('resources/css/app.css')
</head>
<body>

    <div class="min-h-screen flex flex-col justify-center items-center bg-blue-200">

        <div class="bg-white/35 backdrop-blur-2xl p-15 border-none rounded-xl">
            <h1 class="mb-7 text-2xl font-bold">Clash of Clans Player Search</h1>

            <form class="flex flex-col items-center" action="{{ route('search') }}" method="POST">
                @csrf
                <input class="mb-3 border border-gray-400 p-2 rounded-sm bg-white/35 focus:backdrop-blur-2xl focus:border-blue-400 focus:border-2 outline-none"  type="text" name="tag" placeholder="88JY8P2" required>
                <button class="w-auto px-7 border-none rounded-sm py-2 bg-blue-400 hover:bg-blue-600 text-white hover:shadow-2xl" type="submit">Search</button>
            </form>
        </div>   

        @isset($player)
            <h2>Player Info</h2>
            <p><strong>Name:</strong> {{ $player['name'] }}</p>
            <p><strong>Town Hall:</strong> {{ $player['townHallLevel'] }}</p>
            <p><strong>Trophies:</strong> {{ $player['trophies'] }}</p>
            <p><strong>Clan:</strong> {{ $player['clan']['name'] ?? 'No Clan' }}</p>
        @endisset

        @isset($error)
            <p style="color:red;">{{ $error }}</p>
        @endisset

    </div>
</body>
</html>
