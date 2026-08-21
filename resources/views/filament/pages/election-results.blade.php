<x-filament-panels::page>
    <div
        x-data="{}"
        x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('election-results'))]"
        @if($electionStatus === 'open')
            wire:poll.5s="loadElectionData"
        @endif
        class="space-y-4"
    >
        @if($this->selectedElectionId && $this->electionName)
            {{-- Top Controls & Election Status Bar --}}
            <x-filament::section>

                @if(count($this->electionsList) > 1)
                    <x-slot name="afterHeader">
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="w-full sm:w-72">
                                <label for="election-select" class="fi-sr-only">Seleccionar Elección</label>
                                <select
                                    id="election-select"
                                    wire:model.live="selectedElectionId"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-950 shadow-sm transition-colors focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50"
                                >
                                    @foreach($this->electionsList as $el)
                                        <option value="{{ $el['id'] }}">
                                            {{ $el['name'] }} ({{ $el['status'] === 'open' ? 'En Vivo' : ($el['status'] === 'closed' ? 'Cerrada' : 'Pendiente') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if($this->electionStatus === 'open')
                                <x-filament::badge color="success" icon="heroicon-m-signal">
                                    En Votación (En Vivo)
                                </x-filament::badge>
                            @elseif($this->electionStatus === 'closed')
                                <x-filament::badge color="gray" icon="heroicon-m-lock-closed">
                                    Votación Finalizada
                                </x-filament::badge>
                            @else
                                <x-filament::badge color="warning" icon="heroicon-m-clock">
                                    Votación Programada
                                </x-filament::badge>
                            @endif

                            @if($this->lastUpdated)
                                <x-filament::badge color="gray" icon="heroicon-m-arrow-path">
                                    Actualizado: {{ $this->lastUpdated }}
                                </x-filament::badge>
                            @endif
                        </div>
                    </x-slot>
                @else
                    <x-slot name="heading">
                        {{ $this->electionName }}
                    </x-slot>
                    <x-slot name="description">
                        @if($this->opensAt)
                            {{ $this->opensAt }}@if($this->closesAt) - {{ $this->closesAt }}@endif
                        @endif
                    </x-slot>
                    <x-slot name="afterHeader">
                        <div class="flex flex-wrap items-center gap-3">
                            @if($this->electionStatus === 'open')
                                <x-filament::badge color="success" icon="heroicon-m-signal">
                                    En Votación (En Vivo)
                                </x-filament::badge>
                            @elseif($this->electionStatus === 'closed')
                                <x-filament::badge color="gray" icon="heroicon-m-lock-closed">
                                    Votación Finalizada
                                </x-filament::badge>
                            @else
                                <x-filament::badge color="warning" icon="heroicon-m-clock">
                                    Votación Programada
                                </x-filament::badge>
                            @endif

                            @if($this->lastUpdated)
                                <x-filament::badge color="gray" icon="heroicon-m-arrow-path">
                                    Actualizado: {{ $this->lastUpdated }}
                                </x-filament::badge>
                            @endif
                        </div>
                    </x-slot>
                @endif
            </x-filament::section>

            {{-- Summary KPI Cards --}}
            <div class="grid grid-cols-1 gap-4">
                {{-- Card 1: Total Votos Emitidos --}}
                <x-filament::section compact>
                    <x-slot name="heading">
                        Votos Emitidos
                    </x-slot>

                    <p class="fi-section-header-heading text-2xl font-black tracking-tight">
                        {{ number_format($this->turnout['total_votes']) }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        de {{ number_format($this->turnout['total_voters']) }} votantes registrados
                    </p>
                </x-filament::section>

                {{-- Card 2: Padrón Electoral --}}
                <x-filament::section compact>
                    <x-slot name="heading">
                        Padrón Habilitado
                    </x-slot>

                    <p class="fi-section-header-heading text-2xl font-black tracking-tight">
                        {{ number_format($this->turnout['total_voters']) }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Votantes con derecho a sufragio
                    </p>
                </x-filament::section>

                {{-- Card 3: Participación Electoral --}}
                <x-filament::section compact>
                    <x-slot name="heading">
                        Participación
                    </x-slot>

                    <p class="fi-section-header-heading text-2xl font-black tracking-tight">
                        {{ $this->turnout['percentage'] }}%
                    </p>
                    <div class="mt-2 flex items-center gap-2">
                        <div class="h-1.5 flex-1 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                            <div
                                class="h-full rounded-full bg-emerald-500 transition-all duration-500"
                                style="width: {{ min(100, $this->turnout['percentage']) }}%"
                            ></div>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            {{ number_format(max(0, $this->turnout['total_voters'] - $this->turnout['total_votes'])) }} pendientes
                        </span>
                    </div>
                </x-filament::section>

                {{-- Card 4: Candidato Líder / Ganador --}}
                <x-filament::section compact>
                    <x-slot name="heading">
                        @if($this->electionStatus === 'closed')
                            Ganador Oficial
                        @else
                            Candidato Líder
                        @endif

                    <p class="fi-section-header-heading truncate text-lg font-black tracking-tight" title="{{ $this->leader['name'] ?? 'Sin votos' }}">
                        {{ $this->leader['name'] ?? 'A la espera de votos' }}
                    </p>
                    <p class="mt-1 truncate text-xs text-gray-500 dark:text-gray-400">
                        @if($this->leader)
                            {{ $this->leader['position'] }} &bull; <strong class="text-amber-600 dark:text-amber-400">{{ $this->leader['percentage'] }}%</strong> ({{ $this->leader['votes'] }} votos)
                        @else
                            No se han registrado sufragios
                        @endif
                    </p>
                </x-filament::section>
            </div>

            {{-- Main Section: Pie Chart + Leaderboard --}}
            <div
                x-data="{
                    hoveredId: null,
                    hoveredName: null,
                    hoveredVotes: null,
                    hoveredPct: null,
                    hoveredColor: null,
                    setHover(cand) {
                        if (cand) {
                            this.hoveredId = cand.id;
                            this.hoveredName = cand.name;
                            this.hoveredVotes = cand.votes;
                            this.hoveredPct = cand.percentage;
                            this.hoveredColor = cand.color;
                        } else {
                            this.hoveredId = null;
                            this.hoveredName = null;
                            this.hoveredVotes = null;
                            this.hoveredPct = null;
                            this.hoveredColor = null;
                        }
                    }
                }"
                class="grid grid-cols-1 gap-4 lg:grid-cols-12"
            >
                {{-- Left Column: Interactive Pie/Donut Chart --}}
                <x-filament::section class="lg:col-span-5">
                    <x-slot name="heading">
                        Gráfica de Resultados
                    </x-slot>
                    <x-slot name="description">
                        Distribución proporcional del total de votos emitidos
                    </x-slot>

                    <div class="py-6">
                        @if($this->turnout['total_votes'] > 0 && !empty($this->results))
                            <div class="relative mx-auto flex max-w-[280px] items-center justify-center">
                                <svg
                                    class="h-64 w-64 -rotate-90 transform overflow-visible"
                                    viewBox="0 0 100 100"
                                >
                                    <circle
                                        cx="50"
                                        cy="50"
                                        r="40"
                                        fill="transparent"
                                        stroke="currentColor"
                                        stroke-width="12"
                                        class="text-gray-100 dark:text-gray-800"
                                    />

                                    @foreach($this->results as $candidate)
                                        @if($candidate['percentage'] > 0)
                                            <circle
                                                cx="50"
                                                cy="50"
                                                r="40"
                                                fill="transparent"
                                                stroke="{{ $candidate['color'] }}"
                                                stroke-width="12"
                                                stroke-dasharray="{{ $candidate['dash_length'] }} 251.327"
                                                stroke-dashoffset="{{ $candidate['dash_offset'] }}"
                                                class="cursor-pointer transition-all duration-300 ease-out hover:opacity-85"
                                                :class="{ 'opacity-30': hoveredId !== null && hoveredId !== {{ $candidate['id'] }}, 'stroke-[15px]': hoveredId === {{ $candidate['id'] }} }"
                                                @mouseenter="setHover(@js($candidate))"
                                                @mouseleave="setHover(null)"
                                            />
                                        @endif
                                    @endforeach
                                </svg>

                                <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center p-4 text-center">
                                    <template x-if="hoveredId === null">
                                        <div class="flex flex-col items-center justify-center">
                                            <span class="text-3xl font-black tracking-tight text-gray-950 dark:text-white">
                                                {{ number_format($this->turnout['total_votes']) }}
                                            </span>
                                            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                                Votos Totales
                                            </span>
                                            <span class="mt-1 inline-flex items-center rounded-full bg-primary-500/10 px-2 py-0.5 text-[11px] font-bold text-primary-600 dark:bg-primary-500/20 dark:text-primary-400">
                                                {{ $this->turnout['percentage'] }}% Padrón
                                            </span>
                                        </div>
                                    </template>

                                    <template x-if="hoveredId !== null">
                                        <div class="flex flex-col items-center justify-center animate-in fade-in zoom-in-95 duration-150">
                                            <span
                                                class="max-w-[130px] truncate text-xs font-bold"
                                                :style="'color: ' + hoveredColor"
                                                x-text="hoveredName"
                                            ></span>
                                            <span class="text-2xl font-black tracking-tight text-gray-950 dark:text-white">
                                                <span x-text="hoveredVotes"></span>
                                                <span class="text-xs font-normal text-gray-500">votos</span>
                                            </span>
                                            <span
                                                class="mt-0.5 inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-black text-white"
                                                :style="'background-color: ' + hoveredColor"
                                                x-text="hoveredPct + '%'"
                                            ></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        @else
                            <x-filament::empty-state
                                :contained="false"
                                icon="heroicon-o-chart-pie"
                                icon-color="gray"
                            >
                                <x-slot name="heading">
                                    Sin votos para graficar
                                </x-slot>
                                <x-slot name="description">
                                    La gráfica de torta se generará automáticamente en cuanto se emita el primer voto.
                                </x-slot>
                            </x-filament::empty-state>
                        @endif
                    </div>

                    @if(!empty($this->results))
                        <x-slot name="footer">
                            <h4 class="mb-2 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Leyenda de Candidatos
                            </h4>
                            <div class="max-h-56 space-y-1.5 overflow-y-auto pr-1">
                                @foreach($this->results as $candidate)
                                    <div
                                        wire:key="legend-candidate-{{ $candidate['id'] }}"
                                        class="flex cursor-pointer items-center justify-between rounded-lg p-1.5 text-xs transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/60"
                                        :class="{ 'bg-gray-100 font-semibold ring-1 ring-inset ring-gray-300 dark:bg-gray-800 dark:ring-gray-700': hoveredId === {{ $candidate['id'] }} }"
                                        @mouseenter="setHover(@js($candidate))"
                                        @mouseleave="setHover(null)"
                                    >
                                        <div class="flex min-w-0 items-center gap-2 pr-2">
                                            <span
                                                class="h-3 w-3 shrink-0 rounded-full"
                                                style="background-color: {{ $candidate['color'] }}"
                                            ></span>
                                            <span class="truncate font-medium text-gray-950 dark:text-white">
                                                {{ $candidate['name'] }}
                                            </span>
                                        </div>
                                        <div class="flex shrink-0 items-center gap-2">
                                            <span class="font-mono text-gray-500 dark:text-gray-400">
                                                {{ $candidate['votes'] }} {{ $candidate['votes'] === 1 ? 'voto' : 'votos' }}
                                            </span>
                                            <span
                                                class="inline-flex min-w-[48px] justify-center rounded-md px-1.5 py-0.5 text-[11px] font-bold"
                                                style="background-color: {{ $candidate['color'] }}20; color: {{ $candidate['color'] }}"
                                            >
                                                {{ $candidate['percentage'] }}%
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </x-slot>
                    @endif
                </x-filament::section>

                {{-- Right Column: Candidate Leaderboard Cards --}}
                <x-filament::section class="lg:col-span-7">
                    <x-slot name="heading">
                        Escrutinio por Candidato
                    </x-slot>
                    <x-slot name="description">
                        Posición y rendimiento de cada candidatura en la votación
                    </x-slot>
                    <x-slot name="afterHeader">
                        <x-filament::badge color="gray">
                            {{ count($this->results ?? []) }} {{ count($this->results ?? []) === 1 ? 'Candidato' : 'Candidatos' }}
                        </x-filament::badge>
                    </x-slot>

                    <div class="space-y-3.5">
                        @forelse($this->results as $candidate)
                            <div
                                wire:key="leaderboard-candidate-{{ $candidate['id'] }}"
                                class="relative cursor-pointer overflow-hidden rounded-xl border p-4 transition-all duration-200 hover:shadow-md {{ $candidate['is_leader'] ? 'border-amber-300/80 bg-amber-50/30 shadow-sm dark:border-amber-500/30 dark:bg-amber-950/10' : 'border-gray-200 bg-white hover:border-gray-300 dark:border-gray-700 dark:bg-gray-900/60 dark:hover:border-gray-600' }}"
                                :class="{ 'ring-2 ring-primary-500': hoveredId === {{ $candidate['id'] }} }"
                                @mouseenter="setHover(@js($candidate))"
                                @mouseleave="setHover(null)"
                            >
                                <div class="flex items-center gap-4">
                                    {{-- Rank Badge --}}
                                    <div class="flex flex-col items-center justify-center">
                                        @if($candidate['rank'] === 1 && $candidate['votes'] > 0)
                                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-amber-400 to-amber-600 text-sm font-black text-white">
                                                1°
                                            </div>
                                        @elseif($candidate['rank'] === 2 && $candidate['votes'] > 0)
                                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-slate-300 to-slate-500 text-sm font-black text-white">
                                                2°
                                            </div>
                                        @elseif($candidate['rank'] === 3 && $candidate['votes'] > 0)
                                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-amber-600 to-amber-800 text-sm font-black text-white">
                                                3°
                                            </div>
                                        @else
                                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                                                {{ $candidate['rank'] }}°
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Photo / Avatar --}}
                                    <div class="relative shrink-0">
                                        @if($candidate['photo_path'])
                                            <img
                                                src="{{ Storage::disk('public')->url($candidate['photo_path']) }}"
                                                alt="{{ $candidate['name'] }}"
                                                class="h-13 w-13 rounded-xl object-cover ring-2"
                                                style="--tw-ring-color: {{ $candidate['color'] }}"
                                            />
                                        @else
                                            <div
                                                class="flex h-13 w-13 items-center justify-center rounded-xl font-bold text-white shadow-sm"
                                                style="background: linear-gradient(135deg, {{ $candidate['color'] }}, {{ $candidate['color'] }}dd)"
                                            >
                                                <span class="text-base font-black">
                                                    {{ mb_substr($candidate['name'], 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Info (Name, Position & Stats) --}}
                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-center justify-between gap-1">
                                            <div class="flex items-center gap-2">
                                                <h4 class="font-bold text-gray-950 dark:text-white">
                                                    {{ $candidate['name'] }}
                                                </h4>
                                                @if($candidate['is_leader'])
                                                    <x-filament::badge color="warning">
                                                        {{ $this->electionStatus === 'closed' ? 'Ganador' : 'Líder' }}
                                                    </x-filament::badge>
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <span class="text-base font-black text-gray-950 dark:text-white">
                                                    {{ number_format($candidate['votes']) }}
                                                </span>
                                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                                    {{ $candidate['votes'] === 1 ? 'voto' : 'votos' }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                            <span>{{ $candidate['position'] }}</span>
                                            <span class="text-sm font-black" style="color: {{ $candidate['color'] }}">
                                                {{ $candidate['percentage'] }}%
                                            </span>
                                        </div>

                                        {{-- Progress Bar --}}
                                        <div class="mt-2 h-2.5 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                                            <div
                                                class="h-full rounded-full transition-all duration-700 ease-out"
                                                style="width: {{ $candidate['percentage'] }}%; background-color: {{ $candidate['color'] }}"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-filament::empty-state
                                :contained="false"
                                icon="heroicon-o-user-group"
                                icon-color="gray"
                            >
                                <x-slot name="heading">
                                    Sin candidatos registrados
                                </x-slot>
                                <x-slot name="description">
                                    No se encontraron candidatos registrados para esta elección.
                                </x-slot>
                            </x-filament::empty-state>
                        @endforelse
                    </div>
                </x-filament::section>
            </div>

            {{-- Detailed Results Table --}}
            @if(!empty($this->results))
                <x-filament::section>
                    <x-slot name="heading">
                        Tabla Detallada de Escrutinio
                    </x-slot>
                    <x-slot name="description">
                        Resumen consolidado de votos y porcentajes por candidatura
                    </x-slot>

                    <div class="-mx-2 overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50/75 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:bg-gray-800/50 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3.5">Lugar</th>
                                    <th class="px-6 py-3.5">Candidato</th>
                                    <th class="px-6 py-3.5">Cargo</th>
                                    <th class="px-6 py-3.5 text-right">Votos Obtenidos</th>
                                    <th class="px-6 py-3.5 text-right">% Votos Válidos</th>
                                    <th class="px-6 py-3.5 text-center">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @foreach($this->results as $candidate)
                                    <tr wire:key="table-candidate-{{ $candidate['id'] }}" class="transition-colors hover:bg-gray-50/50 dark:hover:bg-gray-800/40">
                                        <td class="whitespace-nowrap px-6 py-4 font-bold text-gray-950 dark:text-white">
                                            @if($candidate['rank'] === 1 && $candidate['votes'] > 0)
                                                <span class="inline-flex items-center gap-1 text-amber-600 dark:text-amber-400">
                                                    🥇 1° Lugar
                                                </span>
                                            @elseif($candidate['rank'] === 2 && $candidate['votes'] > 0)
                                                <span class="inline-flex items-center gap-1 text-slate-500 dark:text-slate-400">
                                                    🥈 2° Lugar
                                                </span>
                                            @elseif($candidate['rank'] === 3 && $candidate['votes'] > 0)
                                                <span class="inline-flex items-center gap-1 text-amber-700 dark:text-amber-500">
                                                    🥉 3° Lugar
                                                </span>
                                            @else
                                                {{ $candidate['rank'] }}° Lugar
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="h-3 w-3 rounded-full"
                                                    style="background-color: {{ $candidate['color'] }}"
                                                ></span>
                                                <span class="font-semibold text-gray-950 dark:text-white">
                                                    {{ $candidate['name'] }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-gray-500 dark:text-gray-400">
                                            {{ $candidate['position'] }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-right font-mono font-bold text-gray-950 dark:text-white">
                                            {{ number_format($candidate['votes']) }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-right font-bold" style="color: {{ $candidate['color'] }}">
                                            {{ $candidate['percentage'] }}%
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-center">
                                            @if($candidate['is_leader'])
                                                <x-filament::badge color="success">
                                                    {{ $this->electionStatus === 'closed' ? 'Electo / Ganador' : 'Liderando' }}
                                                </x-filament::badge>
                                            @else
                                                <x-filament::badge color="gray">
                                                    Participante
                                                </x-filament::badge>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="border-t border-gray-200 bg-gray-50/50 font-semibold text-gray-950 dark:border-gray-700 dark:bg-gray-800/30 dark:text-white">
                                <tr>
                                    <td colspan="3" class="px-6 py-3.5 text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Total General de Votos Emitidos
                                    </td>
                                    <td class="px-6 py-3.5 text-right font-mono text-base font-black">
                                        {{ number_format($this->turnout['total_votes']) }}
                                    </td>
                                    <td class="px-6 py-3.5 text-right text-base font-black">
                                        100.0%
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </x-filament::section>
            @endif
        @else
            {{-- Empty State when no election is available --}}
            <x-filament::empty-state
                icon="heroicon-o-chart-pie"
                icon-color="gray"
            >
                <x-slot name="heading">
                    No hay elecciones disponibles
                </x-slot>
                <x-slot name="description">
                    Actualmente no se encuentra ninguna elección activa ni cerrada en el sistema para visualizar resultados.
                </x-slot>
                <x-slot name="footer">
                    <x-filament::button
                        tag="a"
                        href="{{ \App\Filament\Resources\ElectionResource::getUrl() }}"
                        icon="heroicon-m-plus"
                        color="primary"
                    >
                        Gestionar Elecciones
                    </x-filament::button>
                </x-slot>
            </x-filament::empty-state>
        @endif
    </div>
</x-filament-panels::page>
