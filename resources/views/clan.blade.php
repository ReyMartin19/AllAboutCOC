@extends('layouts.layout')

@section('content')
<div class="w-full min-h-screen bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Clan Info Section -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $clan['name'] }}</h1>
                    <p class="text-gray-400 text-lg">{{ $clan['tag'] }}</p>
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

            <!-- Additional Clan Stats -->
            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-gray-700 rounded-lg p-4 text-center">
                    <div class="text-xl font-bold text-blue-400">{{ $clan['warWins'] ?? '0' }}</div>
                    <div class="text-sm text-gray-400">War Wins</div>
                </div>
                <div class="bg-gray-700 rounded-lg p-4 text-center">
                    <div class="text-xl font-bold text-blue-400">{{ $clan['warWinStreak'] ?? '0' }}</div>
                    <div class="text-sm text-gray-400">Win Streak</div>
                </div>
                <div class="bg-gray-700 rounded-lg p-4 text-center">
                    <div class="text-xl font-bold text-blue-400">{{ $clan['warFrequency'] ?? 'Unknown' }}</div>
                    <div class="text-sm text-gray-400">War Frequency</div>
                </div>
                <div class="bg-gray-700 rounded-lg p-4 text-center">
                    <div class="text-xl font-bold text-blue-400">{{ $clan['clanCapitalPoints'] ?? '0' }}</div>
                    <div class="text-sm text-gray-400">Capital Points</div>
                </div>
            </div>
        </div>

        <!-- Members Section -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div class="flex space-x-4 mb-4 md:mb-0">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                        Home Village
                    </button>
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                        Builder Base
                    </button>
                </div>
                <div class="flex flex-wrap gap-2">
                    <select class="bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white">
                        <option>Sort by Town Hall</option>
                        <option>Sort by Experience</option>
                        <option>Sort by Role</option>
                        <option>Sort by Trophies</option>
                        <option>Sort by War Stars</option>
                        <option>Sort by Donations</option>
                    </select>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-700 border-b border-gray-600">
                            <tr>
                                <th class="px-4 py-3 text-sm font-semibold text-gray-300 hover:text-white cursor-pointer">Name</th>
                                <th class="px-4 py-3 text-sm font-semibold text-gray-300 hover:text-white cursor-pointer">
                                    <div class="flex items-center space-x-1">
                                        <span>XP</span>
                                    </div>
                                </th>
                                <th class="px-4 py-3 text-sm font-semibold text-gray-300 hover:text-white cursor-pointer">
                                    <div class="flex items-center space-x-1">
                                        <span>TH</span>
                                    </div>
                                </th>
                                <th class="px-4 py-3 text-sm font-semibold text-gray-300 hover:text-white cursor-pointer">Role</th>
                                <th class="px-4 py-3 text-sm font-semibold text-gray-300 hover:text-white cursor-pointer">
                                    <div class="flex items-center space-x-1">
                                        <span>Trophies</span>
                                    </div>
                                </th>
                                <th class="px-4 py-3 text-sm font-semibold text-gray-300 hover:text-white cursor-pointer">
                                    <div class="flex items-center space-x-1">
                                        <span>Donation Recieved</span>
                                    </div>
                                </th>
                                <th class="px-4 py-3 text-sm font-semibold text-gray-300 hover:text-white cursor-pointer">Donations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clan['memberList'] as $member)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                <td class="px-4 py-4">
                                    <div>
                                        <div class="font-semibold text-white">{{ $member['name'] }}</div>
                                        <div class="text-sm text-gray-400">{{ $member['tag'] }}</div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-xs font-bold">
                                            {{ $member['expLevel'] }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="w-8 h-8 bg-yellow-600 rounded-lg flex items-center justify-center text-xs font-bold">
                                        {{ $member['townHallLevel'] }}
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    @php
                                        $roleClasses = [
                                            'leader' => 'bg-red-600',
                                            'coleader' => 'bg-orange-600',
                                            'admin' => 'bg-yellow-600',
                                            'member' => 'bg-gray-600'
                                        ];
                                    @endphp
                                    <span class="{{ $roleClasses[strtolower($member['role'])] }} text-white px-2 py-1 rounded-full text-xs font-semibold">
                                        {{ ucfirst($member['role']) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center space-x-1">
                                        <span class="material-symbols-outlined text-yellow-400 text-sm">trophy</span>
                                        <span class="font-semibold">{{ number_format($member['trophies']) }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center space-x-1">
                                        <span class="font-semibold">{{ $member['donationsReceived'] }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="text-green-400 font-semibold">{{ $member['donations'] }}</div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center py-6">
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors flex items-center space-x-2 group">
                        <span>Show More Members</span>
                        
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection