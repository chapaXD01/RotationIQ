<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Defence Rotation: ') }} {{ $rotation->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Court Visualization -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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

                            <svg id="lines" width="500" height="400"
                                 style="position:absolute; top:0; left:0; pointer-events:none;">
                            </svg>

                            @php
                                $players = json_decode($rotation->players, true);
                            @endphp

                            @foreach ($players as $player)
                                <div class="player"
                                     data-pos="{{ $player['pos'] }}"
                                     data-role="{{ $player['role'] }}"
                                     style="top: {{ $player['top'] }}px;
                                            left: {{ $player['left'] }}px">
                                    {{ $player['role'] }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Controls Panel -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-semibold text-lg mb-4">{{ __('Update Rotation') }}</h3>
                        
                        <!-- Rotation Name -->
                        <div class="mb-6">
                            <label for="rotation-name" class="block text-sm font-medium mb-2">{{ __('Rotation Name') }}</label>
                            <input type="text"
                                   id="rotation-name"
                                   value="{{ $rotation->name }}"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-2">
                            <button onclick="checkRotationWithVisuals()" class="w-full px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition">
                                {{ __('Check Rotation') }}
                            </button>
                            <button onclick="updateRotation({{ $rotation->id }})" class="w-full px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                                {{ __('Update Rotation') }}
                            </button>
                            <a href="{{ route('defence.index') }}" class="block text-center px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                                {{ __('Cancel') }}
                            </a>
                        </div>

                        <div id="errors" class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 rounded-lg hidden">
                            <ul id="error-list" class="list-disc list-inside"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('script.js') }}"></script>
</x-app-layout>
