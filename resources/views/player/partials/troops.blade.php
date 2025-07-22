@isset($player)
@php
    $troopData = get_troop_data($player);
@endphp

<div class="w-full bg-[#0f0f0f] text-white p-6 font-sans">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">Troops</h1>
        <div class="space-y-10">
            @foreach($troopData['groupedTroops'] as $category => $troopList)
                <div class="bg-[#1e1e1e] rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 text-blue-400">{{ $category }}</h2>
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-9 gap-4 w-full">
                        @foreach($troopList as $troopName)
                            @php
                                $isPet = $category === 'Hero Pets';
                                $collection = $isPet ? $troopData['playerPets'] : $troopData['playerTroops'];
                                $data = $collection->firstWhere('name', $troopName);
                                $hasTroop = $data !== null;
                                $level = $data['level'] ?? 0;
                                $troopImage = format_troop_image_name($troopName);
                                $folder = $troopData['categoryFolders'][$category] ?? 'TH/Other';
                                $imagePath = asset("images/{$folder}/{$troopImage}");
                            @endphp

                            <div class="relative group flex flex-col items-center">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-gray-800 p-1 shadow-lg flex items-center justify-center 
                                    @if($hasTroop) 
                                        border-2 border-blue-500 group-hover:border-blue-400 group-hover:shadow-blue-500/30
                                        transition-all duration-300 group-hover:scale-110
                                    @else opacity-60
                                    @endif">
                                    <img src="{{ $imagePath }}" 
                                         alt="{{ $troopName }}" 
                                         class="w-full h-full rounded-full object-contain 
                                                @if(!$hasTroop) grayscale opacity-50 @endif">
                                </div>
                                <div class="absolute -top-1 -right-1 
                                            @if($hasTroop) bg-blue-500 @else @endif
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