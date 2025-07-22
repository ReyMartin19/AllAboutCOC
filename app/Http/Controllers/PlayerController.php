<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PlayerController extends Controller
{
    public function index()
    {
        $base = 'https://api.clashofclans.com/v1/locations/global/rankings';
        $token = env('COC_API_TOKEN');

        $homeVillageTop = Cache::remember('homeVillageTop', 3600, function () use ($token, $base) {
            $res = Http::withToken($token)->get("{$base}/players", ['limit' => 5]);
            return $res->successful() ? $res->json('items') ?? [] : [];
        });

        $builderBaseTop = Cache::remember('builderBaseTop', 3600, function () use ($token, $base) {
            $res = Http::withToken($token)->get("{$base}/players-builder-base", ['limit' => 5]);
            return $res->successful() ? $res->json('items') ?? [] : [];
        });

        $homeClanTop = Cache::remember('homeClanTop', 3600, function () use ($token, $base) {
            $res = Http::withToken($token)->get("{$base}/clans", ['limit' => 5]);
            return $res->successful() ? $res->json('items') ?? [] : [];
        });

        $builderClanTop = Cache::remember('builderClanTop', 3600, function () use ($token, $base) {
            $res = Http::withToken($token)->get("{$base}/clans-builder-base", ['limit' => 5]);
            return $res->successful() ? $res->json('items') ?? [] : [];
        });

        $capitalClanTop = Cache::remember('capitalClanTop', 3600, function () use ($token, $base) {
            $res = Http::withToken($token)->get("{$base}/capitals", ['limit' => 5]);
            return $res->successful() ? $res->json('items') ?? [] : [];
        });

        return view('index', compact('homeVillageTop', 'builderBaseTop', 'homeClanTop', 'builderClanTop', 'capitalClanTop'));
    }

    public function search(Request $request)
    {
        $input = trim($request->input('tag'));

        if (str_starts_with($input, '#')) {
            $tag = urlencode($input);

            // Check if player exists
            $playerData = Cache::remember("player_search_{$tag}", 3600, function () use ($tag) {
                $res = Http::withToken(env('COC_API_TOKEN'))->get("https://api.clashofclans.com/v1/players/{$tag}");
                return $res->successful() ? $res->json() : null;
            });

            if ($playerData) {
                return redirect()->route('player.show', ['tag' => ltrim($input, '#')]);
            }

            // Check if clan exists
            $clanData = Cache::remember("clan_search_{$tag}", 3600, function () use ($tag) {
                $res = Http::withToken(env('COC_API_TOKEN'))->get("https://api.clashofclans.com/v1/clans/{$tag}");
                return $res->successful() ? $res->json() : null;
            });

            if ($clanData) {
                return redirect()->route('clan.show', ['tag' => ltrim($input, '#')]);
            }

            return view('player.index', ['error' => 'No player or clan found with this tag.']);
        }

        if (strlen($input) < 3) {
            return view('clan.clan_preview', ['error' => 'Search term must be at least 3 characters long.']);
        }

        $clans = Cache::remember("clan_name_search_{$input}", 3600, function () use ($input) {
            $res = Http::withToken(env('COC_API_TOKEN'))->get('https://api.clashofclans.com/v1/clans', [
                'name' => $input,
                'limit' => 100
            ]);
            return $res->successful() ? $res->json('items') ?? [] : [];
        });

        return view('clan.clan_preview', ['clans' => $clans]);
    }

    public function show($tag)
    {
        $tag = '#' . ltrim($tag, '#');

        $player = Cache::remember("player_info_{$tag}", 3600, function () use ($tag) {
            $res = Http::withToken(env('COC_API_TOKEN'))->get("https://api.clashofclans.com/v1/players/" . urlencode($tag));
            return $res->successful() ? $res->json() : null;
        });

        if (!$player) {
            return view('player.index', ['error' => 'Player not found.']);
        }

        // Make sure the player data is properly formatted
        if (is_array($player)) {
            return view('player.index', ['player' => $player]);
        }

        return view('player.index', ['error' => 'Invalid player data.']);
    }

    public function searchClans(Request $request)
    {
        $name = $request->query('name');
        if (!$name || strlen($name) < 3) {
            return view('clan.clan_preview', ['error' => 'Clan name must be at least 3 characters long.']);
        }

        $clans = Cache::remember("clan_search_name_{$name}", 3600, function () use ($name) {
            $res = Http::withToken(env('COC_API_TOKEN'))->get('https://api.clashofclans.com/v1/clans', [
                'name' => $name,
                'limit' => 100
            ]);
            return $res->successful() ? $res->json('items') ?? [] : [];
        });

        return view('clan.clan_preview', ['clans' => $clans]);
    }

    public function showClan($tag)
    {
        $tag = '#' . ltrim($tag, '#');
        $token = env('COC_API_TOKEN');

        $clan = Cache::remember("clan_info_{$tag}", 3600, function () use ($tag, $token) {
            $res = Http::withToken($token)->get("https://api.clashofclans.com/v1/clans/" . urlencode($tag));
            return $res->successful() ? $res->json() : null;
        });

        if (!$clan) {
            return view('clan.clan', ['error' => 'Clan not found or invalid tag.']);
        }

        $clan['currentWar'] = Cache::remember("clan_war_{$tag}", 3600, function () use ($tag, $token) {
            $res = Http::withToken($token)->get("https://api.clashofclans.com/v1/clans/" . urlencode($tag) . "/currentwar");
            return $res->successful() ? $res->json() : null;
        });

        $clan['cwl'] = Cache::remember("clan_cwl_{$tag}", 3600, function () use ($tag, $token) {
            $res = Http::withToken($token)->get("https://api.clashofclans.com/v1/clans/" . urlencode($tag) . "/currentwar/leaguegroup");
            return $res->successful() ? $res->json() : null;
        });

        $clan['warLog'] = Cache::remember("clan_warlog_{$tag}", 3600, function () use ($tag, $token) {
            $res = Http::withToken($token)->get("https://api.clashofclans.com/v1/clans/" . urlencode($tag) . "/warlog");
            return $res->successful() ? $res->json() : null;
        });

        return view('clan.clan', ['clan' => $clan]);
    }
}