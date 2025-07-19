@isset($player)
@php
// Categories
$elixirTroops = [
    'Barbarian', 'Archer', 'Giant', 'Goblin', 'Wall Breaker', 'Balloon', 'Wizard',
    'Healer', 'Dragon', 'P.E.K.K.A', 'Baby Dragon', 'Miner', 'Electro Dragon',
    'Yeti', 'Dragon Rider', 'Electro Titan', 'Root Rider', 'Thrower'
];

$darkTroops = [
    'Minion', 'Hog Rider', 'Valkyrie', 'Golem', 'Witch', 'Lava Hound', 'Bowler',
    'Ice Golem', 'Headhunter', 'Apprentice Warden', 'Druid', 'Furnace'
];

$superTroops = [
    'Super Barbarian', 'Super Archer', 'Super Giant', 'Sneaky Goblin', 'Super Wall Breaker',
    'Rocket Balloon', 'Super Wizard', 'Super Dragon', 'Inferno Dragon', 'Super Miner',
    'Super Yeti', 'Super Minion', 'Super Hog Rider', 'Super Rider', 'Super Valkyrie',
    'Super Witch', 'Ice Hound', 'Super Bowler'
];

$builderBaseTroops = [
    'Raged Barbarian', 'Sneaky Archer', 'Boxer Giant', 'Beta Minion', 'Bomber',
    'Baby Dragon', 'Cannon Cart', 'Night Witch', 'Drop Ship', 'Power P.E.K.K.A',
    'Hog Glider', 'Electrofire Wizard'
];

$siegeMachines = [
    'Wall Wrecker', 'Battle Blimp', 'Stone Slammer', 'Siege Barracks',
    'Log Launcher', 'Flame Flinger', 'Battle Drill', 'Troop Launcher'
];

$heroPetsList = [
    'L.A.S.S.I', 'Electro Owl', 'Mighty Yak', 'Unicorn',
    'Frosty', 'Diggy', 'Poison Lizard', 'Phoenix',
    'Spirit Fox', 'Angry Jelly', 'Sneezy'
];

// Folder mapping
$categoryFolders = [
    'Elixir Troops' => 'TH/E_Troops',
    'Dark Elixir Troops' => 'TH/DE_Troops',
    'Super Troops' => 'TH/Super_Troops',
    'Builder Base Troops' => 'TH/BH_Troops',
    'Siege Machines' => 'TH/Siege_Machine',
    'Hero Pets' => 'TH/Pets',
];

// Grouped troop lists to display all by name
$groupedTroops = [
    'Elixir Troops' => $elixirTroops,
    'Dark Elixir Troops' => $darkTroops,
    'Super Troops' => $superTroops,
    'Builder Base Troops' => $builderBaseTroops,
    'Siege Machines' => $siegeMachines,
    'Hero Pets' => $heroPetsList,
];

// Collections from player data
$playerTroops = collect($player['troops'] ?? []);
$playerPets = collect($player['heroPets'] ?? []);
@endphp

<div class="w-full bg-[#0f0f0f] text-white p-6 font-sans">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">Troops</h1>
        <div class="space-y-10">
            @foreach($groupedTroops as $category => $troopList)
                <div class="bg-[#1e1e1e] rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-blue-400">{{ $category }}</h2>
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-9 gap-4 w-full">
                        @foreach($troopList as $troopName)
                            @php
                                $isPet = $category === 'Hero Pets';
                                $collection = $isPet ? $playerPets : $playerTroops;
                                $data = $collection->firstWhere('name', $troopName);
                                $hasTroop = $data !== null;
                                $level = $data['level'] ?? 0;

                                // Format name to image file
                                $imageName = str_replace([' ', '.', '(', ')'], ['_', '', '', ''], $troopName);
                                $troopImage = 'Avatar_' . $imageName . '.webp';

                                $folder = $categoryFolders[$category] ?? 'TH/Other';
                                $imagePath = asset("images/{$folder}/{$troopImage}");
                            @endphp

                            <div class="relative group flex flex-col items-center">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-gray-800 p-1 shadow-lg flex items-center justify-center 
                                    @if($hasTroop) 
                                        border-2 border-blue-500 group-hover:border-blue-400 group-hover:shadow-blue-500/30
                                        transition-all duration-300 group-hover:scale-110
                                    @else
                                        border border-gray-700 opacity-60
                                    @endif">
                                    <img src="{{ $imagePath }}" 
                                         alt="{{ $troopName }}" 
                                         class="w-full h-full rounded-full object-contain 
                                                @if(!$hasTroop) grayscale opacity-50 @endif">
                                </div>
                                <div class="absolute -top-1 -right-1 
                                            @if($hasTroop) bg-blue-500 @else bg-gray-600 @endif
                                            text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
                                    {{ $hasTroop ? $level : 0 }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endisset
