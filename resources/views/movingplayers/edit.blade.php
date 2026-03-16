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
            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgba(59, 130, 246, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        Edit Player Movement
                    </h1>

                    <div class="flex flex-col gap-8">
                        <div class="rounded-lg p-4" style="background-color: rgba(59, 130, 246, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                            <h2 class="font-semibold text-white mb-2">How to Use:</h2>
                            <ul class="text-white text-sm space-y-1">
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

                            <div class="rounded-lg p-6" style="background-color: rgba(59, 130, 246, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                <h3 class="font-semibold text-white mb-4">Controls</h3>
                                
                                <div class="space-y-3">
                                    <button id="animateBtn" class="w-full px-6 py-3 text-white font-semibold rounded-lg transition" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.9) 0%, rgba(59, 130, 246, 0.9) 100%); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        Animate Movement
                                    </button>
                                    
                                    <button id="rotateBtn" class="w-full px-6 py-3 text-white font-semibold rounded-lg transition" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.85) 0%, rgba(37, 99, 235, 0.85) 100%); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        Rotate Position ⟳
                                    </button>

                                    <button id="resetBtn" class="w-full px-6 py-3 text-white font-semibold rounded-lg transition" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.8) 0%, rgba(59, 130, 246, 0.8) 100%); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        Reset All
                                    </button>

                                    <button id="clearDestinationsBtn" class="w-full px-6 py-3 text-white font-semibold rounded-lg transition" style="background-color: rgba(75, 85, 99, 0.6); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        Clear Destinations
                                    </button>
                                </div>
                                <div class="mt-6 pt-6 border-t border-gray-400">
                                    <p class="text-sm font-semibold text-white mb-2">Selected Player:</p>
                                    <div id="selectedInfo" class="text-sm text-gray-200">
                                        None selected
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <p class="text-sm font-semibold text-white mb-2">Destinations Set:</p>
                                    <div id="destinationCount" class="text-sm text-gray-200" style="font-size: 18px; font-weight: bold;">
                                        0 / 6
                                    </div>
                                </div>

                                <div class="mt-6 pt-6 border-t border-gray-400">
                                    <label for="movement-name" class="block text-sm font-semibold text-white mb-2">{{ __('Movement Name') }}</label>
                                    <input type="text" id="movement-name" value="{{ $movement->name }}" class="w-full px-4 py-2 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-300 transition" style="background-color: rgba(30, 41, 59, 0.6); border: 1px solid rgba(255, 255, 255, 0.2); color: white;">
                                    
                                    <button onclick="updateMovement({{ $movement->id }})" class="w-full mt-3 px-6 py-3 text-white font-semibold rounded-lg transition" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.9) 0%, rgba(37, 99, 235, 0.9) 100%); border: 1px solid rgba(255, 255, 255, 0.3);">
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
