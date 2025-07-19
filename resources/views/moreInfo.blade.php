@isset($player)
    @php
        $heroEquipMap = [
            'Barbarian King' => ['Barbarian Puppet', 'Rage Vial', 'Earthquake Boots', 'Vampstache', 'Giant Gauntlet', 'Spiky Ball', 'Snake Bracelet'],
            'Archer Queen' => ['Archer Puppet', 'Invisibility Vial', 'Giant Arrow', 'Healer Puppet', 'Frozen Arrow', 'Magic Mirror', 'Action Figure'],
            'Minion Prince' => ['Henchmen Puppet', 'Dark Orb', 'Metal Pants', 'Noble Iron', 'Dark Crown'],
            'Grand Warden' => ['Eternal Tome', 'Life Gem', 'Rage Gem', 'Healing Tome', 'Fireball', 'Lavaloon Puppet'],
            'Royal Champion' => ['Royal Gem', 'Seeking Shield', 'Hog Rider Puppet', 'Haste Vial', 'Rocket Spear', 'Electro Boots'],
        ];

        $allOwnedEquip = collect($player['heroEquipment'] ?? []);
        $heroImageFolders = [
            'Barbarian King' => 'BK',
            'Archer Queen' => 'Q',
            'Grand Warden' => 'W',
            'Royal Champion' => 'RC',
            'Minion Prince' => 'MP'
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($player['heroes'] as $hero)
            @php
                $name = $hero['name'];
                $allowedEquipment = $heroEquipMap[$name] ?? [];
                $heroLevel = $hero['level'] ?? '?';
                $folder = $heroImageFolders[$name] ?? 'BK';
                $gradient = match($name) {
                    'Barbarian King' => 'from-blue-500 to-blue-600',
                    'Archer Queen' => 'from-pink-500 to-pink-600',
                    'Grand Warden' => 'from-yellow-500 to-yellow-600',
                    'Royal Champion' => 'from-purple-500 to-purple-600',
                    'Minion Prince' => 'from-gray-600 to-gray-700',
                    default => 'from-blue-500 to-blue-600'
                };
            @endphp

            @if(array_key_exists($name, $heroEquipMap))
                <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-2xl p-6 shadow-2xl border border-gray-700 hover:scale-[1.02] hover:shadow-blue-500/20 transition-all duration-300 group">
                    <div class="relative mb-4">
                        <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br {{ $gradient }} p-1 shadow-lg">
                            <img src="{{ asset('images/TH/Heroes/' . str_replace(' ', '_', strtolower($name)) . '.webp') }}" 
                                alt="{{ $name }}" 
                                class="w-full h-full rounded-full object-cover"/>
                        </div>
                        <div class="absolute -top-2 -right-2 bg-blue-500 text-white text-sm font-bold px-2 py-1 rounded-full">
                            {{ $heroLevel }}
                        </div>
                    </div>
                    
                    <h3 class="text-white font-bold text-lg text-center mb-4">{{ $name }}</h3>
                    
                    <div class="border-t border-gray-600 pt-4">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-gray-300 font-semibold text-sm">Equipment</h4>
                            @php
                                $equippedCount = $allOwnedEquip->filter(fn($e) => in_array($e['name'], $allowedEquipment) && $e['level'] >= 1)->count();
                            @endphp
                            <div class="text-xs text-gray-400">{{ $equippedCount }}/{{ count($allowedEquipment) }} Equipped</div>
                        </div>

                        <div class="space-y-2">
                            @foreach($allowedEquipment as $equipName)
                                @php
                                    $equip = $allOwnedEquip->firstWhere('name', $equipName);
                                    $isOwned = $equip && $equip['level'] >= 1;
                                    $level = $equip['level'] ?? 0;
                                    $imagePath = "images/TH/Equipment/{$folder}/" . str_replace(' ', '_', $equipName) . ".webp";
                                @endphp

                                <div class="flex items-center justify-between p-2 rounded-lg {{ $isOwned ? 'bg-gradient-to-r from-blue-500/20 to-blue-600/20 border border-blue-500/30' : 'bg-gray-700' }}">
                                    <div class="flex items-center">
                                        <img src="{{ asset($imagePath) }}" alt="{{ $equipName }}" class="w-8 h-8 rounded mr-2 object-contain">
                                        <span class="text-white text-sm">{{ $equipName }}</span>
                                    </div>
                                    <span class="text-blue-400 text-sm font-bold">Lv {{ $level }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endisset
