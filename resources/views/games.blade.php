<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-black tracking-tight text-amber-300 drop-shadow-[0_0_15px_rgba(251,191,36,0.5)]">
                Sala de Juegos
            </h2>
            <div class="inline-flex items-center gap-2 rounded-full bg-amber-500/10 px-4 py-2 text-xs font-bold text-amber-300 ring-1 ring-amber-400/30 shadow-[0_0_15px_rgba(245,158,11,0.2)]">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                En vivo ahora
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Hero Header Card -->
            <div class="rounded-3xl border border-amber-500/25 bg-slate-950/80 p-6 sm:p-8 shadow-[0_0_60px_rgba(245,158,11,0.15)] ring-1 ring-amber-400/20 backdrop-blur-xl relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between relative z-10">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] font-extrabold text-amber-400/90">Casino Royale & Sorteos</p>
                        <h1 class="mt-1 text-3xl font-black text-white">Partidas y Ruletas Disponibles</h1>
                        <p class="mt-2 max-w-2xl text-sm text-slate-300 leading-relaxed">Visualiza el estado de cada juego, controla participantes en tiempo real y ejecuta la ruleta aleatoria con total transparencia.</p>
                    </div>
                </div>
            </div>

            <!-- Content Grid: Games List & Add Game Form -->
            <div class="grid gap-8 lg:grid-cols-[1.4fr_0.6fr]">
                
                <!-- Left: Games List -->
                <div class="space-y-4">
                    @forelse($games as $game)
                        <details class="group overflow-hidden rounded-3xl border border-amber-500/20 bg-slate-900/90 shadow-[0_0_35px_rgba(0,0,0,0.6)] transition duration-300 hover:border-amber-400/40 hover:shadow-[0_0_40px_rgba(245,158,11,0.2)]">
                            <summary class="cursor-pointer list-none px-6 py-5 bg-gradient-to-r from-slate-900 via-slate-900 to-slate-950/90 hover:bg-slate-800/80 transition duration-200">
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-lg font-bold text-white group-hover:text-amber-300 transition">{{ $game->nombre }}</p>
                                            <p class="mt-0.5 text-xs text-slate-400 line-clamp-1">{{ $game->descripcion }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-500/15 px-3.5 py-1 text-xs font-extrabold text-amber-300 ring-1 ring-amber-400/30 shadow-[0_0_10px_rgba(245,158,11,0.2)]">
                                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                            {{ $game->clientes->count() }}/{{ $game->cantidad_jugadores }} inscritos
                                        </span>
                                        <svg class="w-5 h-5 text-amber-400 transform group-open:rotate-180 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            </summary>

                            <div class="border-t border-amber-500/15 bg-slate-950/95 px-6 py-6 space-y-6">
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div class="rounded-2xl bg-slate-900/90 p-4 border border-amber-500/20">
                                        <p class="text-xs uppercase font-extrabold tracking-[0.2em] text-amber-400/80">Estado Actual</p>
                                        <p class="mt-1 text-base font-bold text-white capitalize">{{ ucfirst(str_replace('_', ' ', $game->estado)) }}</p>
                                    </div>
                                    <div class="rounded-2xl bg-slate-900/90 p-4 border border-amber-500/20">
                                        <p class="text-xs uppercase font-extrabold tracking-[0.2em] text-amber-400/80">Capacidad Jugadores</p>
                                        <p class="mt-1 text-base font-bold text-white">{{ $game->clientes->count() }} de {{ $game->cantidad_jugadores }} registrados</p>
                                    </div>
                                </div>

                                <div class="rounded-2xl border border-amber-500/20 bg-slate-900/70 p-5">
                                    <div class="flex items-center justify-between mb-3">
                                        <p class="text-xs uppercase font-extrabold tracking-[0.2em] text-amber-300">Jugadores Registrados</p>
                                        <span class="text-xs text-slate-400 font-semibold">{{ $game->clientes->count() }} Participantes</span>
                                    </div>
                                    @if($game->clientes->isEmpty())
                                        <div class="py-4 text-center text-xs text-slate-500 italic">
                                            No hay jugadores registrados aún para este juego.
                                        </div>
                                    @else
                                        <ul class="max-h-48 space-y-2 overflow-y-auto pr-2 text-xs font-medium text-slate-200">
                                            @foreach($game->clientes as $cliente)
                                                <li class="flex items-center justify-between rounded-xl bg-slate-950/80 px-4 py-2.5 border border-slate-800 hover:border-amber-500/30 transition">
                                                    <span class="font-semibold text-white">{{ $cliente->nombre }}</span>
                                                    <span class="text-amber-400/80 font-mono text-[11px]">ID: {{ $cliente->numero_identificacion }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                <!-- Actions Bar -->
                                <div class="flex flex-wrap items-center gap-3 pt-2">
                                    <button type="button" onclick="abrirModal(
                                        {{ $game->id }},
                                        '{{ addslashes($game->nombre) }}',
                                        {{ $game->cantidad_jugadores }},
                                        '{{ addslashes($game->descripcion) }}',
                                        {{ $game->tipo_juego_id }},
                                        {{ $game->id_casino }}
                                    )" class="inline-flex items-center justify-center rounded-full bg-amber-400/10 border border-amber-400/40 px-5 py-2.5 text-xs font-extrabold text-amber-300 hover:bg-amber-400 hover:text-slate-950 hover:shadow-[0_0_20px_rgba(245,158,11,0.4)] transition duration-200">
                                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Editar Juego
                                    </button>

                                    <button type="button" onclick="modalEliminar({{ $game->id }})" class="inline-flex items-center justify-center rounded-full bg-red-500/10 border border-red-500/40 px-5 py-2.5 text-xs font-extrabold text-red-400 hover:bg-red-600 hover:text-white hover:shadow-[0_0_20px_rgba(220,38,38,0.4)] transition duration-200">
                                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                        Bloquear Juego
                                    </button>

                                    @php
                                        $lleno = $game->clientes->count() >= $game->cantidad_jugadores;
                                    @endphp

                                    <button type="button"
                                        {{ $lleno ? '' : 'disabled' }}
                                        onclick="{{ $lleno ? 'ejecutarJuego(' . $game->id . ')' : '' }}"
                                        class="inline-flex items-center justify-center rounded-full px-6 py-2.5 text-xs font-black uppercase tracking-wider transition duration-200 ml-auto {{ $lleno ? 'bg-gradient-to-r from-emerald-400 to-teal-400 text-slate-950 hover:brightness-110 shadow-[0_0_25px_rgba(16,185,129,0.4)] cursor-pointer' : 'bg-slate-800 text-slate-500 border border-slate-700 cursor-not-allowed opacity-60' }}">
                                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Ejecutar Sorteo
                                    </button>
                                </div>
                            </div>
                        </details>
                    @empty
                        <div class="rounded-3xl border border-amber-500/20 bg-slate-900/90 p-10 text-center text-slate-400 shadow-[0_0_30px_rgba(0,0,0,0.5)]">
                            <div class="w-16 h-16 rounded-full bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            </div>
                            <p class="text-base font-bold text-white">No hay juegos registrados</p>
                            <p class="mt-1 text-xs text-slate-400">Utiliza el formulario lateral para agregar tu primer juego al casino.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Right: Add Game Form Sidebar -->
                <aside class="rounded-3xl border border-amber-500/25 bg-slate-950/90 p-7 shadow-[0_0_50px_rgba(245,158,11,0.12)] backdrop-blur-xl h-fit">
                    <div class="mb-6 rounded-2xl bg-slate-900/90 p-5 border border-amber-500/20">
                        <p class="text-xs uppercase tracking-[0.25em] font-extrabold text-amber-400">Crear Partida</p>
                        <h2 class="mt-1 text-2xl font-black text-white">Añadir Juego</h2>
                        <p class="mt-1 text-xs text-slate-400 leading-relaxed">Configura el nombre, cupo de participantes y casino de origen.</p>
                    </div>

                    <form action="{{ route('games') }}" method="POST" class="space-y-5">
                        @csrf

                        @if(session('error'))
                            <div class="rounded-2xl bg-red-500/10 border border-red-500/30 p-4 text-xs font-semibold text-red-300">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="rounded-2xl bg-emerald-500/10 border border-emerald-500/30 p-4 text-xs font-semibold text-emerald-300">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="space-y-1.5">
                            <label for="nombre" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Nombre del juego</label>
                            <input type="text" id="nombre" name="nombre" required placeholder="Ej: Ruleta VIP Millonaria" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 transition" />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <div class="space-y-1.5">
                            <label for="descripcion" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Descripción</label>
                            <textarea id="descripcion" name="descripcion" required rows="3" placeholder="Detalles de la bolsa de premios y reglas del sorteo..." class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 transition"></textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="space-y-1.5">
                                <label for="tipo_juego" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Tipo de juego</label>
                                <select id="tipo_juego" name="tipo_juego" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 transition">
                                    @foreach($tipo_juego as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre_juego }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('tipo_juego_id')" class="mt-1 text-xs text-rose-400" />
                            </div>

                            <div class="space-y-1.5">
                                <label for="cantidad_jugadores" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Jugadores</label>
                                <input type="number" id="cantidad_jugadores" name="cantidad_jugadores" required placeholder="Ej: 10" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 transition" />
                                <x-input-error :messages="$errors->get('cantidad_jugadores')" class="mt-1 text-xs text-rose-400" />
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label for="casino" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Casino de procedencia</label>
                            <select id="casino" name="casino" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 transition">
                                @foreach($casinos as $casino)
                                    <option value="{{ $casino->id }}">{{ $casino->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_casino')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <button type="submit" class="w-full rounded-full bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 px-5 py-3.5 text-sm font-black uppercase tracking-wider text-slate-950 shadow-[0_0_25px_rgba(245,158,11,0.4)] transition duration-200 hover:brightness-110 active:scale-[0.98]">
                            + Registrar Juego
                        </button>
                    </form>
                </aside>
            </div>
        </div>
    </div>

    <!-- Modal Ejecutar -->
    <div id="modal-ejecutar" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md px-4 py-6">
        <div class="w-full max-w-md rounded-3xl border border-emerald-500/40 bg-slate-950 p-7 shadow-[0_0_60px_rgba(16,185,129,0.3)] ring-1 ring-emerald-400/30">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-xl font-black text-white">¿Ejecutar ruleta de juego?</h3>
            <p class="mt-2 text-xs text-slate-300 leading-relaxed">Esta acción seleccionará los ganadores/participantes de forma aleatoria y no se puede deshacer.</p>
            <form id="form-ejecutar" method="POST" action="{{ isset($game) ? route('games.ejecutar', $game->id) : '#' }}" class="mt-6 space-y-4">
                @csrf
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="cerrarModalEjecutar()" class="rounded-full bg-slate-800 px-5 py-2.5 text-xs font-bold text-slate-300 border border-slate-700 hover:bg-slate-700 transition">Cancelar</button>
                    <button type="submit" class="rounded-full bg-gradient-to-r from-emerald-400 to-teal-400 px-6 py-2.5 text-xs font-black text-slate-950 uppercase tracking-wider hover:brightness-110 shadow-[0_0_20px_rgba(16,185,129,0.4)] transition">Confirmar y Ejecutar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar -->
    <div id="modal-editar" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md px-4 py-6">
        <div class="w-full max-w-md rounded-3xl border border-amber-500/40 bg-slate-950 p-7 shadow-[0_0_60px_rgba(245,158,11,0.3)] ring-1 ring-amber-400/30">
            <h3 class="text-xl font-black text-white mb-1">Editar Juego</h3>
            <p class="text-xs text-amber-400/80 mb-5">Actualiza los datos de la partida seleccionada.</p>
            <form id="form-editar" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="space-y-1">
                    <label for="modal-nombre" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Nombre</label>
                    <input type="text" name="nombre" id="modal-nombre" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30" />
                </div>
                <div class="space-y-1">
                    <label for="modal-descripcion" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Descripción</label>
                    <textarea name="descripcion" id="modal-descripcion" rows="3" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30"></textarea>
                </div>
                <div class="space-y-1">
                    <label for="modal-cantidad" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Cantidad de jugadores</label>
                    <input type="number" name="cantidad_jugadores" id="modal-cantidad" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30" />
                </div>
                <div class="space-y-1">
                    <label for="modal-tipo-juego" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Tipo de juego</label>
                    <select name="tipo_juego" id="modal-tipo-juego" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30">
                        @foreach($tipo_juego as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre_juego }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1">
                    <label for="modal-casino" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Casino</label>
                    <select name="casino" id="modal-casino" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30">
                        @foreach($casinos as $casino)
                            <option value="{{ $casino->id }}">{{ $casino->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-wrap gap-3 pt-3">
                    <button type="submit" class="inline-flex flex-1 justify-center rounded-full bg-gradient-to-r from-amber-400 to-yellow-300 px-5 py-3 text-xs font-black uppercase text-slate-950 hover:brightness-110 shadow-[0_0_20px_rgba(245,158,11,0.4)] transition">Guardar Cambios</button>
                    <button type="button" onclick="cerrarModal()" class="inline-flex flex-1 justify-center rounded-full bg-slate-800 px-5 py-3 text-xs font-bold text-slate-300 border border-slate-700 hover:bg-slate-700 transition">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Bloquear -->
    <div id="modal-bloquear" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md px-4 py-6">
        <div class="w-full max-w-md rounded-3xl border border-red-500/40 bg-slate-950 p-7 shadow-[0_0_60px_rgba(220,38,38,0.3)] ring-1 ring-red-500/30">
            <div class="w-12 h-12 rounded-2xl bg-red-500/10 border border-red-500/30 flex items-center justify-center text-red-400 mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <h3 class="text-xl font-black text-white">¿Bloquear este juego?</h3>
            <p class="mt-2 text-xs text-slate-300 leading-relaxed">El juego y sus clientes asociados dejarán de aparecer en el sistema.</p>
            <form id="form-bloquear" method="POST" class="mt-6 flex justify-end gap-3">
                @csrf
                @method('PATCH')
                <button type="button" onclick="cerrarModalBloquear()" class="rounded-full bg-slate-800 px-5 py-2.5 text-xs font-bold text-slate-300 border border-slate-700 hover:bg-slate-700 transition">Cancelar</button>
                <button type="submit" class="rounded-full bg-gradient-to-r from-red-600 to-rose-700 px-6 py-2.5 text-xs font-black text-white uppercase tracking-wider hover:brightness-110 shadow-[0_0_20px_rgba(220,38,38,0.4)] transition">Sí, Bloquear</button>
            </form>
        </div>
    </div>

    <script>
        function abrirModal(id, nombre, cantidad, descripcion, tipoJuegoId, idCasino) {
            document.getElementById('modal-editar').classList.remove('hidden');
            document.getElementById('modal-nombre').value = nombre;
            document.getElementById('modal-cantidad').value = cantidad;
            document.getElementById('modal-descripcion').value = descripcion;
            document.getElementById('form-editar').action = `/games/${id}`;
            document.getElementById('modal-tipo-juego').value = tipoJuegoId;
            document.getElementById('modal-casino').value = idCasino;
        }
        function cerrarModal() {
            document.getElementById('modal-editar').classList.add('hidden');
        }
        function modalEliminar(id) {
            document.getElementById('modal-bloquear').classList.remove('hidden');
            document.getElementById('form-bloquear').action = `/games/${id}/bloquear`;
        }
        function cerrarModalBloquear() {
            document.getElementById('modal-bloquear').classList.add('hidden');
        }
        function ejecutarJuego(id) {
            document.getElementById('modal-ejecutar').classList.remove('hidden');
            document.getElementById('form-ejecutar').action = `/games/${id}/ejecutar`;
        }
        function cerrarModalEjecutar() {
            document.getElementById('modal-ejecutar').classList.add('hidden');
        }
    </script>
</x-app-layout>
