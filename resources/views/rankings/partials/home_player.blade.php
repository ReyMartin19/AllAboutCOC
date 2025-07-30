@php
    $isFullPage = $isFullPage ?? false;
    $limit = $isFullPage ? 50 : 5;
    $players = collect($homeVillageTop)->take($limit);
@endphp

@if($isFullPage)
    {{-- Full page table view remains the same --}}

    <div class="overflow-auto rounded-sm p-6 mb-8">
        <table class="min-w-full text-sm text-white">
            <thead class="bg-blue-600 border-b border-gray-600">
                <tr>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300">Rank</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">Player</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">Clan</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">Trophies</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                    <tr class="border-b border-gray-700 hover:bg-gray-800/70 transition-colors duration-200">
                    <td class="px-4 py-4 text-center">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-black font-bold text-sm
                                @if($player['rank'] == 1) bg-red-500
                                @elseif($player['rank'] == 2) bg-orange-500
                                @elseif($player['rank'] == 3) bg-amber-500
                                @else bg-yellow-500
                                @endif">
                                {{ $player['rank'] }}
                            </span>
                        </td>                        
                        <td class="px-4 py-4 text-center font-bold text-white"><a href="/player/{{ str_replace('#', '', $player['tag']) }}" class="hover:underline">{{ $player['name'] }}</a></td>
                        <td class="px-4 py-4 text-center">
                            @if(isset($player['clan']['tag']) && !empty($player['clan']['tag']))
                                <a href="{{ route('clan.show', ['tag' => ltrim($player['clan']['tag'], '#')]) }}" class="hover:underline">
                                    {{ $player['clan']['name'] ?? 'Unknown Clan' }}
                                </a>
                            @else
                                <span class="text-gray-400 italic">No Clan</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-center text-yellow-400">{{ $player['trophies'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="space-y-4">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-lg font-bold text-blue-400">Home Village Top Players</h3>
            <a href="{{ route('rankings') }}" class="text-xs font-medium text-blue-400 hover:text-white transition-colors duration-200 flex items-center group">
                View All
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>         
        </div>
        
        @foreach($players as $player)
            <div class="flex items-center justify-between p-3 bg-gray-800/50 rounded-lg hover:bg-gray-800/70 transition-colors duration-200">
                <div class="flex items-center space-x-3">
                    <span class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-sm"
                        >{{ $player['rank'] }}
                    </span>
                    <span class="font-medium">{{ $player['name'] }}</span>
                </div>
                <span class="text-yellow-400 font-bold">{{ $player['trophies'] }}</span>
            </div>
        @endforeach
    </div>
@endif