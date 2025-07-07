<div class="mt-8 grid grid-cols-5 gap-5">
    @foreach($player['troops'] as $troop)
        @php
            $troopImage = 'Avatar_Barbarian.webp'; // default

            switch ($troop['name']) {
                case 'Archer':
                    $troopImage = 'Avatar_Archer.webp'; break;
                case 'Giant':
                    $troopImage = 'Avatar_Giant.webp'; break;
                case 'Goblin':
                    $troopImage = 'Avatar_Goblin.webp'; break;
                case 'Wall Breaker':
                    $troopImage = 'Avatar_Wall_Breaker.webp'; break;
                case 'Balloon':
                    $troopImage = 'Avatar_Balloon.webp'; break;
                case 'Wizard':
                    $troopImage = 'Avatar_Wizard.webp'; break;
                case 'Healer':
                    $troopImage = 'Avatar_Healer.webp'; break;
                case 'Dragon':
                    $troopImage = 'Avatar_Dragon.webp'; break;
                case 'P.E.K.K.A':
                    $troopImage = 'Avatar_P.E.K.K.A.webp'; break;
                case 'Baby Dragon':
                    $troopImage = 'Avatar_Baby_Dragon.webp'; break;
                case 'Miner':
                    $troopImage = 'Avatar_Miner.webp'; break;
                case 'Electro Dragon':
                    $troopImage = 'Avatar_Electro_Dragon.webp'; break;
                case 'Yeti':
                    $troopImage = 'Avatar_Yeti.webp'; break;
                case 'Dragon Rider':
                    $troopImage = 'Avatar_Dragon_Rider.webp'; break;
                case 'Thrower':
                    $troopImage = 'Avatar_Thrower.webp'; break;
                case 'Root Rider':
                    $troopImage = 'Avatar_Root_Rider.webp'; break;
                case 'Electro Titan':
                    $troopImage = 'Avatar_Electro_Titan.webp'; break;
            }
        @endphp

        <div class="text-center">
            <img class="w-24 h-24 object-contain mb-2 mx-auto" src="{{ asset('images/TH/E_Troops/' . $troopImage) }}">
            <h1 class="font-semibold">{{ $troop['name'] }}</h1>
            <p>Level: {{ $troop['level'] }}</p>
        </div>
    @endforeach
</div>
