@isset($player)
@php
// Define spell categories
$elixirSpells = [
    'Lightning Spell', 'Healing Spell', 'Rage Spell', 'Jump Spell',
    'Freeze Spell', 'Clone Spell', 'Invisibility Spell',
    'Recall Spell', 'Revive Spell'
];

$darkSpells = [
    'Poison Spell', 'Earthquake Spell', 'Haste Spell',
    'Skeleton Spell', 'Bat Spell', 'Overgrowth Spell', 'Ice Block Spell'
];

// Group spells
$groupedSpells = [
    'Elixir Spells' => [],
    'Dark Elixir Spells' => [],
];

foreach ($player['spells'] as $spell) {
    if (in_array($spell['name'], $elixirSpells)) {
        $groupedSpells['Elixir Spells'][] = $spell;
    } elseif (in_array($spell['name'], $darkSpells)) {
        $groupedSpells['Dark Elixir Spells'][] = $spell;
    }
}

// Folder paths
$folderPaths = [
    'Elixir Spells' => 'TH/E_Spells',
    'Dark Elixir Spells' => 'TH/DE_Spells',
];
@endphp

@foreach ($groupedSpells as $group => $spells)
    @if (count($spells) > 0)
        <div class="mt-10">
            <h2 class="text-2xl font-bold mb-4">{{ $group }}</h2>
            <div class="grid grid-cols-5 gap-5">
                @foreach ($spells as $spell)
                    @php
                        $imageName = str_replace([' ', '.', '(', ')'], ['_', '', '', ''], $spell['name']) . '_info.webp';
                        $folder = $folderPaths[$group];
                        $imagePath = asset("images/{$folder}/{$imageName}");
                    @endphp
                    <div class="text-center">
                        <img class="w-20 h-20 object-contain mx-auto mb-2" src="{{ $imagePath }}" alt="{{ $spell['name'] }}">
                        <h3 class="font-semibold">{{ $spell['name'] }}</h3>
                        <p>Level: {{ $spell['level'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endforeach
@endisset