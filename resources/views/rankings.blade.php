<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
    {{-- Home Village Top 5 --}}
    <div class="bg-gray-900/30 backdrop-blur-sm rounded-2xl border border-gray-800 p-6 hover:border-blue-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10">
        <h3 class="text-xl font-bold mb-6 text-blue-400 flex items-center">
            <span class="material-symbols-outlined mr-2">trophy</span> Top 5 Players - Home Village
        </h3>
        <div class="space-y-4">
            @if(!empty($homeVillageTop))
                @foreach($homeVillageTop as $player)
                <div class="flex items-center justify-between p-3 bg-gray-800/50 rounded-lg hover:bg-gray-800/70 transition-colors duration-200">
                    <div class="flex items-center space-x-3">
                        @if($player['rank'] == 1)
                            <span class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $player['rank'] }}</span>
                        @elseif($player['rank'] == 2)
                            <span class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $player['rank'] }}</span>
                        @elseif($player['rank'] == 3)
                            <span class="w-6 h-6 bg-amber-600 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $player['rank'] }}</span>
                        @elseif($player['rank'] == 4)
                            <span class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center text-white font-bold text-sm">#{{ $player['rank'] }}</span>
                        @else
                            <span class="w-6 h-6 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm">#{{ $player['rank'] }}</span>
                        @endif
                        <span class="font-medium">{{ $player['name'] ?? 'Unknown' }}</span>
                    </div>
                    <span class="text-yellow-400 font-bold">{{ $player['trophies'] }}</span>
                </div>
                @endforeach
            @else
                <p class="text-red-500">No top players found.</p>
            @endif
        </div>
    </div>

    {{-- Builder Base Top 5 --}}
    <div class="bg-gray-900/30 backdrop-blur-sm rounded-2xl border border-gray-800 p-6 hover:border-blue-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10">
        <h3 class="text-xl font-bold mb-6 text-blue-400 flex items-center">
            <span class="material-symbols-outlined mr-2">construction</span> Top 5 Players - Builder Base
        </h3>
        <div class="space-y-4">
            @if(!empty($builderBaseTop))
                @foreach($builderBaseTop as $player)
                <div class="flex items-center justify-between p-3 bg-gray-800/50 rounded-lg hover:bg-gray-800/70 transition-colors duration-200">
                    <div class="flex items-center space-x-3">
                        @if($player['rank'] == 1)
                            <span class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $player['rank'] }}</span>
                        @elseif($player['rank'] == 2)
                            <span class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $player['rank'] }}</span>
                        @elseif($player['rank'] == 3)
                            <span class="w-6 h-6 bg-amber-600 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $player['rank'] }}</span>
                        @elseif($player['rank'] == 4)
                            <span class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center text-white font-bold text-sm">#{{ $player['rank'] }}</span>
                        @else
                            <span class="w-6 h-6 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm">#{{ $player['rank'] }}</span>
                        @endif
                        <span class="font-medium">{{ $player['name'] ?? 'Unknown' }}</span>
                    </div>
                    <span class="text-yellow-400 font-bold">{{ $player['builderBaseTrophies'] }}</span>
                </div>
                @endforeach
            @else
                <p class="text-red-500">No builder base players found.</p>
            @endif
        </div>
    </div>

    {{-- Clan trophies --}}
    <div class="bg-gray-900/30 backdrop-blur-sm rounded-2xl border border-gray-800 p-6 hover:border-blue-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10">
        <h3 class="text-xl font-bold mb-6 text-blue-400 flex items-center">
            <span class="material-symbols-outlined mr-2">group</span> Top 5 Clans - Home Village
        </h3>
        <div class="space-y-4">
            @if(!empty($homeClanTop))
                @foreach($homeClanTop as $clans)
                <div class="flex items-center justify-between p-3 bg-gray-800/50 rounded-lg hover:bg-gray-800/70 transition-colors duration-200">
                    <div class="flex items-center space-x-3">
                        @if($clans['rank'] == 1)
                            <span class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @elseif($clans['rank'] == 2)
                            <span class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @elseif($clans['rank'] == 3)
                            <span class="w-6 h-6 bg-amber-600 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @elseif($clans['rank'] == 4)
                            <span class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center text-white font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @else
                            <span class="w-6 h-6 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @endif
                        <span class="font-medium">{{ $clans['name'] ?? 'Unknown' }}</span>
                    </div>
                    <span class="text-yellow-400 font-bold">{{ $clans['clanPoints'] }}</span>
                </div>
                @endforeach
            @else
                <p class="text-red-500">No top clans found.</p>
            @endif
        </div>
    </div>

    
</div>

<div class="flex gap-8 mb-16 justify-center">
    {{-- Builder Base Clan trophies --}}
    <div class="bg-gray-900/30 backdrop-blur-sm rounded-2xl border border-gray-800 p-6 hover:border-blue-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10">
        <h3 class="text-xl font-bold mb-6 text-blue-400 flex items-center">
            <span class="material-symbols-outlined mr-2">engineering</span> Top 5 Clans - Builder Base
        </h3>
        <div class="space-y-4">
            @if(!empty($builderClanTop))
                @foreach($builderClanTop as $clans)
                <div class="flex items-center justify-between p-3 bg-gray-800/50 rounded-lg hover:bg-gray-800/70 transition-colors duration-200">
                    <div class="flex items-center space-x-3">
                        @if($clans['rank'] == 1)
                            <span class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @elseif($clans['rank'] == 2)
                            <span class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @elseif($clans['rank'] == 3)
                            <span class="w-6 h-6 bg-amber-600 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @elseif($clans['rank'] == 4)
                            <span class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center text-white font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @else
                            <span class="w-6 h-6 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @endif
                        <span class="font-medium">{{ $clans['name'] ?? 'Unknown' }}</span>
                    </div>
                    <span class="text-yellow-400 font-bold">{{ $clans['clanBuilderBasePoints'] }}</span>
                </div>
                @endforeach
            @else
                <p class="text-red-500">No top clans found.</p>
            @endif
        </div>
    </div>

    {{-- Clan Capital Top --}}
    <div class="bg-gray-900/30 backdrop-blur-sm rounded-2xl border border-gray-800 p-6 hover:border-blue-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10">
        <h3 class="text-xl font-bold mb-6 text-blue-400 flex items-center">
            <span class="material-symbols-outlined mr-2">apartment</span> Top 5 Clans - Clan Capital
        </h3>
        <div class="space-y-4">
            @if(!empty($capitalClanTop))
                @foreach($capitalClanTop as $clans)
                <div class="flex items-center justify-between p-3 bg-gray-800/50 rounded-lg hover:bg-gray-800/70 transition-colors duration-200">
                    <div class="flex items-center space-x-3">
                        @if($clans['rank'] == 1)
                            <span class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @elseif($clans['rank'] == 2)
                            <span class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @elseif($clans['rank'] == 3)
                            <span class="w-6 h-6 bg-amber-600 rounded-full flex items-center justify-center text-black font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @elseif($clans['rank'] == 4)
                            <span class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center text-white font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @else
                            <span class="w-6 h-6 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm">#{{ $clans['rank'] }}</span>
                        @endif
                        <span class="font-medium">{{ $clans['name'] ?? 'Unknown' }}</span>
                    </div>
                    <span class="text-yellow-400 font-bold">{{ $clans['clanCapitalPoints'] }}</span>
                </div>
                @endforeach
            @else
                <p class="text-red-500">No top clans found.</p>
            @endif
        </div>
    </div>
</div>

