@extends('layouts.layout')

    @section('content')
    <div class="min-h-screen flex flex-col items-center">
        <h1 class="mb-7 text-2xl font-bold">Clash Intel</h1>
        
            <form class="flex gap-7 content-center" action="{{ route('search') }}" method="POST">
                @csrf
                <input class="border border-gray-400 p-3 rounded-4xl bg-white/35 focus:backdrop-blur-2xl focus:border-blue-400 focus:border-2 outline-none"  type="text" name="tag" placeholder="88JY8P2" required>
                <button class="px-7 border-none rounded-sm  bg-blue-400 hover:bg-blue-600 text-white hover:shadow-2xl" type="submit">Search</button>
            </form>
    </div>
    @endsection

