<!-- resources/views/clan/partials/clan_war.blade.php -->
<div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-8">
    <h2 class="text-xl font-bold mb-6">Clan War</h2>
    
    @if(!isset($clan['currentWar']) || $clan['currentWar'] === null)
        <div class="text-center py-8 text-gray-400">
            <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
            Clan war data is not available. Either the clan is not currently in war or war log is not public.
        </div>
    @else
        @php
            $war = $clan['currentWar'];
            $isWarEnded = $war['state'] === 'warEnded';
            $isPreparation = $war['state'] === 'preparation';
            $isInWar = $war['state'] === 'inWar';
            
            // Parse API timestamps and convert to Carbon
            function parseApiTimestamp($timestamp) {
                return \Carbon\Carbon::createFromFormat('Ymd\THis.v\Z', $timestamp);
            }
            
            $prepStart = parseApiTimestamp($war['preparationStartTime']);
            $startTime = parseApiTimestamp($war['startTime']);
            $endTime = parseApiTimestamp($war['endTime']);
        @endphp

        <!-- War Status Banner -->
        <div class="mb-6 p-4 rounded-lg 
            @if($isPreparation) bg-blue-900 text-blue-200
            @elseif($isInWar) bg-purple-900 text-purple-200
            @else bg-gray-700 text-gray-300 @endif">
            <div class="flex justify-between items-center">
                <div>
                    <span class="font-bold">
                        @if($isPreparation) Preparation Phase
                        @elseif($isInWar) Battle Day
                        @else War Ended @endif
                    </span>
                    <span class="text-sm ml-2">
                        @if($isPreparation)
                            Starts {{ $startTime->diffForHumans() }}
                        @elseif($isInWar)
                            Ends {{ $endTime->diffForHumans() }}
                        @else
                            Ended {{ $endTime->diffForHumans() }}
                        @endif
                    </span>
                </div>
                <div class="text-sm">
                    Team Size: {{ $war['teamSize'] }}v{{ $war['teamSize'] }}
                </div>
            </div>
        </div>

        <!-- Rest of your war matchup code remains the same -->
        <!-- ... -->

        <!-- War Timeline -->
        <div class="bg-gray-750 rounded-lg p-4 border border-gray-600">
            <h3 class="font-bold mb-3">War Timeline</h3>
            <div class="flex justify-between text-sm text-gray-400 mb-2">
                <div>Preparation: {{ $prepStart->format('M j, g:i A') }}</div>
                <div>→</div>
                <div>Start: {{ $startTime->format('M j, g:i A') }}</div>
                <div>→</div>
                <div>End: {{ $endTime->format('M j, g:i A') }}</div>
            </div>
            <div class="w-full bg-gray-700 rounded-full h-2.5">
                @php
                    $now = now();
                    $totalHours = $startTime->diffInHours($endTime);
                    $elapsedHours = $now->diffInHours($startTime);
                    $progress = min(100, max(0, ($elapsedHours / $totalHours) * 100));
                @endphp
                <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
            </div>
        </div>
    @endif
    
    @if(isset($clan['warLog']) && $clan['warLog'] === null)
        <div class="mt-6 p-4 bg-gray-750 rounded-lg border border-yellow-600 text-yellow-300">
            <i class="fas fa-exclamation-circle mr-2"></i>
            Note: This clan has war log set to private. To view full war history,
            the clan leader must enable "Make War Log Public" in clan settings.
        </div>
    @endif
</div>