<div class="bg-gray-800/80 rounded-lg p-4 border border-gray-700 hover:border-purple-500/30 transition-all duration-300 backdrop-blur-sm lg:col-span-2">
    <h3 class="text-gray-400 text-sm font-medium mb-3 uppercase">Score</h3>
    <div class="flex justify-between items-center">
        <div class="text-center">
            <img src="{{ $war['clan']['badgeUrls']['small'] ?? asset('images/default_badge.png') }}" alt="Clan Badge" class="w-10 h-10 mx-auto mb-2">
            <p class="text-white font-semibold">{{ $war['clan']['name'] ?? 'Unknown' }}</p>
            <div class="flex items-center justify-center gap-2">
                @for($i = 0; $i < ($war['clan']['stars'] ?? 0); $i++)
                    <span class="material-symbols-outlined text-yellow-400">star</span>
                @endfor
                @for($i = 0; $i < 3 - ($war['clan']['stars'] ?? 0); $i++)
                    <span class="material-symbols-outlined text-gray-600">star</span>
                @endfor
            </div>
            <p class="text-white font-medium">{{ $war['clan']['destructionPercentage'] ?? 0 }}%</p>
        </div>
        <div class="text-center">
            <img src="{{ $war['opponent']['badgeUrls']['small'] ?? asset('images/default_badge.png') }}" alt="Opponent Badge" class="w-10 h-10 mx-auto mb-2">
            <p class="text-white font-semibold">{{ $war['opponent']['name'] ?? 'Unknown' }}</p>
            <div class="flex items-center justify-center gap-2">
                @for($i = 0; $i < ($war['opponent']['stars'] ?? 0); $i++)
                    <span class="material-symbols-outlined text-yellow-400">star</span>
                @endfor
                @for($i = 0; $i < 3 - ($war['opponent']['stars'] ?? 0); $i++)
                    <span class="material-symbols-outlined text-gray-600">star</span>
                @endfor
            </div>
            <p class="text-white font-medium">{{ $war['opponent']['destructionPercentage'] ?? 0 }}%</p>
        </div>
    </div>
</div>