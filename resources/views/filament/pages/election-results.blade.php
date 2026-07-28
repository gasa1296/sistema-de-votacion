<x-filament-panels::page>
    @if($this->results)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($this->results as $candidate)
                <div class="filament-card rounded-xl bg-white p-6 shadow-sm dark:bg-gray-900">
                    <div class="flex items-center gap-4">
                        @if($candidate['photo_path'])
                            <img
                                src="{{ Storage::disk('public')->url($candidate['photo_path']) }}"
                                alt="{{ $candidate['name'] }}"
                                class="h-16 w-16 rounded-full object-cover"
                            />
                        @else
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-50 dark:bg-primary-950">
                                <x-heroicon-o-user class="h-8 w-8 text-primary-500" />
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $candidate['name'] }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $candidate['position'] }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 dark:text-gray-400">Votos</span>
                            <span class="font-semibold text-gray-900 dark:text-white">
                                {{ $candidate['votes'] }} ({{ $candidate['percentage'] }}%)
                            </span>
                        </div>
                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                            <div
                                class="h-full rounded-full bg-primary-500 transition-all duration-500"
                                style="width: {{ $candidate['percentage'] }}%"
                            ></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-500 dark:text-gray-400">
            No hay elección activa o no hay resultados disponibles.
        </div>
    @endif
</x-filament-panels::page>
