<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PlayerController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        $tag = strtoupper($request->input('tag'));
        $tag = urlencode('#' . $tag);

        $response = Http::withToken(env('COC_API_TOKEN'))
            ->get("https://api.clashofclans.com/v1/players/{$tag}");

        if ($response->successful()) {
            $player = $response->json();
            return view('index', ['player' => $player]);
        } else {
            return view('index', ['error' => 'Player not found or invalid tag.']);
        }
    }
}
