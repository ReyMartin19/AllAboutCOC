@extends('layouts.layout')

@section('content')
<div class="w-full min-h-screen bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Clan Info Section -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <img src="{{ $clan['badgeUrls']['small'] }}" 
                             alt="Clan Badge" 
                     class="w-16 h-16 object-contain">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $clan['name'] }}</h1>
                        <p class="text-gray-400 text-lg">{{ $clan['tag'] }}</p>
                        
                    </div>
                    @if(!empty($clan['description']))
                            <p class="text-gray-300 mt-2">{{ $clan['description'] }}</p>
                    @endif
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-gray-700 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-blue-400">{{ $clan['clanLevel'] }}</div>
                        <div class="text-sm text-gray-400">Level</div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-blue-400">{{ number_format($clan['clanPoints']) }}</div>
                        <div class="text-sm text-gray-400">Points</div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-blue-400">{{ $clan['members'] }}/50</div>
                        <div class="text-sm text-gray-400">Members</div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-blue-400">{{ $clan['requiredTrophies'] ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-400">Required</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="mb-6 border-b border-gray-700">
            <nav class="flex space-x-8">
                <button 
                    data-tab="members" 
                    class="tab-button py-4 px-1 border-b-2 font-medium text-sm border-blue-500 text-blue-400"
                >
                    Members
                </button>
                <button 
                    data-tab="clan-war" 
                    class="tab-button py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-400 hover:text-white hover:border-gray-300"
                >
                    Clan War
                </button>
                <button 
                    data-tab="cwl" 
                    class="tab-button py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-400 hover:text-white hover:border-gray-300"
                >
                    CWL
                </button>
                <button 
                    data-tab="history" 
                    class="tab-button py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-400 hover:text-white hover:border-gray-300"
                >
                    History
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div id="members-tab" class="tab-content">
            @include('clan.partials.clan_members', ['clan' => $clan])
        </div>
        
        <div id="clan-war-tab" class="tab-content hidden">
            @include('clan.partials.clan_war', ['clan' => $clan])
        </div>
        
        <div id="cwl-tab" class="tab-content hidden">
            @include('clan.partials.cwl', ['clan' => $clan])
        </div>
        
        <div id="history-tab" class="tab-content hidden">
            @include('clan.partials.clan_history', ['clan' => $clan])
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update button styles
            tabButtons.forEach(btn => {
                btn.classList.remove('border-blue-500', 'text-blue-400');
                btn.classList.add('border-transparent', 'text-gray-400');
            });
            button.classList.add('border-blue-500', 'text-blue-400');
            button.classList.remove('border-transparent', 'text-gray-400');
            
            // Show selected tab content
            const tabId = button.getAttribute('data-tab') + '-tab';
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            document.getElementById(tabId).classList.remove('hidden');
        });
    });
});
</script>
@endsection