
@php
    // Safe date parsing
    function safeParseDate($dateString) {
        if (empty($dateString)) return null;
        
        $formats = [
            'Ymd\THis.v\Z',  // 20231201T120000.000Z
            'Y-m-d\TH:i:s.v\Z', // 2023-12-01T12:00:00.000Z
            'Y-m-d\TH:i:s\Z',   // 2023-12-01T12:00:00Z
            'Y-m-d\TH:i:s',     // 2023-12-01T12:00:00
            'Y-m-d H:i:s',      // 2023-12-01 12:00:00
        ];
        
        foreach ($formats as $format) {
            try {
                return \Carbon\Carbon::createFromFormat($format, $dateString);
            } catch (\Exception $e) {
                continue;
            }
        }
        
        // If all formats fail, try parsing as ISO string
        try {
            return \Carbon\Carbon::parse($dateString);
        } catch (\Exception $e) {
            return null;
        }
    }
    
    $endTime = safeParseDate($log['endTime'] ?? null);
    $result = isset($log['result']) ? $log['result'] : (
        isset($log['state']) && $log['state'] === 'warEnded' ? (
            ($log['clan']['stars'] > $log['opponent']['stars'] || 
             ($log['clan']['stars'] === $log['opponent']['stars'] && $log['clan']['destructionPercentage'] > $log['opponent']['destructionPercentage'])) 
            ? 'win' : (
                ($log['clan']['stars'] < $log['opponent']['stars'] || 
                 ($log['clan']['stars'] === $log['opponent']['stars'] && $log['clan']['destructionPercentage'] < $log['opponent']['destructionPercentage'])) 
                ? 'lose' : 'tie'
            )
        ) : 'ongoing'
    );
    $resultColor = $result === 'win' ? 'bg-green-900 text-green-300' : ($result === 'lose' ? 'bg-red-900 text-red-300' : ($result === 'tie' ? 'bg-yellow-900 text-yellow-300' : 'bg-gray-900 text-gray-300'));
    $isClan = ($log['clan']['tag'] ?? '') === '#2L08CGY09';
    $opponentKey = $isClan ? 'opponent' : 'clan';
@endphp

<div class="bg-gray-900 p-4 rounded-lg border border-gray-700 hover:border-purple-500/30">
    <div class="flex items-center justify-between mb-2">
        <div class="flex items-center gap-2">
            <img src="{{ $log[$opponentKey]['badgeUrls']['small'] ?? asset('images/default_badge.png') }}" alt="Opponent Badge" class="w-6 h-6 rounded-full">
            <div>
                <span class="text-sm font-semibold {{ $isCWL ? 'text-purple-400' : 'text-blue-400' }}">{{ $log[$opponentKey]['name'] ?? 'Unknown' }}</span>
                <span class="text-xs text-gray-400">{{ $log[$opponentKey]['tag'] ?? '#' }}</span>
            </div>
        </div>
        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $resultColor }}">{{ ucfirst($result) }}</span>
    </div>
    <div class="grid grid-cols-2 gap-2 text-xs text-gray-400">
        <div>Stars: {{ $log['clan']['stars'] ?? 0 }} - {{ $log[$opponentKey]['stars'] ?? 0 }}</div>
        <div>Destruction: {{ number_format($log['clan']['destructionPercentage'] ?? 0, 1) }}% - {{ number_format($log[$opponentKey]['destructionPercentage'] ?? 0, 1) }}%</div>
        <div>Size: {{ $log['teamSize'] ?? 0 }}v{{ $log['teamSize'] ?? 0 }}</div>
        <div>Attacks: {{ $log['clan']['attacks'] ?? 0 }}/{{ ($log['teamSize'] ?? 0) * ($log['attacksPerMember'] ?? ($isCWL ? 1 : 2)) }}</div>
        <div>Date: {{ $endTime ? $endTime->format('M j, Y') : 'N/A' }}</div>
        @if($isCWL && isset($log['round']))
            <div>Round: {{ $log['round'] }}</div>
        @endif
    </div>
</div>
