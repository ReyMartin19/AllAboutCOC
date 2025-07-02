<div class="grid  gap-6">
    @foreach($player['heroes'] as $hero)
        <div class="p-4 bg-blue-100 rounded">
            <p class="text-lg font-semibold mb-2">
                {{ $hero['name'] ?? 'Unknown Hero' }} - Level {{ $hero['level'] ?? '?' }}
            </p>

            <div class="grid grid-cols-3 gap-2">
                @foreach($player['heroEquipment'] as $equip)

                    @php
                        // Check if the current hero has this equipment
                        $isOwned = false;

                        if (!empty($hero['equipment'])) {
                            foreach ($hero['equipment'] as $owned) {
                                if ($owned['name'] === $equip['name']) {
                                    $isOwned = true;
                                    break;
                                }
                            }
                        }
                    @endphp

                    <p class="{{ $isOwned ? 'bg-green-200' : 'bg-red-200' }} p-2 rounded flex justify-between items-center">
                        <span>{{ $equip['name'] }}</span>
                        <span class="text-sm italic">{{ $isOwned ? 'Acquired (Lvl ' . $equip['level'] . ')' : 'Not Acquired' }}</span>
                    </p>

                @endforeach
            </div>
        </div>
    @endforeach
</div>

