<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Attack Rotation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
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

                            <div class="player" data-pos="4" data-role="RS" style="top:78px; left:61px;">RS</div>
                            <div class="player" data-pos="3" data-role="MB" style="top:78px; left:228px;">MB</div>
                            <div class="player" data-pos="2" data-role="OH" style="top:78px; left:395px;">OH</div>

                            <div class="player" data-pos="5" data-role="OH" style="top:278px; left:61px;">OH</div>
                            <div class="player" data-pos="6" data-role="L"  style="top:278px; left:228px;">L</div>
                            <div class="player" data-pos="1"  data-role="S" style="top:278px; left:395px;">S</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-semibold text-lg mb-4">{{ __('Rotation Settings') }}</h3>
                        <div class="mb-4">
                            <label for="rotation-name" class="block text-sm font-medium mb-2">{{ __('Rotation Name') }}</label>
                            <input type="text" id="rotation-name" placeholder="Enter rotation name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="mb-6">
                            <label for="rotationType" class="block text-sm font-medium mb-2">{{ __('Rotation Type') }}</label>
                            <select id="rotationType" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="attack">Attack Rotation</option>
                                <option value="defence">Defence Rotation</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <button onclick="checkRotationWithVisuals()" class="w-full px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition">
                                {{ __('Check Rotation') }}
                            </button>
                            <button onclick="rotateClockwise()" class="w-full px-4 py-2 bg-purple-500 text-white font-semibold rounded-lg hover:bg-purple-600 transition">
                                {{ __('Rotate Clockwise ⟳') }}
                            </button>
                            <button onclick="saveRotation()" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                {{ __('Save Rotation') }}
                            </button>
                            <a href="{{ route('attack.index') }}" class="block text-center px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
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