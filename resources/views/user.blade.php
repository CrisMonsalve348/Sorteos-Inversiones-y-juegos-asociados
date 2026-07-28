<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black tracking-tight text-amber-300 drop-shadow-[0_0_15px_rgba(251,191,36,0.5)]">
                    Directorio de Usuarios
                </h2>
                <p class="text-xs text-slate-400 mt-1">Control de operadores y administradores del sistema de casino.</p>
            </div>
            <div class="inline-flex items-center gap-2 rounded-full bg-amber-500/10 px-4 py-2 text-xs font-bold text-amber-300 ring-1 ring-amber-400/30">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                {{ count($users) }} Usuarios Registrados
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="rounded-2xl bg-emerald-500/10 border border-emerald-500/30 p-4 text-xs font-bold text-emerald-300 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($users as $user)
                    <div class="rounded-3xl border border-amber-500/20 bg-slate-900/90 p-6 shadow-[0_0_35px_rgba(0,0,0,0.5)] backdrop-blur-xl relative group hover:border-amber-400/40 hover:shadow-[0_0_40px_rgba(245,158,11,0.2)] transition duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-3 mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 p-0.5 shadow-[0_0_15px_rgba(245,158,11,0.3)]">
                                        <div class="w-full h-full rounded-[14px] bg-slate-950 flex items-center justify-center font-black text-amber-400 text-sm">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-white group-hover:text-amber-300 transition">{{ $user->name }}</h3>
                                        <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2 py-4 border-y border-slate-800 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-500 font-medium">Rol en Sistema:</span>
                                    @if($user->role === 'admin')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-500/10 border border-amber-500/30 px-3 py-1 text-[11px] font-extrabold text-amber-300 uppercase tracking-wider shadow-[0_0_10px_rgba(245,158,11,0.2)]">
                                            👑 Administrador
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-red-500/10 border border-red-500/30 px-3 py-1 text-[11px] font-extrabold text-red-400 uppercase tracking-wider">
                                            🎲 Trabajador
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between text-slate-300">
                                    <span class="text-slate-500 font-medium">Teléfono:</span>
                                    <span class="font-semibold text-slate-200">{{ $user->phone_number ?: 'Sin registrar' }}</span>
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->role === 'admin')
                            <div class="mt-5 flex items-center gap-3 pt-1">
                                <button type="button" onclick="abrirModal(
                                    {{ $user->id }},                        
                                    '{{ addslashes($user->name) }}',       
                                    '{{ $user->email }}',         
                                    '{{ addslashes($user->role) }}',   
                                    '{{ $user->phone_number }}'
                                )" class="flex-1 inline-flex items-center justify-center rounded-xl bg-amber-400/10 border border-amber-400/30 px-3 py-2.5 text-xs font-bold text-amber-300 hover:bg-amber-400 hover:text-slate-950 transition shadow-sm">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Editar
                                </button>
                                
                                <button type="button" onclick="modalEliminar({{ $user->id }})" class="flex-1 inline-flex items-center justify-center rounded-xl bg-red-500/10 border border-red-500/30 px-3 py-2.5 text-xs font-bold text-red-400 hover:bg-red-600 hover:text-white transition shadow-sm">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    Bloquear
                                </button>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-slate-400">
                        <p class="text-sm font-bold text-slate-300">No hay usuarios registrados en el sistema.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Editar Usuario -->
    <div id="modal-usuario" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md px-4 py-6">
        <div class="w-full max-w-md rounded-3xl border border-amber-500/40 bg-slate-950 p-7 shadow-[0_0_60px_rgba(245,158,11,0.3)] ring-1 ring-amber-400/30">
            <h3 class="text-xl font-black text-white mb-1">Editar Usuario</h3>
            <p class="text-xs text-amber-400/80 mb-5">Actualiza el perfil y rol del usuario.</p>

            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs font-bold p-3 rounded-2xl mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 text-rose-300 text-xs font-bold p-3 rounded-2xl mb-4">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="form-usuario" method="POST" action="{{ url('/user') }}" onsubmit="this.action = '/user/' + document.getElementById('modal-user-id').value" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" id="modal-user-id" value="">
                
                <div class="space-y-1">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Nombre</label>
                    <input type="text" name="name" id="modal-user-nombre" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Correo Electrónico</label>
                    <input type="email" name="email" id="modal-user-email" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Teléfono</label>
                    <input type="text" name="phone_number" id="modal-user-telefono" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30" />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-1" />
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-amber-300">Rol de Usuario</label>
                    <select name="role" id="modal-user-role" class="w-full rounded-2xl border border-amber-500/25 bg-slate-900/90 px-4 py-2.5 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30">
                        <option value="admin">Administrador</option>
                        <option value="worker">Trabajador</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-1" />
                </div>

                <div class="flex flex-wrap gap-3 pt-3">
                    <button type="submit" class="inline-flex flex-1 justify-center rounded-full bg-gradient-to-r from-amber-400 to-yellow-300 px-5 py-3 text-xs font-black uppercase text-slate-950 hover:brightness-110 shadow-[0_0_20px_rgba(245,158,11,0.4)] transition">Actualizar</button>
                    <button type="button" onclick="cerrarModal()" class="inline-flex flex-1 justify-center rounded-full bg-slate-800 px-5 py-3 text-xs font-bold text-slate-300 border border-slate-700 hover:bg-slate-700 transition">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Bloquear Usuario -->
    <div id="modal-bloquear" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md px-4 py-6">
        <div class="w-full max-w-md rounded-3xl border border-red-500/40 bg-slate-950 p-7 shadow-[0_0_60px_rgba(220,38,38,0.3)] ring-1 ring-red-500/30">
            <div class="w-12 h-12 rounded-2xl bg-red-500/10 border border-red-500/30 flex items-center justify-center text-red-400 mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
            </div>
            <h3 class="text-xl font-black text-white">¿Bloquear usuario?</h3>
            <p class="mt-2 text-xs text-slate-300 leading-relaxed">El usuario perderá acceso al sistema y dejará de aparecer en las listas activas.</p>
            <form id="form-bloquear" method="POST" class="mt-6 flex justify-end gap-3">
                @csrf
                @method('PATCH')
                <button type="button" onclick="cerrarModalBloquear()" class="rounded-full bg-slate-800 px-5 py-2.5 text-xs font-bold text-slate-300 border border-slate-700 hover:bg-slate-700 transition">Cancelar</button>
                <button type="submit" class="rounded-full bg-gradient-to-r from-red-600 to-rose-700 px-6 py-2.5 text-xs font-black text-white uppercase tracking-wider hover:brightness-110 shadow-[0_0_20px_rgba(220,38,38,0.4)] transition">Confirmar Bloqueo</button>
            </form>
        </div>
    </div>

    <script>
        function abrirModal(id, nombre, email, role, telefono) {
            document.getElementById('modal-usuario').classList.remove('hidden');
            document.getElementById('modal-user-nombre').value = nombre;
            document.getElementById('modal-user-email').value = email;
            document.getElementById('modal-user-telefono').value = telefono;
            document.getElementById('modal-user-role').value = role;
            document.getElementById('modal-user-id').value = id;
            document.getElementById('form-usuario').action = `/user/${id}`;
        }

        function cerrarModal() {
            document.getElementById('modal-usuario').classList.add('hidden');
        }

        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('modal-usuario').classList.remove('hidden');
            });
        @endif

        function modalEliminar(id) {
            document.getElementById('modal-bloquear').classList.remove('hidden');
            document.getElementById('form-bloquear').action = `/user/${id}/bloquear`;
        }
        function cerrarModalBloquear() {
            document.getElementById('modal-bloquear').classList.add('hidden');
        }
    </script>
</x-app-layout>
