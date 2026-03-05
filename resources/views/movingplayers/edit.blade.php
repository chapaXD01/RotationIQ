<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Movement: ') }} {{ $movement->name }}
            </h2>
            <a href="{{ route('movingplayers.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        Edit Player Movement
                    </h1>

                    <div class="flex flex-col gap-8">
                        <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                            <h2 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">How to Use:</h2>
                            <ul class="text-blue-800 dark:text-blue-200 text-sm space-y-1">
                                <li>1. <strong>Click a player</strong> to select them (highlighted with yellow outline)</li>
                                <li>2. <strong>Click anywhere on the court</strong> to set their destination (marked with a black dot)</li>
                                <li>3. Set destinations for multiple players</li>
                                <li>4. Click <strong>"Animate Movement"</strong> to watch all players move together</li>
                                <li>5. Click <strong>"Update Movement"</strong> to save changes</li>
                            </ul>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-8 items-start justify-center">
                            <div id="courtContainer" style="position: relative; display: inline-block;">
                                <link rel="stylesheet" href="{{ asset('style.css') }}">
                                <div id="court" style="margin: 0; padding: 0; cursor: crosshair;">
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
                                             data-pos="{{ $player['pos'] }}"
                                             data-role="{{ $player['role'] }}"
                                             style="top: {{ $player['top'] }}px;
                                                    left: {{ $player['left'] }}px">
                                            {{ $player['role'] }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6 min-w-max">
                                <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-4">Controls</h3>
                                
                                <div class="space-y-3">
                                    <button id="animateBtn" class="w-full px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                                        Animate Movement
                                    </button>
                                    
                                    <button id="rotateBtn" class="w-full px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition">
                                        Rotate Position ⟳
                                    </button>

                                    <button id="resetBtn" class="w-full px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg transition">
                                        Reset All
                                    </button>

                                    <button id="clearDestinationsBtn" class="w-full px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition">
                                        Clear Destinations
                                    </button>
                                </div>
                                <div class="mt-6 pt-6 border-t border-gray-300 dark:border-gray-600">
                                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Selected Player:</p>
                                    <div id="selectedInfo" class="text-sm text-gray-600 dark:text-gray-400">
                                        None selected
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Destinations Set:</p>
                                    <div id="destinationCount" class="text-sm text-gray-600 dark:text-gray-400" style="font-size: 18px; font-weight: bold;">
                                        0 / 6
                                    </div>
                                </div>

                                <div class="mt-6 pt-6 border-t border-gray-300 dark:border-gray-600">
                                    <label for="movement-name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('Movement Name') }}</label>
                                    <input type="text" id="movement-name" value="{{ $movement->name }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-600 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" style="color: #111827;">
                                    
                                    <button onclick="updateMovement({{ $movement->id }})" class="w-full mt-3 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                                        Update Movement
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #courtContainer #court {
            cursor: crosshair;
            user-select: none;
        }

        #courtContainer .player {
            transition: left 0.6s ease, top 0.6s ease;
            user-select: none;
            cursor: pointer;
        }

        #courtContainer .player:hover {
            filter: brightness(1.1);
        }

        #courtContainer .player.selected {
            outline: 3px solid #fbbf24;
            box-shadow: 0 0 0 2px rgba(251, 191, 36, 0.5);
        }

        .destination-marker {
            width: 12px;
            height: 12px;
            background: #000;
            border-radius: 50%;
            position: absolute;
            pointer-events: none;
            z-index: 10;
        }

        #movement-name {
            color: #111827 !important;
        }

        @media (prefers-color-scheme: dark) {
            #movement-name {
                color: white !important;
            }
        }

        .animation-in-progress {
            pointer-events: none;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        function updateMovement(id) {
            const name = document.getElementById('movement-name').value;

            if (!name) {
                alert("Please enter a movement name");
                return;
            }

            const players = [];
            document.querySelectorAll('#court .player').forEach(player => {
                players.push({
                    role: player.dataset.role,
                    pos: player.dataset.pos,
                    top: parseFloat(player.style.top),
                    left: parseFloat(player.style.left)
                });
            });

            const token = document.querySelector('meta[name="csrf-token"]').content;

            fetch(`/movingplayers/${id}`, {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify({
                    name: name,
                    players: players
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Server error");
                }
                return response.json();
            })
            .then(data => {
                alert("Movement updated successfully");
                window.location.href = "/movingplayers";
            })
            .catch(error => {
                console.error(error);
                alert("Failed to update movement");
            });
        }
    </script>
    <script src="{{ asset('script.js') }}"></script>
</x-app-layout>
