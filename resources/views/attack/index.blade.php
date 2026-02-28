<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Attack Rotations') }}
            </h2>
            <a href="{{ route('attack.create') }}" class="inline-block px-6 py-2 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                {{ __('Create New') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($message = Session::get('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ $message }}
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($rotations->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($rotations as $rotation)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-lg transition">
                                    <h3 class="font-semibold text-lg mb-3">{{ $rotation->name }}</h3>
                                    <div class="flex gap-2">
                                        <a href="{{ route('attack.show', $rotation->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition text-sm">
                                            {{ __('View') }}
                                        </a>
                                        <a href="{{ route('attack.edit', $rotation->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-sm">
                                            {{ __('Edit') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500">{{ __('No rotations found. Create one to get started!') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>