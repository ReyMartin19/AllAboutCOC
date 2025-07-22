@extends('layouts.layout')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16">
    <div class="text-center mb-16">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 sm:mb-6 bg-gradient-to-r from-white to-blue-400 bg-clip-text text-transparent">
            Clash of Clans Search Intel
        </h1>
        <p class="text-xl text-gray-300 mb-12">Search for players or clans by tag or name. Find about player's stats, <br>
            clan deatils, war match info, and clan war league match info.
        </p>
        
        {{-- Search form --}}
        <form class="max-w-2xl mx-auto" action="{{ route('search') }}" method="POST">
            @csrf
            <div class="flex flex-col sm:flex-row items-center bg-gray-900/50 backdrop-blur-sm rounded-full border border-blue-500/30 p-2 hover:border-blue-500/60 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20">
                <input 
                    type="text" 
                    name="tag"
                    placeholder="Enter player tag (#88JY8P2) or clan tag/name"
                    autocomplete="off"
                    class="flex-1 bg-transparent px-4 sm:px-6 py-3 text-white placeholder-gray-400 focus:outline-none w-full"
                    required
                >
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-full transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/30 flex items-center space-x-2">
                    <span class="material-symbols-outlined">search</span>
                    <span>Search</span>
                </button>
            </div>
            <p class="text-gray-400 mt-2 text-sm">
                Tip: Use #tag for exact matches, or name for clan searches
            </p>
        </form>
    </div>
    @include('rankings.rankings')
</div>

{{-- Toggle button styling & logic --}}
<script>
    const searchTypeInput = document.getElementById('searchType');
    const searchInput = document.getElementById('searchInput');

    const buttons = {
        player: document.getElementById('playerBtn'),
        clan: document.getElementById('clanBtn'),
        cwl: document.getElementById('cwlBtn')
    };

    Object.entries(buttons).forEach(([type, btn]) => {
        btn.addEventListener('click', () => {
            // Update selected search type
            searchTypeInput.value = type;

            // Update input placeholder based on type
            if (type === 'player') {
                searchInput.placeholder = 'Player Tag (88JY8P2)';
            } else if (type === 'clan') {
                searchInput.placeholder = 'Clan Tag / Name';
            } else if (type === 'cwl') {
                searchInput.placeholder = 'Clan Tag (CWL Match)';
            }

            // Update styles
            Object.values(buttons).forEach(b => b.classList.remove('active-tab'));
            btn.classList.add('active-tab');
        });
    });
</script>

<style>
    .search-toggle {
        @apply hover:bg-gray-800/50 transition-all;
    }

    .active-tab {
        @apply text-blue-400;
    }
</style>
@endsection