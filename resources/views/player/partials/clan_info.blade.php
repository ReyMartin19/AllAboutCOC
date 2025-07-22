<div class="flex justify-between">
                    <h3 class="text-xl font-bold mb-4 text-primary-400 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined">group</span>
                            Clan Information
                        </div>
                    </h3>
                    <a 
                        class="text-blue p-3 bg-blue-500 rounded-lg" 
                        href="{{ route('clan.show', ['tag' => ltrim($player['clan']['tag'], '#')]) }}"
                    >
                        View
                    </a>
                </div>
                <div class="bg-gray-900 rounded-lg p-4 border border-gray-700">
                    <div class="flex flex-col md:flex-row gap-6 items-center mb-4">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">castle</span>
                        </div>
                        <div class="text-center md:text-left">
                            <h4 class="text-xl font-bold text-blue-400">{{ $player['clan']['name'] }}</h4>
                            <p class="text-gray-400">Tag: {{ $player['clan']['tag'] }} • Level {{ $player['clan']['clanLevel'] }}</p>
                            <div class="inline-block px-3 py-1 bg-green-900 text-green-300 rounded-full text-xs mt-2">
                                {{ ucfirst($player['role']) }}
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div class="bg-gray-800 p-3 rounded-lg text-center hover:bg-gray-700 transition-all">
                            <span class="material-symbols-outlined text-purple-400 text-xl mb-1">star</span>
                            <p class="text-lg font-bold">{{ $player['warStars'] ?? '0' }}</p>
                            <p class="text-xs text-gray-400">War Stars</p>
                        </div>
                        <div class="bg-gray-800 p-3 rounded-lg text-center hover:bg-gray-700 transition-all">
                            <span class="material-symbols-outlined text-orange-400 text-xl mb-1">   </span>
                            <p class="text-lg font-bold">{{ $player['donations'] ?? '0' }}</p>
                            <p class="text-xs text-gray-400">Donations</p>
                        </div>
                        <div class="bg-gray-800 p-3 rounded-lg text-center hover:bg-gray-700 transition-all">
                            <span class="material-symbols-outlined text-red-400 text-xl mb-1"></span>
                            <p class="text-lg font-bold">{{ $player['donationsReceived'] ?? '0' }}</p>
                            <p class="text-xs text-gray-400">Received</p>
                        </div>
                    </div>
                </div>