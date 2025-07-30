@php
    $isFullPage = $isFullPage ?? false;
    $limit = $isFullPage ? 50 : 5;
    $clans = collect($capitalClanTop)->take($limit);
@endphp

@if($isFullPage)

<div class="overflow-auto rounded-sm p-6 mb-8">
        <table class="min-w-full text-sm text-white">
            <thead class="bg-blue-600 border-b border-gray-600">
                <tr>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300">Rank</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">Clan Name</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">Members</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-300 text-center">Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clans as $clan)
                    <tr class="border-b border-gray-700 hover:bg-gray-800/70 transition-colors duration-200">
                        <td class="px-4 py-4 text-center">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-black font-bold text-sm
                                @if($clan['rank'] == 1) bg-red-500
                                @elseif($clan['rank'] == 2) bg-orange-500
                                @elseif($clan['rank'] == 3) bg-amber-500
                                @else bg-yellow-500
                                @endif">
                                {{ $clan['rank'] }}
                            </span>
                        </td>                        <td class="px-4 py-4 text-center font-bold text-white"><a href="{{ route('clan.show', ['tag' => ltrim($clan['tag'], '#')]) }}" class="hover:underline">{{ $clan['name'] }}</a></td>
                        <td class="px-4 py-4 text-center">{{ $clan['members'] }}/50</td>
                        <td class="px-4 py-4 text-center text-yellow-400">{{ $clan['clanCapitalPoints'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
<div class="space-y-4">
        <div class="flex items-center justify-between gap-8 mb-3">
            <h3 class="text-lg font-bold text-blue-400">Top Clan Capitals</h3>
            <a href="{{ route('rankings') }}" class="text-xs font-medium text-blue-400 hover:text-white transition-colors duration-200 flex items-center group">
                View All
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>         
        </div>
        
        @foreach($clans as $clan)
            <div class="flex items-center justify-between gap-5 p-3 bg-gray-800/50 rounded-lg hover:bg-gray-800/70 transition-colors duration-200">
                <div class="flex items-center space-x-3 mr-5">
                    <span class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-sm"
                        >{{ $clan['rank'] }}
                    </span>
                    <span class="font-medium">{{ $clan['name'] }}</span>
                </div>
                <span class="text-yellow-400 font-bold">{{ $clan['clanCapitalPoints'] }}</span>
            </div>
        @endforeach
    </div>
@endif
