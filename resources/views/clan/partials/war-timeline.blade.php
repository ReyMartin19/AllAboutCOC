<div class="bg-gray-800/80 rounded-lg p-4 border border-gray-700 hover:border-purple-500/30 transition-all duration-300 backdrop-blur-sm">
    <h3 class="text-gray-400 text-sm font-medium mb-3 uppercase">Timeline</h3>
    <div class="space-y-2">
        <div class="flex justify-between">
            <span class="text-gray-400">Match On:</span>
            <span class="text-white font-medium">
                @if($prepStart)
                    {{ $prepStart->format('n/j/y, g:i A') }}
                @else
                    N/A
                @endif
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-400">Starts On:</span>
            <span class="text-white font-medium">
                @if($startTime)
                    {{ $startTime->format('n/j/y, g:i A') }}
                @else
                    N/A
                @endif
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-400">Ends On:</span>
            <span class="text-white font-medium">
                @if($endTime)
                    {{ $endTime->format('n/j/y, g:i A') }}
                @else
                    N/A
                @endif
            </span>
        </div>
    </div>
</div>