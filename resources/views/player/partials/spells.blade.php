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

// Grouped spell lists to display all by name
$groupedSpells = [
    'Elixir Spells' => $elixirSpells,
    'Dark Elixir Spells' => $darkSpells,
];

// Folder mapping
$categoryFolders = [
    'Elixir Spells' => 'TH/E_Spells',
    'Dark Elixir Spells' => 'TH/DE_Spells',
];

// Collection from player data
$playerSpells = collect($player['spells'] ?? []);
@endphp

<div class="w-full bg-[#0f0f0f] text-white p-6 font-sans">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">Spells</h1>
        <div class="space-y-10">
            @foreach($groupedSpells as $category => $spellList)
                <div class="bg-[#1e1e1e] rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-blue-400">{{ $category }}</h2>
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
                        @foreach($spellList as $spellName)
                            @php
                                $data = $playerSpells->firstWhere('name', $spellName);
                                $hasSpell = $data !== null;
                                $level = $data['level'] ?? 0;

                                // Format name to image file
                                $imageName = str_replace([' ', '.', '(', ')'], ['_', '', '', ''], $spellName) . '_info.webp';
                                $folder = $categoryFolders[$category] ?? 'TH/Other';
                                $imagePath = asset("images/{$folder}/{$imageName}");
                            @endphp

                            <div class="relative group flex flex-col items-center">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-gray-800 p-1 shadow-lg flex items-center justify-center 
                                    @if($hasSpell) 
                                        border-2 border-blue-500 group-hover:border-blue-400 group-hover:shadow-blue-500/30
                                        transition-all duration-300 group-hover:scale-110
                                    @else opacity-60
                                    @endif">
                                    <img src="{{ $imagePath }}" 
                                         alt="{{ $spellName }}" 
                                         class="w-full h-full rounded-full object-contain 
                                                @if(!$hasSpell) grayscale opacity-50 @endif">
                                </div>
                                <div class="absolute -top-1 -right-1 
                                            @if($hasSpell) bg-blue-500 @else @endif
                                            text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
                                    {{ $hasSpell ? $level : 0 }}
                                </div>
                                <span class="mt-2 text-sm font-medium text-center @if(!$hasSpell) text-gray-500 @endif">
                                    {{ $spellName }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endisset