@extends('layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="flex items-center justify-center gap-2 text-2xl font-bold mb-8 text-white">
        <img src="{{asset('images/TH/Icons/Trophy.webp')}}" alt="" class="h-[1em] w-[1em] mr-3"> 
        Top Rankings
    </h2>
    {{-- Location Filter --}}
    <div class="mb-6 backdrop-blur-md bg-white/10 rounded-xl p-4 shadow-lg border border-white/20">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <h2 className="text-xl font-bold text-yellow-400 flex items-center">
                <span className="material-symbols-outlined mr-2">public</span>
                Location Filter
            </h2>
            <form method="GET" action="" class="flex items-center gap-2">
                <div class="relative">
                    <select name="locationId" id="locationId" class="appearance-none rounded-lg px-4 py-2 pr-10 bg-gray-900 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition w-56 shadow-sm" onchange="this.form.submit()">
                        <option value="global" {{ ($selectedLocationId ?? 'global') == 'global' ? 'selected' : '' }}>🌍 Global</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc['id'] }}" {{ ($selectedLocationId ?? 'global') == $loc['id'] ? 'selected' : '' }}>{{ $loc['name'] }}</option>
                        @endforeach
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                    </span>
                </div>
            </form>
        </div>
    </div>
    
    {{-- Responsive Tab Navigation --}}
    <div class="mb-8">
        <!-- Desktop Tabs -->
        <div class="hidden md:block border-b border-gray-700">
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
        
        <!-- Mobile Dropdown -->
        <div class="md:hidden relative">
            <select id="mobileTabSelect" onchange="openTab(this.value)" class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 text-white appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="homePlayers">🏠 Home Players</option>
                <option value="builderPlayers">🛠️ Builder Players</option>
                <option value="homeClans">🛡️ Home Clans</option>
                <option value="builderClans">🔨 Builder Clans</option>
                <option value="capitalClans">🏛️ Clan Capital</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
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
    let currentTab = 'homePlayers'; // Track current tab
    
    function openTab(tabId) {
        // Update current tab
        currentTab = tabId;
        
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        // Show the selected one
        document.getElementById(tabId).classList.remove('hidden');

        // Update active tab style (desktop)
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('text-white', 'bg-gray-800/50', 'rounded-t-lg', 'border-b-2', 'border-blue-600');
            btn.classList.add('text-gray-400');
            
            // Reset the pseudo-background
            const bg = btn.querySelector('span:last-child');
            bg.classList.remove('opacity-100', 'border-b-2', 'border-white');
            bg.classList.add('opacity-0', 'hover:opacity-100');
        });
        
        // Add active style to current tab (desktop)
        const activeBtn = document.querySelector(`.tab-btn[onclick="openTab('${tabId}')"]`);
        if (activeBtn) {
            activeBtn.classList.remove('text-gray-400', 'border-b-2', 'border-white');
            activeBtn.classList.add('text-white', 'bg-gray-800/50', 'rounded-t-lg', 'border-b-2', 'border-blue-600');
            
            // Show the background permanently for active tab
            const activeBg = activeBtn.querySelector('span:last-child');
            activeBg.classList.remove('opacity-0', 'hover:opacity-100', 'border-b-2', 'border-white');
            activeBg.classList.add('opacity-100');
        }

        // Update mobile dropdown selection
        const mobileSelect = document.getElementById('mobileTabSelect');
        if (mobileSelect) {
            mobileSelect.value = tabId;
        }
    }

    // Open default tab on load
    document.addEventListener('DOMContentLoaded', () => {
        // Check if there's a saved tab in localStorage
        const savedTab = localStorage.getItem('selectedTab');
        if (savedTab && document.getElementById(savedTab)) {
            openTab(savedTab);
        } else {
            openTab('homePlayers');
        }
        
        // Save tab selection when changed
        document.querySelectorAll('.tab-btn, #mobileTabSelect').forEach(el => {
            el.addEventListener('click', function() {
                if (this.id !== 'mobileTabSelect') {
                    localStorage.setItem('selectedTab', currentTab);
                }
            });
        });
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
    /* Style for mobile dropdown */
    #mobileTabSelect {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
</style>
@endsection