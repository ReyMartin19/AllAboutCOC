@php
    $rounds = $clan['cwl']['rounds'] ?? [];
    \Log::debug("CWL rounds in cwl-rounds.blade.php for clan #2L08CGY09: ", [$rounds]);
    \Log::debug("CWL wars in cwl-rounds.blade.php for clan #2L08CGY09: ", [$clan['cwl']['wars'] ?? 'no wars']);
@endphp

@if (empty($rounds))
    <div class="text-center text-gray-400 py-8">
        @if (!isset($clan['cwlGroup']) || empty($clan['cwlGroup']['rounds']))
            CWL data unavailable. The clan may not be in CWL, or the season is inactive.
        @else
            No CWL rounds available yet. Check back during the CWL season.
        @endif
    </div>
@else
    <div class="mt-8" id="cwl-rounds-wrapper">
        <h3 class="text-xl font-bold text-white mb-4">CWL Rounds</h3>

        <!-- Round buttons -->
        <div class="flex flex-wrap gap-2 mb-6" id="cwl-round-tabs">
            @foreach ($rounds as $index => $round)
                <button 
                    class="cwl-round-btn px-4 py-2 bg-gray-700 hover:bg-blue-600 text-sm rounded text-white transition-all"
                    data-round="{{ $index }}">
                    Round {{ $index + 1 }}
                </button>
            @endforeach
        </div>

        <!-- Round content -->
        @foreach ($rounds as $index => $round)
            <div class="cwl-round-content hidden" id="round-{{ $index }}">
                @php
                    $warTags = $round['warTags'] ?? [];
                @endphp

                @if (!empty($warTags))
                    @foreach ($warTags as $warTag)
                        @php
                            $war = $clan['cwl']['wars'][$warTag] ?? null;
                        @endphp

                        @if ($war && isset($war['clan'], $war['opponent']))
                            @include('clan.partials.cwl-war', ['war' => $war])
                        @else
                            <div class="bg-gray-700/40 p-4 rounded text-gray-400 text-sm border border-gray-600 mb-2">
                                War data not available yet for <code>{{ $warTag }}</code>.
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-gray-400 text-sm">No wars listed for this round yet.</p>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Vanilla JS tab switcher -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Existing tab logic...
            const roundButtons = document.querySelectorAll('.cwl-round-btn');
            const roundContents = document.querySelectorAll('.cwl-round-content');

            if (roundContents.length > 0) {
                roundContents[0].classList.remove('hidden');
                roundButtons[0].classList.add('bg-blue-600');
            }

            roundButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const round = btn.getAttribute('data-round');

                    roundContents.forEach(c => c.classList.add('hidden'));
                    roundButtons.forEach(b => b.classList.remove('bg-blue-600'));

                    document.getElementById(`round-${round}`).classList.remove('hidden');
                    btn.classList.add('bg-blue-600');
                });
            });

            // NEW: Toggle war details
            const toggleButtons = document.querySelectorAll('.toggle-war');
            toggleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetId = button.getAttribute('data-target');
                    const content = document.getElementById(targetId);
                    if (content) {
                        content.classList.toggle('hidden');
                    }
                });
            });
        });
    </script>

@endif