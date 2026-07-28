<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black tracking-tight text-amber-300 drop-shadow-[0_0_15px_rgba(251,191,36,0.5)]">
                    Gestión de Clientes VIP
                </h2>
                <p class="text-xs text-slate-400 mt-1">Directorio de participantes registrados y asignación a salas de sorteo.</p>
            </div>
            <a href="{{ route('clientes.export') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-emerald-500 to-teal-400 px-5 py-2.5 text-xs font-black text-slate-950 uppercase tracking-wider shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:brightness-110 active:scale-95 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Descargar Excel
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid gap-8 lg:grid-cols-[0.7fr_1.3fr]">
                
                <!-- Left: Form to Register New Client -->
                <div class="rounded-3xl border border-amber-500/25 bg-slate-950/90 p-7 shadow-[0_0_50px_rgba(245,158,11,0.12)] backdrop-blur-xl h-fit">
                    <div class="mb-6 rounded-2xl bg-slate-900/90 p-5 border border-amber-500/20">
                        <p class="text-xs uppercase tracking-[0.25em] font-extrabold text-amber-400">Inscripción VIP</p>
                        <h3 class="mt-1 text-2xl font-black text-white">Agregar Cliente</h3>
                        <p class="mt-1 text-xs text-slate-400 leading-relaxed">Registra al participante y conéctalo con un juego activo.</p>
                    </div>

                    @if(session('error'))
                        <div class="mb-4 rounded-2xl bg-red-500/10 border border-red-500/30 p-4 text-xs font-semibold text-red-300">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 p-4 text-xs font-semibold text-emerald-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('CrearCliente') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="space-y-1.5">
                            <label for="nombre" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Nombre Completo</label>
                            <input type="text" id="nombre" name="nombre" required placeholder="Ej: Carlos Mendoza" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 transition" />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <div class="space-y-1.5">
                            <label for="numero_identificacion" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Número de Identificación</label>
                            <input type="text" id="numero_identificacion" name="numero_identificacion" placeholder="CC / DNI / Pasaporte" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 transition" />
                            <x-input-error :messages="$errors->get('numero_identificacion')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <div class="space-y-1.5">
                            <label for="telefono" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Número de Teléfono</label>
                            <input type="text" id="telefono" name="numero_telefono" required placeholder="+57 300 000 0000" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 transition" />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <div class="space-y-1.5">
                            <label for="id_juego" class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Asignar a Juego</label>
                            <select name="id_juego" id="id_juego" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 transition">
                                @foreach($juegos as $juego)
                                    <option value="{{ $juego->id }}">{{ $juego->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_juego')" class="mt-1 text-xs text-rose-400" />
                        </div>

                        <button type="submit" class="w-full rounded-full bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 px-5 py-3.5 text-sm font-black uppercase tracking-wider text-slate-950 shadow-[0_0_25px_rgba(245,158,11,0.4)] transition duration-200 hover:brightness-110 active:scale-[0.98]">
                            + Registrar Cliente
                        </button>
                    </form>
                </div>

                <!-- Right: Clients List Cards/Table -->
                <div class="space-y-4">
                    <div class="rounded-3xl border border-amber-500/20 bg-slate-950/90 p-6 shadow-[0_0_40px_rgba(0,0,0,0.6)] backdrop-blur-xl">
                        <div class="flex items-center justify-between pb-4 border-b border-amber-500/15 mb-6">
                            <h3 class="text-xl font-black text-white">Directorio de Clientes</h3>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-500/10 px-3.5 py-1 text-xs font-bold text-amber-300 ring-1 ring-amber-400/30">
                                {{ count($clientes) }} Registrados
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($clientes as $cliente)
                                <div class="rounded-2xl border border-amber-500/20 bg-slate-900/90 p-5 shadow-lg relative group hover:border-amber-400/50 hover:shadow-[0_0_25px_rgba(245,158,11,0.15)] transition duration-200 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-start justify-between gap-2 mb-3">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-amber-500/10 border border-amber-500/30 flex items-center justify-center font-black text-amber-400 text-sm">
                                                    {{ strtoupper(substr($cliente->nombre, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-base text-white group-hover:text-amber-300 transition">{{ $cliente->nombre }}</h4>
                                                    <p class="text-xs text-amber-400/80 font-mono">ID: {{ $cliente->numero_identificacion ?: 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-2 py-3 border-y border-slate-800 text-xs">
                                            <div class="flex items-center justify-between text-slate-300">
                                                <span class="text-slate-500 font-medium">Teléfono:</span>
                                                <span class="font-semibold text-slate-200">{{ $cliente->numero_telefono }}</span>
                                            </div>
                                            <div class="flex items-center justify-between text-slate-300">
                                                <span class="text-slate-500 font-medium">Juego Asignado:</span>
                                                <span class="inline-flex items-center rounded-md bg-amber-500/10 px-2 py-0.5 font-bold text-amber-300 border border-amber-500/20">
                                                    {{ $cliente->juego?->nombre ?? 'Sin Juego' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 flex items-center gap-2 pt-1">
                                        <button type="button" onclick="abrirModalCliente(
                                            {{ $cliente->id }},
                                            '{{ addslashes($cliente->nombre) }}',
                                            '{{ addslashes($cliente->numero_identificacion) }}',
                                            '{{ addslashes($cliente->numero_telefono) }}',
                                            {{ $cliente->id_juego }}
                                        )" class="flex-1 inline-flex items-center justify-center rounded-xl bg-amber-400/10 border border-amber-400/30 px-3 py-2 text-xs font-bold text-amber-300 hover:bg-amber-400 hover:text-slate-950 transition">
                                            Editar
                                        </button>
                                        <button type="button" onclick="modalEliminar({{ $cliente->id }})" class="flex-1 inline-flex items-center justify-center rounded-xl bg-red-500/10 border border-red-500/30 px-3 py-2 text-xs font-bold text-red-400 hover:bg-red-600 hover:text-white transition">
                                            Bloquear
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-12 text-center text-slate-400">
                                    <p class="text-sm font-bold text-slate-300">No hay clientes registrados en el sistema.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Cliente -->
    <div id="modal-cliente" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md px-4 py-6">
        <div class="w-full max-w-md rounded-3xl border border-amber-500/40 bg-slate-950 p-7 shadow-[0_0_60px_rgba(245,158,11,0.3)] ring-1 ring-amber-400/30">
            <h3 class="text-xl font-black text-white mb-1">Editar Cliente VIP</h3>
            <p class="text-xs text-amber-400/80 mb-5">Modifica los datos del cliente seleccionado.</p>
            <form id="form-cliente" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="space-y-1">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Nombre Completo</label>
                    <input type="text" name="nombre" id="modal-cliente-nombre" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30" />
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Número de Identificación</label>
                    <input type="text" name="numero_identificacion" id="modal-cliente-identificacion" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30" />
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Número de Teléfono</label>
                    <input type="text" name="numero_telefono" id="modal-cliente-telefono" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30" />
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Juego Asignado</label>
                    <select name="id_juego" id="modal-cliente-juego" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30">
                        @foreach($juegos as $juego)
                            <option value="{{ $juego->id }}">{{ $juego->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-wrap gap-3 pt-3">
                    <button type="submit" class="inline-flex flex-1 justify-center rounded-full bg-gradient-to-r from-amber-400 to-yellow-300 px-5 py-3 text-xs font-black uppercase text-slate-950 hover:brightness-110 shadow-[0_0_20px_rgba(245,158,11,0.4)] transition">Actualizar</button>
                    <button type="button" onclick="cerrarModalCliente()" class="inline-flex flex-1 justify-center rounded-full bg-slate-800 px-5 py-3 text-xs font-bold text-slate-300 border border-slate-700 hover:bg-slate-700 transition">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Bloquear Cliente -->
    <div id="modal-bloquear" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md px-4 py-6">
        <div class="w-full max-w-md rounded-3xl border border-red-500/40 bg-slate-950 p-7 shadow-[0_0_60px_rgba(220,38,38,0.3)] ring-1 ring-red-500/30">
            <div class="w-12 h-12 rounded-2xl bg-red-500/10 border border-red-500/30 flex items-center justify-center text-red-400 mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
            </div>
            <h3 class="text-xl font-black text-white">¿Bloquear cliente?</h3>
            <p class="mt-2 text-xs text-slate-300 leading-relaxed">El cliente dejará de aparecer en las listas activas del sistema.</p>
            <form id="form-bloquear" method="POST" class="mt-6 flex justify-end gap-3">
                @csrf
                @method('PATCH')
                <button type="button" onclick="cerrarModalBloquear()" class="rounded-full bg-slate-800 px-5 py-2.5 text-xs font-bold text-slate-300 border border-slate-700 hover:bg-slate-700 transition">Cancelar</button>
                <button type="submit" class="rounded-full bg-gradient-to-r from-red-600 to-rose-700 px-6 py-2.5 text-xs font-black text-white uppercase tracking-wider hover:brightness-110 shadow-[0_0_20px_rgba(220,38,38,0.4)] transition">Confirmar Bloqueo</button>
            </form>
        </div>
    </div>

    <script>
        function abrirModalCliente(id, nombre, identificacion, telefono, idJuego) {
            document.getElementById('modal-cliente').classList.remove('hidden');
            document.getElementById('modal-cliente-nombre').value = nombre;
            document.getElementById('modal-cliente-identificacion').value = identificacion;
            document.getElementById('modal-cliente-telefono').value = telefono;
            document.getElementById('modal-cliente-juego').value = idJuego;
            document.getElementById('form-cliente').action = `/clientes/${id}`;
        }
        function cerrarModalCliente() {
            document.getElementById('modal-cliente').classList.add('hidden');
        }
        function modalEliminar(id) {
            document.getElementById('modal-bloquear').classList.remove('hidden');
            document.getElementById('form-bloquear').action = `/clientes/${id}/bloquear`;
        }
        function cerrarModalBloquear() {
            document.getElementById('modal-bloquear').classList.add('hidden');
        }
    </script>
</x-app-layout>