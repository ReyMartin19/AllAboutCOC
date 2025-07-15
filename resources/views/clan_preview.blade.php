@extends('layouts.layout')

@section('content')
<div class="max-w-md mx-auto mt-6 mb-8">
    {{-- Header with back button --}}
    <div class="flex items-center justify-between mb-8">
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="text-sm">Back</span>
        </a>
        <h2 class="text-2xl font-bold text-white">Search Results</h2>
        <div class="w-16"></div> {{-- Spacer for balance --}}
    </div>

    {{-- Results container --}}
    <div class="space-y-6 ">
        @if(isset($error))
            {{-- Error state --}}
            <div class="bg-red-900/30 border border-red-700 rounded-xl p-6 text-center backdrop-blur-sm">
                <p class="text-red-300 font-medium">{{ $error }}</p>
            </div>
        @elseif(count($clans) === 0)
            {{-- Empty state --}}
            <div class="bg-gray-800/30 border border-gray-700 rounded-xl p-6 text-center backdrop-blur-sm">
                <p class="text-gray-400">No clans found matching your search</p>
            </div>
        @else
            {{-- Clan results --}}
            @foreach($clans as $clan)
                <div class="bg-gray-800/30 border border-gray-700 rounded-xl p-6 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-200 backdrop-blur-sm flex items-center justify-center space-x-4">
                    {{-- Clan badge and name --}}
                    <div class="flex items-center">
                        <img src="{{ $clan['badgeUrls']['small'] }}" 
                             alt="Clan Badge" 
                             class="w-16 h-16 object-contain">
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-white">{{ $clan['name'] }}</h3>
                            <div class="mt-1"></div> {{-- Added spacing here --}}
                            <span class="text-gray-400 text-sm">{{ $clan['tag'] }}</span>
                        </div>
                    </div>

                    {{-- Clan stats --}}
                    <div class="flex justify-center space-x-8 text-center py-2">
                        <div class="flex flex-col items-center">
                            <p class="text-gray-400 text-sm">Members</p>
                            <p class="text-white font-medium">{{ $clan['members'] }}/50</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="text-gray-400 text-sm">Points</p>
                            <p class="text-yellow-400 font-medium">{{ number_format($clan['clanPoints']) }}</p>
                        </div>
                    </div>

                    {{-- View button --}}
                    <div class="pt-2">
                        <a href="{{ route('clan', ['tag' => $clan['tag']]) }}" 
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">
                           View
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection