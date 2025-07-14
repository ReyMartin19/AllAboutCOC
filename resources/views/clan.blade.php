@extends('layouts.layout')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Clan Search Results</h2>

    @if(isset($error))
        <p class="text-red-500">{{ $error }}</p>
    @elseif(count($clans) === 0)
        <p>No clans found.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($clans as $clan)
                <div class="bg-white p-4 shadow rounded">
                    <h3 class="text-xl font-bold">{{ $clan['name'] }}</h3>
                    <p><strong>Tag:</strong> {{ $clan['tag'] }}</p>
                    <p><strong>Level:</strong> {{ $clan['clanLevel'] }}</p>
                    <p><strong>Members:</strong> {{ $clan['members'] }}</p>
                    <p><strong>Points:</strong> {{ $clan['clanPoints'] }}</p>
                    <p><strong>Description:</strong> {{ $clan['description'] ?? 'No description.' }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
