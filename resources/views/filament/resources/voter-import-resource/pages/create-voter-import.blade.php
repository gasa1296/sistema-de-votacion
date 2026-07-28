<x-filament-panels::page>
    <form wire:submit="import">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit" wire:loading.attr="disabled">
                Importar Votantes
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
