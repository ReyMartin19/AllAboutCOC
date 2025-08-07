@php
    $warId = 'war-' . md5($war['clan']['name'] . $war['opponent']['name']);
@endphp

<div class="bg-gray-800 border border-gray-600 rounded-lg mb-4">
    <!-- Header Section -->
    <div class="flex justify-between items-center px-4 py-3 cursor-pointer toggle-war" data-target="{{ $warId }}">
        <div class="flex items-center gap-2">
            <img src="{{ $war['clan']['badgeUrls']['small'] ?? asset('images/default_badge.png') }}" class="w-6 h-6">
            <span class="text-blue-300 font-semibold">{{ $war['clan']['name'] ?? 'Clan' }}</span>
            <span class="text-yellow-400 font-bold mx-2">vs</span>
            <span class="text-red-300 font-semibold">{{ $war['opponent']['name'] ?? 'Opponent' }}</span>
        </div>
        <div class="text-sm text-gray-400">
            Status: {{ ucfirst($war['state'] ?? 'unknown') }}
        </div>
    </div>

    <!-- Collapsible Content -->
    <div id="{{ $warId }}" class="hidden px-4 pb-4">
        <div class="text-sm text-gray-300">
            <div class="mb-2">Stars: <span class="text-blue-400">{{ $war['clan']['stars'] ?? 0 }}</span> vs <span class="text-red-400">{{ $war['opponent']['stars'] ?? 0 }}</span></div>
            <div class="mb-2">Destruction: <span class="text-blue-400">{{ number_format($war['clan']['destructionPercentage'] ?? 0, 1) }}%</span> vs <span class="text-red-400">{{ number_format($war['opponent']['destructionPercentage'] ?? 0, 1) }}%</span></div>

            @php
                use Carbon\Carbon;

                try {
                    $start = Carbon::createFromFormat('Ymd\THis.v\Z', $war['startTime'] ?? '');
                } catch (\Exception $e) {
                    $start = null;
                }
            @endphp

            <div class="italic text-xs text-gray-400">
                War started: {{ $start ? $start->diffForHumans() : 'N/A' }}
            </div>
        </div>
    </div>
</div>
