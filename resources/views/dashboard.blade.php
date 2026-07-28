<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-black tracking-tight text-amber-300 drop-shadow-[0_0_15px_rgba(251,191,36,0.5)]">
                Centro de Control VIP
            </h2>
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-xs font-bold text-amber-300">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Sesión Activa: {{ Auth::user()->role === 'admin' ? 'Administrador' : 'Operador' }}
            </div>
        </div>
    </x-slot>

    <div class="py-10 min-h-[calc(100vh-140px)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Casino Welcome Banner -->
            <div class="rounded-3xl border border-amber-500/25 bg-slate-950/80 p-8 shadow-[0_0_50px_rgba(245,158,11,0.15)] ring-1 ring-amber-400/20 backdrop-blur-xl relative overflow-hidden">
                <div class="absolute -top-16 -right-16 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-[0.3em] font-extrabold text-amber-400/90">Panel Principal</p>
                        <h1 class="text-3xl sm:text-4xl font-black text-white">¡Bienvenido al Casino, {{ Auth::user()->name }}!</h1>
                        <p class="text-sm text-slate-300 max-w-2xl leading-relaxed">
                            Has iniciado sesión en el sistema de gestión de sorteos e inversiones. Desde aquí puedes controlar las salas de juego en tiempo real, inscribir clientes y administrar permisos de usuario.
                        </p>
                    </div>

                    <a href="{{ route('games') }}" class="inline-flex items-center justify-center shrink-0 px-6 py-3.5 rounded-full bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 text-slate-950 font-black text-sm uppercase tracking-wider hover:brightness-110 shadow-[0_0_25px_rgba(245,158,11,0.4)] transition duration-200">
                        Ir a la Sala de Juegos
                    </a>
                </div>
            </div>

            <!-- Quick Action Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Sala de Juegos Card -->
                <a href="{{ route('games') }}" class="group block p-7 rounded-3xl bg-slate-900/80 border border-amber-500/20 hover:border-amber-400/60 shadow-[0_0_30px_rgba(0,0,0,0.5)] hover:shadow-[0_0_40px_rgba(245,158,11,0.25)] transition duration-300 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 group-hover:scale-110 transition duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-xs font-bold text-amber-400 uppercase tracking-wider group-hover:translate-x-1 transition">Entrar &rarr;</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Sala de Juegos</h3>
                    <p class="text-xs text-slate-400 leading-relaxed mb-4">Crea partidas, inscribe participantes y ejecuta la ruleta de selección aleatoria.</p>
                    <div class="pt-4 border-t border-slate-800 text-[11px] font-bold text-amber-300/80 uppercase tracking-widest">
                        Gestión en Vivo
                    </div>
                </a>

                <!-- Clientes VIP Card -->
                <a href="{{ route('clientes') }}" class="group block p-7 rounded-3xl bg-slate-900/80 border border-amber-500/20 hover:border-amber-400/60 shadow-[0_0_30px_rgba(0,0,0,0.5)] hover:shadow-[0_0_40px_rgba(245,158,11,0.25)] transition duration-300 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 group-hover:scale-110 transition duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider group-hover:translate-x-1 transition">Ver Clientes &rarr;</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Clientes VIP</h3>
                    <p class="text-xs text-slate-400 leading-relaxed mb-4">Registra nuevos participantes, edita sus datos y descarga el reporte consolidado en Excel.</p>
                    <div class="pt-4 border-t border-slate-800 text-[11px] font-bold text-emerald-400/80 uppercase tracking-widest">
                        Exportación Excel Disponible
                    </div>
                </a>

                <!-- Usuarios Card -->
                <a href="{{ route('user') }}" class="group block p-7 rounded-3xl bg-slate-900/80 border border-amber-500/20 hover:border-amber-400/60 shadow-[0_0_30px_rgba(0,0,0,0.5)] hover:shadow-[0_0_40px_rgba(245,158,11,0.25)] transition duration-300 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-red-600/10 border border-red-500/30 flex items-center justify-center text-red-400 group-hover:scale-110 transition duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <span class="text-xs font-bold text-red-400 uppercase tracking-wider group-hover:translate-x-1 transition">Gestionar &rarr;</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Directorio de Usuarios</h3>
                    <p class="text-xs text-slate-400 leading-relaxed mb-4">Revisa la lista de operadores y administradores, actualiza roles o deshabilita usuarios.</p>
                    <div class="pt-4 border-t border-slate-800 text-[11px] font-bold text-red-400/80 uppercase tracking-widest">
                        Control de Accesos
                    </div>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
