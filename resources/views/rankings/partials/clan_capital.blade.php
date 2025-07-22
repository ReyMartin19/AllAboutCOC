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

<a href="">
    View More
</a>