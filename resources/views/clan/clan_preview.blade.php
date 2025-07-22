@extends('layouts.layout')

@section('content')
<div class="max-w-7xl mx-auto mt-6 mb-8 px-4">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="text-sm">Back</span>
        </a>
        <h2 class="text-2xl font-bold text-white">Search Results</h2>
        <div class="w-16"></div>
    </div>

    {{-- Results --}}
    @if(isset($error))
        <div class="bg-red-900/30 border border-red-700 rounded-xl p-6 text-center backdrop-blur-sm">
            <p class="text-red-300 font-medium">{{ $error }}</p>
        </div>
    @elseif(count($clans) === 0)
        <div class="bg-gray-800/30 border border-gray-700 rounded-xl p-6 text-center backdrop-blur-sm">
            <p class="text-gray-400">No clans found matching your search</p>
        </div>
    @else
        {{-- Clan Grid --}}
        <div id="clan-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>

        {{-- Show More Button --}}
        <div class="text-center mt-8">
            <button id="show-more-btn" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white text-sm rounded-lg transition">
                Show More
            </button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const clans = @json($clans);
                const grid = document.getElementById('clan-grid');
                const showMoreBtn = document.getElementById('show-more-btn');
                const batchSize = 8;
                let currentIndex = 0;

                function renderClans() {
                    const nextBatch = clans.slice(currentIndex, currentIndex + batchSize);

                    nextBatch.forEach(clan => {
                        const card = document.createElement('div');
                        card.className = 'bg-gray-800/30 border border-gray-700 rounded-xl p-6 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-200 backdrop-blur-sm flex flex-col justify-between';

                        card.innerHTML = `
                            <div class="flex items-center mb-4">
                                <img src="${clan.badgeUrls.small}" alt="Clan Badge" class="w-14 h-14 object-contain">
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-white">${clan.name}</h3>
                                    <span class="text-gray-400 text-xs">${clan.tag}</span>
                                </div>
                            </div>
                            <div class="flex justify-between text-sm mb-4">
                                <div class="text-center">
                                    <p class="text-gray-400">Members</p>
                                    <p class="text-white font-medium">${clan.members}/50</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-400">Points</p>
                                    <p class="text-yellow-400 font-medium">${clan.clanPoints.toLocaleString()}</p>
                                </div>
                            </div>
                            <div class="mt-auto pt-2 text-center">
                                <a href="/clan/${clan.tag.replace('#', '')}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">
                                    View
                                </a>
                            </div>
                        `;
                        grid.appendChild(card);
                    });

                    currentIndex += batchSize;

                    if (currentIndex >= clans.length) {
                        showMoreBtn.style.display = 'none';
                    }
                }

                // Initial render
                renderClans();

                // On click
                showMoreBtn.addEventListener('click', renderClans);
            });
        </script>
    @endif
</div>
@endsection
