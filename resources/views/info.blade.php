@isset($player)
    @php
        $trophies = $player['trophies'];
        $leagueImage = 'Unranked_League.webp';
        $leagueName = 'Unranked';

        if ($trophies >= 400 && $trophies <= 499) {
            $leagueImage = 'Bronze_League.webp';
            $leagueName = 'Bronze III';
        } elseif ($trophies <= 599) {
            $leagueImage = 'Bronze_League.webp';
            $leagueName = 'Bronze II';
        } elseif ($trophies <= 799) {
            $leagueImage = 'Bronze_League.webp';
            $leagueName = 'Bronze I';
        } elseif ($trophies <= 999) {
            $leagueImage = 'Silver_League.webp';
            $leagueName = 'Silver III';
        } elseif ($trophies <= 1199) {
            $leagueImage = 'Silver_League.webp';
            $leagueName = 'Silver II';
        } elseif ($trophies <= 1399) {
            $leagueImage = 'Silver_League.webp';
            $leagueName = 'Silver I';
        } elseif ($trophies <= 1599) {
            $leagueImage = 'Gold_League.webp';
            $leagueName = 'Gold III';
        } elseif ($trophies <= 1799) {
            $leagueImage = 'Gold_League.webp';
            $leagueName = 'Gold II';
        } elseif ($trophies <= 1999) {
            $leagueImage = 'Gold_League.webp';
            $leagueName = 'Gold I';
        } elseif ($trophies <= 2199) {
            $leagueImage = 'Crystal_League.webp';
            $leagueName = 'Crystal III';
        } elseif ($trophies <= 2399) {
            $leagueImage = 'Crystal_League.webp';
            $leagueName = 'Crystal II';
        } elseif ($trophies <= 2599) {
            $leagueImage = 'Crystal_League.webp';
            $leagueName = 'Crystal I';
        } elseif ($trophies <= 2799) {
            $leagueImage = 'Master_League.webp';
            $leagueName = 'Master III';
        } elseif ($trophies <= 2999) {
            $leagueImage = 'Master_League.webp';
            $leagueName = 'Master II';
        } elseif ($trophies <= 3199) {
            $leagueImage = 'Master_League.webp';
            $leagueName = 'Master I';
        } elseif ($trophies <= 3499) {
            $leagueImage = 'Champion_League.webp';
            $leagueName = 'Champion III';
        } elseif ($trophies <= 3799) {
            $leagueImage = 'Champion_League.webp';
            $leagueName = 'Champion II';
        } elseif ($trophies <= 4099) {
            $leagueImage = 'Champion_League.webp';
            $leagueName = 'Champion I';
        } elseif ($trophies <= 4399) {
            $leagueImage = 'Titan_League.webp';
            $leagueName = 'Titan III';
        } elseif ($trophies <= 4699) {
            $leagueImage = 'Titan_League.webp';
            $leagueName = 'Titan II';
        } elseif ($trophies <= 4999) {
            $leagueImage = 'Titan_League.webp';
            $leagueName = 'Titan I';
        } elseif ($trophies >= 5000) {
            $leagueImage = 'Legend_League.webp';
            $leagueName = 'Legend League';
        }
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
                                <img src="{{ asset('images/TH/Trophy/' . $leagueImage) }}" 
                                    alt="{{ $leagueName }}" 
                                    class="w-6 h-6 inline-block mr-2" />
                                <span class="font-semibold">{{ $player['trophies'] }} Trophies ({{ $leagueName }})</span>
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
                <h3 class="text-xl font-bold mb-4 text-primary-400 flex items-center gap-2">
                    <span class="material-symbols-outlined">analytics</span>
                    Player Stats
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-red-400">landscape</span>
                            Attack Wins
                        </span>
                        <span class="font-bold">{{ $player['attackWins'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-400">shield</span>
                            Defense Wins
                        </span>
                        <span class="font-bold">{{ $player['defenseWins'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-400"></span>
                            Donations
                        </span>
                        <span class="font-bold">{{ $player['donations'] ?? '0' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-yellow-400"></span>
                            Donations Received
                        </span>
                        <span class="font-bold">{{ $player['donationsReceived'] ?? '0' }}</span>
                    </div>
                </div>
            </div>

            <!-- Clan Information -->
            @if(isset($player['clan']))
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 hover:border-primary-600 transition-all duration-300">
                <div class="flex justify-between">
                    <h3 class="text-xl font-bold mb-4 text-primary-400 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined">group</span>
                            Clan Information
                        </div>
                    </h3>
                    <a 
                        class="text-blue p-3 bg-blue-500 rounded-lg" 
                        href="{{ route('clan.show', ['tag' => ltrim($player['clan']['tag'], '#')]) }}"
                    >
                        View
                    </a>
                </div>
                <div class="bg-gray-900 rounded-lg p-4 border border-gray-700">
                    <div class="flex flex-col md:flex-row gap-6 items-center mb-4">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">castle</span>
                        </div>
                        <div class="text-center md:text-left">
                            <h4 class="text-xl font-bold text-blue-400">{{ $player['clan']['name'] }}</h4>
                            <p class="text-gray-400">Tag: {{ $player['clan']['tag'] }} • Level {{ $player['clan']['clanLevel'] }}</p>
                            <div class="inline-block px-3 py-1 bg-green-900 text-green-300 rounded-full text-xs mt-2">
                                {{ ucfirst($player['role']) }}
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div class="bg-gray-800 p-3 rounded-lg text-center hover:bg-gray-700 transition-all">
                            <span class="material-symbols-outlined text-purple-400 text-xl mb-1">star</span>
                            <p class="text-lg font-bold">{{ $player['warStars'] ?? '0' }}</p>
                            <p class="text-xs text-gray-400">War Stars</p>
                        </div>
                        <div class="bg-gray-800 p-3 rounded-lg text-center hover:bg-gray-700 transition-all">
                            <span class="material-symbols-outlined text-orange-400 text-xl mb-1">   </span>
                            <p class="text-lg font-bold">{{ $player['donations'] ?? '0' }}</p>
                            <p class="text-xs text-gray-400">Donations</p>
                        </div>
                        <div class="bg-gray-800 p-3 rounded-lg text-center hover:bg-gray-700 transition-all">
                            <span class="material-symbols-outlined text-red-400 text-xl mb-1"></span>
                            <p class="text-lg font-bold">{{ $player['donationsReceived'] ?? '0' }}</p>
                            <p class="text-xs text-gray-400">Received</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Builder Base -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-xl font-bold mb-4 text-primary-400 flex items-center gap-2">
                    <span class="material-symbols-outlined"></span>
                    Builder Base
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-yellow-400">home</span>
                            Builder Hall Level
                        </span>
                        <span class="font-bold">{{ $player['builderHallLevel'] ?? '0' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-400">trophy</span>
                            Builder Base Trophies
                        </span>
                        <span class="font-bold">{{ $player['builderBaseTrophies'] ?? '0' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-400"></span>
                            Best Builder Base Trophies
                        </span>
                        <span class="font-bold">{{ $player['bestBuilderBaseTrophies'] ?? '0' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-purple-400">castle</span>
                            Clan Capital Contributions
                        </span>
                        <span class="font-bold">{{ $player['clanCapitalContributions'] ?? '0' }}</span>
                    </div>
                </div>
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
            @include('moreInfo')
        </div>

        <!-- Troops Section -->
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-8">
            <h3 class="text-xl font-bold mb-4 text-primary-400 flex items-center gap-2">
                <span class="material-symbols-outlined">shield</span>
                Troops
            </h3>
            @include('troopsView')
        </div>

        <!-- Spells Section -->
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-8">
            <div class="text-xl font-bold mb-4 text-primary-400 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined"></span>
                    Spells
                </div>
            </div>
            @include('spells')
        </div>

        @endisset

        @isset($error)
        <div class="bg-red-900/30 border border-red-700 rounded-xl p-6 text-center backdrop-blur-sm">
            <p class="text-red-300 font-medium">{{ $error }}</p>
        </div>
        @endisset

        <div class="text-center">
            <a href="{{ route('search') }}" class="px-8 py-3 bg-primary-600 hover:bg-primary-700 rounded-lg font-semibold transition-colors flex items-center gap-2 mx-auto inline-block">
                <span class="material-symbols-outlined">search</span>
                Search Another Player
            </a>
        </div>
    </div>
</div>
@endsection