<h3 class="text-xl font-bold mb-4 text-primary-400 flex items-center gap-2">
                    <span class="material-symbols-outlined"></span>
                    Builder Base
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-yellow-400">home</span>
                            Builder Hall Level
                        </span>
                        <span class="font-bold">{{ $player['builderHallLevel'] ?? '0' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-400">trophy</span>
                            Builder Base Trophies
                        </span>
                        <span class="font-bold">{{ $player['builderBaseTrophies'] ?? '0' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-400"></span>
                            Best Builder Base Trophies
                        </span>
                        <span class="font-bold">{{ $player['bestBuilderBaseTrophies'] ?? '0' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-purple-400">castle</span>
                            Clan Capital Contributions
                        </span>
                        <span class="font-bold">{{ $player['clanCapitalContributions'] ?? '0' }}</span>
                    </div>
                </div>