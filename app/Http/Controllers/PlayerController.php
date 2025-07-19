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

        $homeVillageTop = Cache::rememberForever('homeVillageTop', function () use ($token, $base) {
            return Http::withToken($token)->get("{$base}/players", ['limit' => 5])->json('items') ?? [];
        });

        $builderBaseTop = Cache::rememberForever('builderBaseTop', function () use ($token, $base) {
            return Http::withToken($token)->get("{$base}/players-builder-base", ['limit' => 5])->json('items') ?? [];
        });

        $homeClanTop = Cache::rememberForever('homeClanTop', function () use ($token, $base) {
            return Http::withToken($token)->get("{$base}/clans", ['limit' => 5])->json('items') ?? [];
        });

        $builderClanTop = Cache::rememberForever('builderClanTop', function () use ($token, $base) {
            return Http::withToken($token)->get("{$base}/clans-builder-base", ['limit' => 5])->json('items') ?? [];
        });

        $capitalClanTop = Cache::rememberForever('capitalClanTop', function () use ($token, $base) {
            return Http::withToken($token)->get("{$base}/capitals", ['limit' => 5])->json('items') ?? [];
        });

        return view('index', compact('homeVillageTop', 'builderBaseTop', 'homeClanTop', 'builderClanTop', 'capitalClanTop'));
    }

    public function search(Request $request)
    {
        $input = trim($request->input('tag'));

        if (str_starts_with($input, '#')) {
            $tag = urlencode($input);

            $playerRes = Http::withToken(env('COC_API_TOKEN'))->get("https://api.clashofclans.com/v1/players/{$tag}");
            if ($playerRes->successful()) {
                return redirect()->route('player.show', ['tag' => ltrim($input, '#')]);
            }

            $clanRes = Http::withToken(env('COC_API_TOKEN'))->get("https://api.clashofclans.com/v1/clans/{$tag}");
            if ($clanRes->successful()) {
                return redirect()->route('clan.show', ['tag' => ltrim($input, '#')]);
            }

            return view('info', ['error' => 'No player or clan found with this tag.']);
        }

        if (strlen($input) < 3) {
            return view('clan_preview', ['error' => 'Search term must be at least 3 characters long.']);
        }

        $res = Cache::rememberForever("clan_search_{$input}", function () use ($input) {
            return Http::withToken(env('COC_API_TOKEN'))->get('https://api.clashofclans.com/v1/clans', [
                'name' => $input,
                'limit' => 100
            ]);
        });

        if ($res->successful()) {
            return view('clan_preview', ['clans' => $res->json('items') ?? []]);
        }

        return view('clan_preview', ['error' => 'No clans found.']);
    }

    public function show($tag)
    {
        $tag = '#' . ltrim($tag, '#');

        $res = Cache::rememberForever("player_info_{$tag}", function () use ($tag) {
            return Http::withToken(env('COC_API_TOKEN'))->get("https://api.clashofclans.com/v1/players/" . urlencode($tag));
        });

        if ($res->successful()) {
            return view('info', ['player' => $res->json()]);
        }

        return view('info', ['error' => 'Player not found.']);
    }

    public function searchClans(Request $request)
    {
        $name = $request->query('name');
        if (!$name || strlen($name) < 3) {
            return view('clan_preview', ['error' => 'Clan name must be at least 3 characters long.']);
        }

        $res = Cache::rememberForever("clan_search_name_{$name}", function () use ($name) {
            return Http::withToken(env('COC_API_TOKEN'))->get('https://api.clashofclans.com/v1/clans', [
                'name' => $name,
                'limit' => 100
            ]);
        });

        if ($res->successful()) {
            return view('clan_preview', ['clans' => $res->json('items') ?? []]);
        }

        return view('clan_preview', ['error' => 'No clans found.']);
    }

    public function showClan($tag)
    {
        $tag = '#' . ltrim($tag, '#');
        $token = env('COC_API_TOKEN');

        $clan = Cache::rememberForever("clan_info_{$tag}", function () use ($tag, $token) {
            $res = Http::withToken($token)->get("https://api.clashofclans.com/v1/clans/" . urlencode($tag));
            return $res->successful() ? $res->json() : null;
        });

        if (!$clan) {
            return view('clan', ['error' => 'Clan not found or invalid tag.']);
        }

        $clan['currentWar'] = Cache::rememberForever("clan_war_{$tag}", function () use ($tag, $token) {
            $res = Http::withToken($token)->get("https://api.clashofclans.com/v1/clans/" . urlencode($tag) . "/currentwar");
            return $res->successful() ? $res->json() : null;
        });

        $clan['cwl'] = Cache::rememberForever("clan_cwl_{$tag}", function () use ($tag, $token) {
            $res = Http::withToken($token)->get("https://api.clashofclans.com/v1/clans/" . urlencode($tag) . "/currentwar/leaguegroup");
            return $res->successful() ? $res->json() : null;
        });

        $clan['warLog'] = Cache::rememberForever("clan_warlog_{$tag}", function () use ($tag, $token) {
            $res = Http::withToken($token)->get("https://api.clashofclans.com/v1/clans/" . urlencode($tag) . "/warlog");
            return $res->successful() ? $res->json() : null;
        });

        return view('clan', ['clan' => $clan]);
    }
}
