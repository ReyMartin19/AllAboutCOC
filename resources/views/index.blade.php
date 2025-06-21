<!DOCTYPE html>
<html>
<head>
    <title>All About COC - Player Search</title>
</head>
<body>
    <h1>Clash of Clans Player Search</h1>

    <form action="{{ route('search') }}" method="POST">
        @csrf
        <input type="text" name="tag" placeholder="Enter player tag (e.g. 88JY8P2)" required>
        <button type="submit">Search</button>
    </form>

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
</body>
</html>
