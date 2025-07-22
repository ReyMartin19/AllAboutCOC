<h3 class="text-xl font-bold mb-4 text-primary-400 flex items-center gap-2">
                    <span class="material-symbols-outlined">analytics</span>
                    Player Stats
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-red-400">landscape</span>
                            Attack Wins
                        </span>
                        <span class="font-bold">{{ $player['attackWins'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-400">shield</span>
                            Defense Wins
                        </span>
                        <span class="font-bold">{{ $player['defenseWins'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-400"></span>
                            Donations
                        </span>
                        <span class="font-bold">{{ $player['donations'] ?? '0' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-yellow-400"></span>
                            Donations Received
                        </span>
                        <span class="font-bold">{{ $player['donationsReceived'] ?? '0' }}</span>
                    </div>
                </div>