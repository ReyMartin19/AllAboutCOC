<!-- resources/views/clan/partials/clan_war.blade.php -->
<div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-8">
    @if(!isset($clan['currentWar']) || $clan['currentWar'] === null)
        <div class="text-center py-8 text-gray-400">
            <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>
            Clan war data is not available.
        </div>
    @else
        @php
            $war = $clan['currentWar'];
            $isWarEnded = $war['state'] === 'warEnded';
            $isPreparation = $war['state'] === 'preparation';
            $isInWar = $war['state'] === 'inWar';
            
            function parseApiTimestamp($timestamp) {
                return \Carbon\Carbon::createFromFormat('Ymd\THis.v\Z', $timestamp);
            }
            
            $prepStart = parseApiTimestamp($war['preparationStartTime']);
            $startTime = parseApiTimestamp($war['startTime']);
            $endTime = parseApiTimestamp($war['endTime']);
            
            // Sort members by map position
            usort($war['clan']['members'], function($a, $b) {
                return $a['mapPosition'] <=> $b['mapPosition'];
            });
            
            usort($war['opponent']['members'], function($a, $b) {
                return $a['mapPosition'] <=> $b['mapPosition'];
            });
        @endphp

        <!-- War Info Header -->
        <div class="grid grid-cols-3 gap-4 mb-6 text-center bg-gray-750 p-3 rounded-lg">
            <div class="border-r border-gray-600">
                <div class="text-sm text-gray-400">TYPE</div>
                <div class="font-bold">Clan War</div>
            </div>
            <div class="border-r border-gray-600">
                <div class="text-sm text-gray-400">SIZE</div>
                <div class="font-bold">{{ $war['teamSize'] }} vs {{ $war['teamSize'] }}</div>
            </div>
            <div>
                <div class="text-sm text-gray-400">BATTLE MODE</div>
                <div class="font-bold">Standard x{{ $war['attacksPerMember'] }}</div>
            </div>
        </div>

        <!-- War Timeline -->
        <div class="grid grid-cols-3 gap-4 mb-6 text-center bg-gray-750 p-3 rounded-lg">
            <div class="border-r border-gray-600">
                <div class="text-sm text-gray-400">MATCH ON</div>
                <div class="font-bold">{{ $prepStart->format('n/j/y, g:i A') }}</div>
            </div>
            <div class="border-r border-gray-600">
                <div class="text-sm text-gray-400">STARTS ON</div>
                <div class="font-bold">{{ $startTime->format('n/j/y, g:i A') }}</div>
            </div>
            <div>
                <div class="text-sm text-gray-400">ENDS ON</div>
                <div class="font-bold">{{ $endTime->format('n/j/y, g:i A') }}</div>
            </div>
        </div>

        <!-- War Status -->
        <div class="flex justify-between items-center mb-6 p-3 rounded-lg 
            @if($isPreparation) bg-blue-900 text-blue-200
            @elseif($isInWar) bg-purple-900 text-purple-200
            @else bg-gray-700 text-gray-300 @endif">
            <div class="font-bold">
                @if($isPreparation) PREPARATION DAY
                @elseif($isInWar) BATTLE DAY
                @else WAR ENDED @endif
            </div>
            <div class="text-sm">
                @if($isPreparation)
                    Starts in {{ $startTime->diffForHumans(null, true) }}
                @elseif($isInWar)
                    Ends in {{ $endTime->diffForHumans(null, true) }}
                @endif
            </div>
        </div>

        <!-- Clan vs Clan Header -->
        <div class="flex justify-center items-center mb-6">
            <div class="text-center mx-4">
                <img src="{{ $war['clan']['badgeUrls']['medium'] }}" 
                     alt="{{ $war['clan']['name'] }}" 
                     class="w-16 h-16 mx-auto mb-2">
                <div class="font-bold text-lg">{{ $war['clan']['name'] }}</div>
                <div class="text-sm text-gray-400">{{ $war['clan']['stars'] }}★ {{ $war['clan']['destructionPercentage'] }}%</div>
            </div>
            
            <div class="text-2xl font-bold mx-4">VS</div>
            
            <div class="text-center mx-4">
                <img src="{{ $war['opponent']['badgeUrls']['medium'] }}" 
                     alt="{{ $war['opponent']['name'] }}" 
                     class="w-16 h-16 mx-auto mb-2">
                <div class="font-bold text-lg">{{ $war['opponent']['name'] }}</div>
                <div class="text-sm text-gray-400">{{ $war['opponent']['stars'] }}★ {{ $war['opponent']['destructionPercentage'] }}%</div>
            </div>
        </div>

        <!-- War Matchups -->
        <div class="space-y-3">
            @foreach(array_map(null, $war['clan']['members'], $war['opponent']['members']) as [$homePlayer, $awayPlayer])
                <div class="flex items-center justify-between bg-gray-750 p-3 rounded-lg">
                    <!-- Home Player -->
                    <div class="flex items-center w-5/12">
                        <img src="{{ asset('images/TH/Town_Hall' . $homePlayer['townhallLevel'] . '.webp') }}" 
                             alt="TH{{ $homePlayer['townhallLevel'] }}" 
                             class="w-10 h-10 mr-3">
                        <div class="truncate">
                            <div class="font-medium">{{ $homePlayer['name'] }}</div>
                            <div class="text-xs text-gray-400">TH{{ $homePlayer['townhallLevel'] }}</div>
                        </div>
                    </div>
                    
                    <!-- VS Separator -->
                    <div class="w-2/12 text-center text-gray-400 text-sm">
                        #{{ $homePlayer['mapPosition'] }}
                    </div>
                    
                    <!-- Away Player -->
                    <div class="flex items-center justify-end w-5/12 text-right">
                        <div class="truncate">
                            <div class="font-medium">{{ $awayPlayer['name'] }}</div>
                            <div class="text-xs text-gray-400">TH{{ $awayPlayer['townhallLevel'] }}</div>
                        </div>
                        <img src="{{ asset('images/TH/Town_Hall' . $awayPlayer['townhallLevel'] . '.webp') }}" 
                             alt="TH{{ $awayPlayer['townhallLevel'] }}" 
                             class="w-10 h-10 ml-3">
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@include('clan.partials.stats') 