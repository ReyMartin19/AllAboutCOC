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
<div class="flex flex-col justify-center items-center gap-6">
    @isset($player)
    <div class="flex flex-col md:flex-row gap-8 bg-white backdrop-blur-xs  shadow-xl p-8 rounded-xl max-w-4xl w-full md:items-start">

        {{-- Town Hall Image Card --}}
        <div class=" p-4 flex justify-center items-center h-fit">
            <img class="w-40 h-40 object-contain" src="{{ asset('images/TH/Town_Hall' . $player['townHallLevel'] . '.webp') }}" alt="Town Hall {{ $player['townHallLevel'] }}">
        </div>

        {{-- Player Info --}}
        <div class="flex flex-col w-full gap-3">
            <p class="text-3xl font-bold text-blue-900 mb-4 md:text-left">{{ $player['name'] }}</p>

            {{-- Section 1 --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                <p class="bg-blue-200 p-2 rounded">Town Hall: {{ $player['townHallLevel'] }}</p>
                <p class="bg-blue-200 p-2 rounded flex items-center gap-2">
                    <img class="w-8 h-8" src="{{ asset('images/TH/Trophy/' . $leagueImage) }}" alt="{{ $leagueName }}">
                    {{ $player['trophies'] }} <span class="text-sm text-gray-600">({{ $leagueName }})</span>
                </p>
                <p class="bg-blue-200 p-2 rounded">{{ $player['role'] }}</p>
                <p class="bg-blue-200 p-2 rounded flex items-center gap-2">
                    <img class="w-8 h-8" src="{{ asset('images/TH/Icons/shield.png') }}" alt="">
                    {{ $player['defenseWins'] }} <span class="text-sm text-gray-600">(Defense Wins)</span>
                </p>
                <p class="bg-blue-200 p-2 rounded flex items-center gap-2">
                    <img class="w-8 h-8" src="{{ asset('images/TH/Icons/swords.png') }}" alt="">
                    {{ $player['attackWins'] }} <span class="text-sm text-gray-600">(Attack Wins)</span>
                </p>
                <p class="bg-blue-200 p-2 rounded flex items-center gap-2">
                    <img class="w-8 h-8" src="{{ asset('images/TH/Icons/XP.webp') }}" alt="">
                    {{ $player['expLevel'] }} <span class="text-sm text-gray-600">(Experience Level)</span>
                </p>
            </div>

            {{-- Section 2 --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-3">
                <p class="bg-blue-200 p-2 rounded flex items-center gap-2">
                    <img class="w-8 h-8" src="{{ asset('images/TH/Icons/review.png') }}" alt="">
                    {{ $player['warStars'] }} <span class="text-sm text-gray-600">(War Stars)</span>
                </p>
                <p class="bg-blue-300 p-2 rounded flex items-center gap-2"><img class="w-8 h-8" src="{{ asset('images/TH/BH/Builder_Hall' . $player['builderHallLevel'] . '.webp') }}" alt="Builder Hall {{ $player['builderHallLevel'] }}">{{ $player['builderHallLevel'] }}</p>
                <p class="bg-blue-200 p-2 rounded flex items-center gap-2">
                    <img class="w-8 h-8" src="{{ asset('images/TH/Icons/GoldC.webp') }}" alt="">
                    {{ $player['clanCapitalContributions'] }} <span class="text-sm text-gray-600">(Contributions)</span>
                </p>
            </div>

            {{-- Section 3 --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                <p class="bg-blue-400 p-2 rounded">{{ $player['clan']['name'] ?? 'No Clan' }}</p>
                <p class="bg-blue-400 p-2 rounded">{{ $player['clan']['clanLevel'] ?? 'No Clan' }} <span class="text-sm text-gray-600">(Clan Level)</span></p>
            </div>
        </div>
    </div>
    @endisset

    @isset($error)
    <p class="text-red-500 text-lg">{{ $error }}</p>
    @endisset
 @include('moreInfo')
 @include('troopsView')
 @include('spells')
</div>

@endsection
