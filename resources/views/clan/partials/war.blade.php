@php
    if (!isset($clan['currentWar']) || empty($clan['currentWar'])) {
        echo '<div class="text-center py-8 text-gray-400">
                <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
                Clan war data is not available.
              </div>';
        return;
    }
    $war = $clan['currentWar'];
    $defenderNames = $clan['defenderNames'] ?? [];
    $isPreparation = $war['state'] === 'preparation';
    $isInWar = $war['state'] === 'inWar';
    $prepStart = isset($war['preparationStartTime']) ? \Carbon\Carbon::createFromFormat('Ymd\THis.v\Z', $war['preparationStartTime']) : null;
    $startTime = isset($war['startTime']) ? \Carbon\Carbon::createFromFormat('Ymd\THis.v\Z', $war['startTime']) : null;
    $endTime = isset($war['endTime']) ? \Carbon\Carbon::createFromFormat('Ymd\THis.v\Z', $war['endTime']) : null;
@endphp

<div id="webcrumbs">
    <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 p-6 rounded-xl border border-purple-500/20 shadow-xl backdrop-blur-sm relative overflow-hidden">
        <!-- Top glow effect -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/2 h-1 bg-blue-500 blur-xl opacity-70"></div>
        
        <div class="relative z-10">
            @include('clan.partials.war-header', ['isPreparation' => $isPreparation, 'isInWar' => $isInWar])
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @include('clan.partials.war-details', ['war' => $war])
                @include('clan.partials.war-timeline', ['prepStart' => $prepStart, 'startTime' => $startTime, 'endTime' => $endTime])
                @include('clan.partials.war-score', ['war' => $war])
            </div>
            @include('clan.partials.war-map', ['war' => $war, 'defenderNames' => $defenderNames])
        </div>
        
        <!-- Bottom decorative elements -->
        <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-purple-500/30 to-transparent"></div>
        <div class="absolute bottom-4 right-4 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl -z-10"></div>
        <div class="absolute top-10 left-10 w-40 h-40 bg-purple-500/10 rounded-full blur-3xl -z-10"></div>
    </div>
</div>