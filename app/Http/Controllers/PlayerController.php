<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlayerController extends Controller
{
    public function index()
    {
        $globalUrl = 'https://api.clashofclans.com/v1/locations/global/rankings/players';
        $builderUrl = 'https://api.clashofclans.com/v1/locations/global/rankings/players-builder-base';
        $homeClanUrl = 'https://api.clashofclans.com/v1/locations/global/rankings/clans';
        $builderClanUrl = 'https://api.clashofclans.com/v1/locations/global/rankings/clans-builder-base';
        $capitalClanUrl = 'https://api.clashofclans.com/v1/locations/global/rankings/capitals';

        $homeVillageTop = [];
        $builderBaseTop = [];
        $homeClanTop = [];
        $builderClanTop = [];
        $capitalClanTop = [];

        $globalResponse = Http::withToken(env('COC_API_TOKEN'))->get($globalUrl, ['limit' => 5]);
        $builderResponse = Http::withToken(env('COC_API_TOKEN'))->get($builderUrl, ['limit' => 5]);
        $homeClanResponse = Http::withToken(env('COC_API_TOKEN'))->get($homeClanUrl, ['limit' => 5]);
        $builderClanResponse = Http::withToken(env('COC_API_TOKEN'))->get($builderClanUrl, ['limit' => 5]);
        $capitalClanResponse = Http::withToken(env('COC_API_TOKEN'))->get($capitalClanUrl, ['limit' => 5]);

        if ($globalResponse->successful()) {
            $homeVillageTop = $globalResponse->json('items') ?? [];
        }

        if ($builderResponse->successful()) {
            $builderBaseTop = $builderResponse->json('items') ?? [];
        }

        if ($homeClanResponse->successful()) {
            $homeClanTop = $homeClanResponse->json('items') ?? [];
        }

        if ($builderClanResponse->successful()) {
            $builderClanTop = $builderClanResponse->json('items') ?? [];
        }

        if ($capitalClanResponse->successful()) {
            $capitalClanTop = $capitalClanResponse->json('items') ?? [];
        }

        return view('index', compact('homeVillageTop', 'builderBaseTop', 'homeClanTop', 'builderClanTop', 'capitalClanTop'));      
    }

    public function search(Request $request)
    {
        $input = trim($request->input('tag'));
        
        // First check if it's a player tag (starts with #)
        if (str_starts_with($input, '#')) {
            $tag = urlencode($input);
            
            // Try player API first
            $playerResponse = Http::withToken(env('COC_API_TOKEN'))
                ->get("https://api.clashofclans.com/v1/players/{$tag}");
                
            if ($playerResponse->successful()) {
                $player = $playerResponse->json();
                return view('info', ['player' => $player]);
            }
            
            // If player not found, try clan API
            $clanResponse = Http::withToken(env('COC_API_TOKEN'))
                ->get("https://api.clashofclans.com/v1/clans/{$tag}");
                
            if ($clanResponse->successful()) {
                $clan = $clanResponse->json();
                return view('clan', ['clans' => [$clan]]);
            }
            
            // If neither found, show error
            return view('info', ['error' => 'No player or clan found with this tag.']);
        }
        
        // If input doesn't start with #, treat as clan name search
        if (strlen($input) < 3) {
            return view('clan', ['error' => 'Search term must be at least 3 characters long.']);
        }
        
        $response = Http::withToken(env('COC_API_TOKEN'))
            ->get('https://api.clashofclans.com/v1/clans', [
                'name' => $input,
                'limit' => 10
            ]);
        
        if ($response->successful()) {
            $clans = $response->json();
            return view('clan', ['clans' => $clans['items'] ?? []]);
        }
        
        return view('clan', ['error' => 'No clans found.']);
    }

}
