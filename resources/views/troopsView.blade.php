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

$heroPets = [
    'L.A.S.S.I', 'Electro Owl', 'Mighty Yak', 'Unicorn',
    'Frosty', 'Diggy', 'Poison Lizard', 'Phoenix',
    'Spirit Fox', 'Angry Jelly', 'Sneezy'
];

// Grouped output
$groupedTroops = [
    'Elixir Troops' => [],
    'Dark Elixir Troops' => [],
    'Super Troops' => [],
    'Builder Base Troops' => [],
    'Siege Machines' => [],
    'Hero Pets' => [],
    'Other' => [],
];

// Sort each troop
foreach ($player['troops'] as $troop) {
    $name = $troop['name'];

    if (in_array($name, $elixirTroops)) {
        $groupedTroops['Elixir Troops'][] = $troop;
    } elseif (in_array($name, $darkTroops)) {
        $groupedTroops['Dark Elixir Troops'][] = $troop;
    } elseif (in_array($name, $superTroops)) {
        $groupedTroops['Super Troops'][] = $troop;
    } elseif (in_array($name, $builderBaseTroops)) {
        $groupedTroops['Builder Base Troops'][] = $troop;
    } elseif (in_array($name, $siegeMachines)) {
        $groupedTroops['Siege Machines'][] = $troop;
    } elseif (in_array($name, $heroPets)) {
        $groupedTroops['Hero Pets'][] = $troop;
    } else {
        $groupedTroops['Other'][] = $troop;
    }
}

// Folder mapping
$categoryFolders = [
    'Elixir Troops' => 'TH/E_Troops',
    'Dark Elixir Troops' => 'TH/DE_Troops',
    'Super Troops' => 'TH/Super_Troops',
    'Builder Base Troops' => 'TH/BH_Troops',
    'Siege Machines' => 'TH/Siege_Machine',
    'Hero Pets' => 'TH/Pets',
    'Other' => 'TH/Other',
];
@endphp

{{-- HTML Output --}}
@foreach($groupedTroops as $category => $troops)
    @if(count($troops) > 0)
        <div class="mt-10">
            <h2 class="text-2xl font-bold mb-4">{{ $category }}</h2>
            <div class="grid grid-cols-5 gap-4">
                @foreach($troops as $troop)
                    @php
                        // Clean name to build image file
                        $imageName = str_replace([' ', '.', '(', ')'], ['_', '', '', ''], $troop['name']);
                        $troopImage = 'Avatar_' . $imageName . '.webp';

                        // Build image path
                        $folder = $categoryFolders[$category] ?? 'TH/Other';
                        $imagePath = asset("images/{$folder}/{$troopImage}");
                    @endphp
                    <div class="text-center">
                        <img class="w-24 h-24 object-contain mb-2 mx-auto"
                             src="{{ $imagePath }}"
                             alt="{{ $troop['name'] }}">
                        <h3 class="font-semibold">{{ $troop['name'] }}</h3>
                        <p>Level: {{ $troop['level'] ?? '?' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endforeach
@endisset