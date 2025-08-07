@php
    $minTH = 9;
    $maxTH = 17;

    // Early return if no CWL data is available
    if (!isset($clan['cwlGroup']) || empty($clan['cwlGroup']['clans'])) {
        echo '<div class="text-center py-8 text-gray-400">
                <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                CWL data is not available. CWL only appears during specific seasons.
              </div>';
        return;
    }

    $cwlGroup = $clan['cwlGroup'];
    $clanTHCounts = [];

    foreach ($cwlGroup['clans'] as $cwlClan) {
        if (!isset($cwlClan['members']) || !is_array($cwlClan['members'])) {
            continue;
        }

        $name = $cwlClan['name'] ?? 'Unknown';
        $badge = $cwlClan['badgeUrls']['small'] ?? '';
        $thCounts = [];

        foreach ($cwlClan['members'] as $member) {
            $th = $member['townHallLevel'] ?? 0;
            if ($th >= $minTH && $th <= $maxTH) {
                $thCounts[$th] = ($thCounts[$th] ?? 0) + 1;
            }
        }

        // Fill in missing TH levels with 0
        for ($i = $minTH; $i <= $maxTH; $i++) {
            if (!isset($thCounts[$i])) $thCounts[$i] = 0;
        }

        krsort($thCounts); // Sort TH from high to low

        $clanTHCounts[] = [
            'name' => $name,
            'badge' => $badge,
            'counts' => $thCounts
        ];
    }

    \Log::debug("Clan cwl rounds in cwl.blade.php for #2L08CGY09: ", [$clan['cwl']['rounds'] ?? 'no rounds']);
@endphp

<div>
        @include('clan.partials.cwl-rounds', ['clan' => $clan])
    </div>
<div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-8">
    <h2 class="text-xl font-bold mb-6">Clan War League</h2>

    {{-- Season Info --}}
    <div class="mb-4">
        <div class="text-blue-400 font-medium">
            Season: {{ $cwlGroup['season'] ?? 'Unknown' }}
        </div>
        <div class="text-green-400 font-medium">
            Status: {{ ucfirst($cwlGroup['state'] ?? 'unknown') }}
        </div>
    </div>

    {{-- Matrix Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-[1000px] table-auto w-full text-sm text-gray-300 border border-gray-600">
            <thead class="bg-gray-700">
                <tr>
                    <th class="text-left px-4 py-3 border-b border-gray-600">Clan</th>
                    @for ($th = $maxTH; $th >= $minTH; $th--)
                        <th class="px-4 py-3 text-center border-b border-gray-600">
                            <img 
                                src="{{ asset('images/TH/Town_Hall' . $th . '.webp') }}" 
                                alt="TH{{ $th }}" 
                                class="h-6 mx-auto" 
                                onerror="this.src='{{ asset('images/TH/Unknown.webp') }}'">
                        </th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach($clanTHCounts as $clan)
                    <tr class="border-t border-gray-700 hover:bg-gray-700/40 transition">
                        <td class="flex items-center px-4 py-3 whitespace-nowrap">
                            <img src="{{ $clan['badge'] }}" alt="{{ $clan['name'] }}" class="w-8 h-8 mr-3" 
                                 onerror="this.src='{{ asset('images/default_badge.png') }}'">
                            <span class="font-semibold text-white">{{ $clan['name'] }}</span>
                        </td>
                        @foreach($clan['counts'] as $count)
                            <td class="text-center px-4 py-2">
                                {{ $count }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

