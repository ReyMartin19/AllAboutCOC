<div class="bg-gray-800/80 rounded-lg p-4 border border-gray-700 hover:border-purple-500/30 transition-all duration-300 backdrop-blur-sm">
    <h3 class="text-gray-400 text-sm font-medium mb-3 uppercase">War Details</h3>
    <div class="space-y-2">
        <div class="flex justify-between">
            <span class="text-gray-400">War Type:</span>
            <span class="text-white font-medium">Clan War</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-400">War Size:</span>
            <span class="text-white font-medium">{{ $war['teamSize'] ?? 0 }} vs {{ $war['teamSize'] ?? 0 }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-400">Attack Mode:</span>
            <span class="text-white font-medium flex items-center">
                Attack <span class="inline-flex items-center justify-center bg-blue-500/20 text-blue-300 rounded-full h-5 w-5 mx-1 text-xs">×</span> {{ $war['attacksPerMember'] ?? 0 }}
            </span>
        </div>
    </div>
</div>