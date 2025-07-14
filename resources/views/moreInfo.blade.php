@isset($player)
    @php
        // Define what equipment belongs to each hero
        $heroEquipMap = [
            'Barbarian King' => [
                'Barbarian Puppet', 'Rage Vial', 'Earthquake Boots',
                'Vampstache', 'Giant Gauntlet', 'Spiky Ball', 'Snake Bracelet'
            ],
            'Archer Queen' => [
                'Archer Puppet', 'Invisibility Vial', 'Giant Arrow',
                'Healer Puppet', 'Frozen Arrow', 'Magic Mirror', 'Action Figure'
            ],
            'Minion Prince' => [
                'Henchmen Puppet', 'Dark Orb', 'Metal Pants',
                'Noble Iron', 'Dark Crown'
            ],
            'Grand Warden' => [
                'Eternal Tome', 'Life Gem', 'Rage Gem',
                'Healing Tome', 'Fireball', 'Lavaloon Puppet'
            ],
            'Royal Champion' => [
                'Royal Gem', 'Seeking Shield', 'Hog Rider Puppet',
                'Haste Vial', 'Rocket Spear', 'Electro Boots'
            ],
        ];

        // Convert heroEquipment to a collection for easier searching
        $allOwnedEquip = collect($player['heroEquipment'] ?? []);
    @endphp

    <div class="grid grid-cols-5 gap-3">
        @foreach($player['heroes'] as $hero)
            @php
                $name = $hero['name'];
                $allowedEquipment = $heroEquipMap[$name] ?? [];
            @endphp

            @if(array_key_exists($name, $heroEquipMap))
                <div class="p-4 bg-blue-100 rounded">
                    <p class="text-lg font-semibold mb-2">
                        {{ $name }} - Level {{ $hero['level'] ?? '?' }}
                    </p>

                    <div class="grid gap-2">
                        @foreach($allowedEquipment as $equipName)
                            @php
                                // Find if player owns this equipment
                                $equip = $allOwnedEquip->firstWhere('name', $equipName);
                                $isOwned = $equip && $equip['level'] >= 1;
                                $level = $equip['level'] ?? 0;
                                $maxLevel = $equip['maxLevel'] ?? '??';
                            @endphp

                            <p class="{{ $isOwned ? 'bg-green-200' : 'bg-red-200' }} p-2 rounded flex justify-between items-center">
                                <span>{{ $equipName }}</span>
                                <span class="text-sm italic">
                                    {{ $isOwned ? 'Acquired (Lvl ' . $level . ' / ' . $maxLevel . ')' : 'Not Acquired' }}
                                </span>
                            </p>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endisset
