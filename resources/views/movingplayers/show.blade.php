<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $movement->name }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('movingplayers.animate', $movement->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                    {{ __('Animate') }}
                </a>
                <a href="{{ route('movingplayers.edit', $movement->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('movingplayers.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                    {{ __('Back') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgba(59, 130, 246, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                <div class="p-6 flex justify-center">
                    <link rel="stylesheet" href="{{ asset('style.css') }}">
                    <div id="court" style="margin: 0; padding: 0;">
                        <div class="zones">
                            <div class="zone">4</div>
                            <div class="zone">3</div>
                            <div class="zone">2</div>
                            <div class="zone">5</div>
                            <div class="zone">6</div>
                            <div class="zone">1</div>
                        </div>

                        @php
                            $players = json_decode($movement->players, true);
                        @endphp

                        @foreach ($players as $player)
                            <div class="player"
                                 style="top: {{ $player['top'] }}px;
                                        left: {{ $player['left'] }}px">
                                {{ $player['role'] }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
