<div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-8">
    <h2 class="text-xl font-bold mb-6">Clan History</h2>

    {{-- War Log --}}
    @if(isset($clan['warLog']['items']) && count($clan['warLog']['items']) > 0)
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-200 mb-3">War Log</h3>
            <ul class="space-y-2">
                @foreach($clan['warLog']['items'] as $log)
                    <li class="bg-gray-900 p-4 rounded-lg border border-gray-700">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-blue-400 font-semibold">{{ $log['opponent']['name'] ?? 'Unknown' }}</span>
                                <span class="text-gray-400">({{ $log['opponent']['tag'] ?? '#' }})</span>
                            </div>
                            <span class="font-bold {{ $log['result'] === 'win' ? 'text-green-400' : ($log['result'] === 'lose' ? 'text-red-400' : 'text-yellow-400') }}">
                                {{ ucfirst($log['result']) }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-400 mt-2">
                            Stars: {{ $log['teamSize'] }}v{{ $log['teamSize'] }} • {{ $log['clan']['stars'] }} - {{ $log['opponent']['stars'] }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p class="text-gray-400">No war history available.</p>
    @endif

    {{-- CWL (League Group Info) --}}
    @if(isset($clan['cwl']['rounds']) && count($clan['cwl']['rounds']) > 0)
        <div>
            <h3 class="text-lg font-semibold text-gray-200 mb-3">Clan War League (CWL)</h3>
            <ul class="space-y-2">
                @foreach($clan['cwl']['rounds'] as $round)
                    <li class="bg-gray-900 p-4 rounded-lg border border-gray-700">
                        <h4 class="text-gray-300 font-bold mb-2">Round</h4>
                        <ul class="text-sm text-gray-400 pl-4 list-disc">
                            @foreach($round['warTags'] as $tag)
                                <li>{{ $tag }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p class="text-gray-400 mt-4">No CWL data available.</p>
    @endif
</div>
