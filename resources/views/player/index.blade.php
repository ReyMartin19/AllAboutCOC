@isset($player)
    @php
        $league = determine_league($player['trophies']);
    @endphp
@endisset

@extends('layouts.layout')

@section('content')
<div class="w-full max-w-6xl mx-auto p-4 bg-black text-white min-h-screen relative">
    <div class="mb-8">
        @isset($player)
        <div class="bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-700 mb-8">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="flex-shrink-0">
                    <img class="w-24 h-24 object-contain" src="{{ asset('images/TH/Town_Hall' . $player['townHallLevel'] . '.webp') }}" alt="Town Hall {{ $player['townHallLevel'] }}">
                </div>
                <div class="flex-grow">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">{{ $player['name'] }}</h2>
                            <p class="text-gray-400 mb-1">Player Tag: {{ $player['tag'] }}</p>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-yellow-400">castle</span>
                                <span class="font-semibold">Town Hall Level {{ $player['townHallLevel'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('images/TH/Trophy/' . $league['image']) }}" 
                                    alt="{{ $league['name'] }}" 
                                    class="w-6 h-6 inline-block mr-2" />
                                <span class="font-semibold">{{ $player['trophies'] }} Trophies ({{ $league['name'] }})</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-green-400"></span>
                                <span>XP Level: {{ $player['expLevel'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-purple-400">star</span>
                                <span>War Stars: {{ $player['warStars'] ?? '0' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-blue-400">group</span>
                                <span>Clan: {{ $player['clan']['name'] ?? 'No Clan' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Player Stats -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                @include('player.partials.stats')
            </div>

            <!-- Clan Information -->
            @if(isset($player['clan']))
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 hover:border-primary-600 transition-all duration-300">
                @include('player.partials.clan_info')
            </div>
            @endif

            <!-- Builder Base -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                @include('player.partials.builder_base_info')
            </div>
        </div>

        <!-- Heroes Section -->
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-8">
            <div class="text-xl font-bold mb-4 text-primary-400 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">person</span>
                    Heroes
                </div>
            </div>
            @include('player.partials.heroes')
        </div>

        <!-- Troops Section -->
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-8">
            <h3 class="text-xl font-bold mb-4 text-primary-400 flex items-center gap-2">
                <span class="material-symbols-outlined">shield</span>
                Troops
            </h3>
            @include('player.partials.troops')
        </div>

        <!-- Spells Section -->
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-8">
            <div class="text-xl font-bold mb-4 text-primary-400 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined"></span>
                    Spells
                </div>
            </div>
            @include('player.partials.spells')
        </div>

        @endisset

        @isset($error)
        <div class="bg-red-900/30 border border-red-700 rounded-xl p-6 text-center backdrop-blur-sm">
            <p class="text-red-300 font-medium">{{ $error }}</p>
        </div>
        @endisset

        <div class="text-center">
            <a href="{{ route('search') }}" class="px-8 py-3 bg-primary-600 hover:bg-primary-700 rounded-lg font-semibold transition-colors flex items-center gap-2 mx-auto">
                <span class="material-symbols-outlined">search</span>
                Search Another Player
            </a>
        </div>
    </div>
</div>
@endsection