
<div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-8" x-data="{ activeTab: 'regular' }">
    <h2 class="text-xl font-bold mb-6 text-white">Clan History</h2>

    @php
        $regularWars = [];
        $cwlWars = [];
        if (isset($clan['warLog']['items']) && is_array($clan['warLog']['items'])) {
            foreach ($clan['warLog']['items'] as $log) {
                if (isset($log['attacksPerMember']) && $log['attacksPerMember'] == 1) {
                    $cwlWars[] = array_merge($log, ['round' => null]); // No round info in warLog
                } else {
                    $regularWars[] = $log;
                }
            }
        }
        $allCwlWars = $cwlWars;
        $warsByRound = [];
        if (isset($clan['cwl']['rounds']) && is_array($clan['cwl']['rounds'])) {
            foreach ($clan['cwl']['rounds'] as $index => $round) {
                if (isset($round['warTags']) && is_array($round['warTags'])) {
                    foreach ($round['warTags'] as $warTag) {
                        if ($warTag !== '#0' && isset($clan['cwlWars'][$warTag]) && is_array($clan['cwlWars'][$warTag]) && isset($clan['cwlWars'][$warTag]['state']) && $clan['cwlWars'][$warTag]['state'] !== 'notInWar') {
                            $allCwlWars[] = array_merge($clan['cwlWars'][$warTag], ['round' => $index + 1, 'warTag' => $warTag]);
                            $warsByRound[$index + 1][] = array_merge($clan['cwlWars'][$warTag], ['round' => $index + 1, 'warTag' => $warTag]);
                        }
                    }
                }
            }
        }
        // Safe date parsing function
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
        
        usort($allCwlWars, function ($a, $b) {
            $aRound = $a['round'] ?? 999; // Push warLog wars to end
            $bRound = $b['round'] ?? 999;
            if ($aRound === $bRound) {
                $aTime = safeParseDate($a['endTime'] ?? null);
                $bTime = safeParseDate($b['endTime'] ?? null);
                $aTimestamp = $aTime ? $aTime->timestamp : 0;
                $bTimestamp = $bTime ? $bTime->timestamp : 0;
                return $bTimestamp <=> $aTimestamp;
            }
            return $bRound <=> $aRound; // Newest round first
        });
    @endphp

    <!-- Tab Buttons -->
    <div class="flex space-x-4 mb-6">
        <button 
            @click="activeTab = 'regular'" 
            class="px-4 py-2 rounded-md font-semibold text-sm transition-colors duration-200 flex items-center gap-2"
            :class="activeTab === 'regular' ? 'bg-yellow-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path>
            </svg>
            Regular Wars
        </button>
        <button 
            @click="activeTab = 'cwl'" 
            class="px-4 py-2 rounded-md font-semibold text-sm transition-colors duration-200 flex items-center gap-2"
            :class="activeTab === 'cwl' ? 'bg-purple-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            CWL
        </button>
    </div>

    <!-- Tab Content -->
    <div class="max-h-[500px] overflow-y-auto pr-2">
        <!-- Regular Clan Wars -->
        <div x-show="activeTab === 'regular'">
            @if(count($regularWars) > 0)
                <div class="space-y-4">
                    @foreach($regularWars as $log)
                        @include('clan.partials.war-entry', ['log' => $log, 'isCWL' => false])
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">No regular war history.</p>
            @endif
        </div>

        <!-- Clan War League (CWL) -->
        <div x-show="activeTab === 'cwl'" x-cloak>
            @if(isset($clan['cwl']['clans']) && is_array($clan['cwl']['clans']) && count($clan['cwl']['clans']) > 0)
                <div class="mb-6">
                    <h3 class="text-md font-semibold text-gray-200 mb-3">CWL Clans</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                        @foreach($clan['cwl']['clans'] as $cwlClan)
                            <div class="flex items-center gap-2 bg-gray-900 p-2 rounded border border-gray-700">
                                <img src="{{ $cwlClan['badgeUrls']['small'] ?? asset('images/default_badge.png') }}" alt="{{ $cwlClan['name'] ?? 'Unknown' }}" class="w-6 h-6 rounded-full">
                                <div>
                                    <span class="text-xs font-semibold text-purple-400">{{ $cwlClan['name'] ?? 'Unknown' }}</span>
                                    <span class="text-xs text-gray-400">{{ $cwlClan['tag'] ?? '#' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(count($allCwlWars) > 0)
                <div class="space-y-6">
                    @for($round = 7; $round >= 1; $round--)
                        @if(isset($warsByRound[$round]) && count($warsByRound[$round]) > 0)
                            <div>
                                <h3 class="text-md font-semibold text-gray-200 mb-3">Round {{ $round }}</h3>
                                <div class="space-y-4">
                                    @foreach($warsByRound[$round] as $log)
                                        @include('clan.partials.war-entry', ['log' => $log, 'isCWL' => true])
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endfor
                    @if(count($cwlWars) > 0)
                        <div>
                            <h3 class="text-md font-semibold text-gray-200 mb-3">Previous CWL Wars</h3>
                            <div class="space-y-4">
                                @foreach($cwlWars as $log)
                                    @include('clan.partials.war-entry', ['log' => $log, 'isCWL' => true])
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <p class="text-gray-400">No CWL war history.</p>
            @endif
        </div>
    </div>
</div>
