@extends('layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="flex items-center justify-center gap-2 text-2xl font-bold mb-8 text-white">
        <img src="{{asset('images/TH/Icons/Trophy.webp')}}" alt="" class="h-[1em] w-[1em] mr-3"> 
        Top Rankings
    </h2>
    {{-- Tab Navigation --}}
    <div class="border-b border-gray-700 mb-8">
        <div class="flex space-x-1 justify-center">
            <button onclick="openTab('homePlayers')" class="tab-btn relative py-3 px-6 text-center font-medium text-sm text-gray-400 hover:text-white transition-all duration-300">
                <span class="flex items-center justify-center gap-2 z-10 relative">
                    <span class="material-symbols-outlined">home</span>
                    Home Players
                </span>
                <span class="absolute inset-0 bg-gray-800/50 rounded-t-lg opacity-0 hover:opacity-100 transition-opacity duration-300"></span>
            </button>
            <button onclick="openTab('builderPlayers')" class="tab-btn relative py-3 px-6 text-center font-medium text-sm text-gray-400 hover:text-white transition-all duration-300">
                <span class="flex items-center justify-center gap-2 z-10 relative">
                    <span class="material-symbols-outlined">construction</span>
                    Builder Players
                </span>
                <span class="absolute inset-0 bg-gray-800/50 rounded-t-lg opacity-0 hover:opacity-100 transition-opacity duration-300"></span>
            </button>
            <button onclick="openTab('homeClans')" class="tab-btn relative py-3 px-6 text-center font-medium text-sm text-gray-400 hover:text-white transition-all duration-300">
                <span class="flex items-center justify-center gap-2 z-10 relative">
                    <span class="material-symbols-outlined">shield</span>
                    Home Clans
                </span>
                <span class="absolute inset-0 bg-gray-800/50 rounded-t-lg opacity-0 hover:opacity-100 transition-opacity duration-300"></span>
            </button>
            <button onclick="openTab('builderClans')" class="tab-btn relative py-3 px-6 text-center font-medium text-sm text-gray-400 hover:text-white transition-all duration-300">
                <span class="flex items-center justify-center gap-2 z-10 relative">
                    <span class="material-symbols-outlined">handyman</span>
                    Builder Clans
                </span>
                <span class="absolute inset-0 bg-gray-800/50 rounded-t-lg opacity-0 hover:opacity-100 transition-opacity duration-300"></span>
            </button>
            <button onclick="openTab('capitalClans')" class="tab-btn relative py-3 px-6 text-center font-medium text-sm text-gray-400 hover:text-white transition-all duration-300">
                <span class="flex items-center justify-center gap-2 z-10 relative">
                    <span class="material-symbols-outlined">apartment</span>
                    Clan Capital
                </span>
                <span class="absolute inset-0 bg-gray-800/50 rounded-t-lg opacity-0 hover:opacity-100 transition-opacity duration-300"></span>
            </button>
        </div>
    </div>

    {{-- Tab Content --}}
    <div id="homePlayers" class="tab-content">
        @include('rankings.partials.home_player', ['isFullPage' => true])
    </div>
    <div id="builderPlayers" class="tab-content hidden">
        @include('rankings.partials.builder_base_player', ['isFullPage' => true])
    </div>
    <div id="homeClans" class="tab-content hidden">
        @include('rankings.partials.home_clan', ['isFullPage' => true])
    </div>
    <div id="builderClans" class="tab-content hidden">
        @include('rankings.partials.builder_base_clan', ['isFullPage' => true])
    </div>
    <div id="capitalClans" class="tab-content hidden">
        @include('rankings.partials.clan_capital', ['isFullPage' => true])
    </div>
</div>

{{-- Tab Script --}}
<script>
    function openTab(tabId) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        // Show the selected one
        document.getElementById(tabId).classList.remove('hidden');

        // Update active tab style
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('text-white', 'bg-gray-800/50', 'rounded-t-lg', 'border-b-2', 'border-blue-600');
            btn.classList.add('text-gray-400');
            
            // Reset the pseudo-background
            const bg = btn.querySelector('span:last-child');
            bg.classList.remove('opacity-100', 'border-b-2', 'border-white');
            bg.classList.add('opacity-0', 'hover:opacity-100');
        });
        
        // Add active style to current tab
        const activeBtn = event.currentTarget;
        activeBtn.classList.remove('text-gray-400', 'border-b-2', 'border-white');
        activeBtn.classList.add('text-white', 'bg-gray-800/50', 'rounded-t-lg', 'border-b-2', 'border-blue-600');
        
        // Show the background permanently for active tab
        const activeBg = activeBtn.querySelector('span:last-child');
        activeBg.classList.remove('opacity-0', 'hover:opacity-100', 'border-b-2', 'border-white');
        activeBg.classList.add('opacity-100');
    }

    // Open default tab on load
    document.addEventListener('DOMContentLoaded', () => {
        const defaultTab = document.querySelector('.tab-btn');
        defaultTab.click();
    });
</script>

<style>
    .tab-btn {
        margin-bottom: -1px; /* Align with border */
        transition: all 0.3s ease;
    }
    .tab-content {
        animation: fadeIn 0.3s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection