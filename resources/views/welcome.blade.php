<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Casino Royale - Sorteos & Inversiones') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|outfit:600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-[#070a0f] text-slate-100 font-sans antialiased selection:bg-amber-400 selection:text-slate-950 min-h-screen flex flex-col justify-between relative overflow-x-hidden">
        
        <!-- Background Ambient Glows -->
        <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[500px] bg-[radial-gradient(ellipse_at_top,_rgba(245,158,11,0.18),_rgba(220,38,38,0.08)_50%,_transparent_80%)] pointer-events-none z-0"></div>
        <div class="fixed bottom-0 right-0 w-[400px] h-[400px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <!-- Header Navigation -->
        <header class="w-full max-w-7xl mx-auto px-6 py-6 flex items-center justify-between relative z-10">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-2xl bg-amber-500/10 border border-amber-500/30 shadow-[0_0_20px_rgba(245,158,11,0.3)]">
                    <x-application-logo class="h-8 w-auto fill-current text-amber-400 drop-shadow-[0_0_10px_rgba(251,191,36,0.6)]" />
                </div>
                <div class="flex flex-col">
                    <span class="font-black text-lg tracking-wider text-white uppercase">Casino Royale</span>
                    <span class="text-[10px] tracking-[0.25em] uppercase text-amber-400 font-bold">Sorteos & Inversiones</span>
                </div>
            </div>

            @if (Route::has('login'))
                <nav class="flex items-center gap-3">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="px-6 py-2.5 rounded-full bg-gradient-to-r from-amber-400 to-yellow-300 text-slate-950 font-extrabold text-sm hover:brightness-110 shadow-[0_0_20px_rgba(245,158,11,0.4)] transition duration-200"
                        >
                            Ir al Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-5 py-2 rounded-full border border-amber-500/30 text-amber-300 font-bold text-sm hover:bg-amber-500/10 hover:border-amber-400 transition duration-200"
                        >
                            Iniciar Sesión
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="px-6 py-2 rounded-full bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 text-slate-950 font-extrabold text-sm hover:brightness-110 shadow-[0_0_20px_rgba(245,158,11,0.4)] transition duration-200"
                            >
                                Registrarse
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Hero Section -->
        <main class="w-full max-w-7xl mx-auto px-6 py-12 flex-1 flex flex-col items-center justify-center text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs uppercase font-extrabold tracking-[0.25em] mb-6 shadow-[0_0_15px_rgba(245,158,11,0.2)]">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Plataforma Oficial de Sorteos & Juegos VIP
            </div>

            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-white tracking-tight leading-none max-w-4xl">
                Experiencia VIP en <span class="bg-gradient-to-r from-amber-300 via-yellow-400 to-amber-500 bg-clip-text text-transparent drop-shadow-[0_0_25px_rgba(251,191,36,0.3)]">Juegos de Azar</span> e Inversiones
            </h1>

            <p class="mt-6 text-base sm:text-lg text-slate-300 max-w-2xl font-medium leading-relaxed">
                Gestiona participantes, salas de juegos interactivos, sorteos en vivo y clientes en una plataforma diseñada con la elegancia y emoción de un casino moderno de alta gama.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                @auth
                    <a href="{{ route('games') }}" class="px-8 py-4 rounded-full bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 text-slate-950 font-black text-base uppercase tracking-wider hover:brightness-110 shadow-[0_0_30px_rgba(245,158,11,0.5)] transition duration-200 transform hover:-translate-y-0.5">
                        Entrar a Sala de Juegos
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-8 py-4 rounded-full bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 text-slate-950 font-black text-base uppercase tracking-wider hover:brightness-110 shadow-[0_0_30px_rgba(245,158,11,0.5)] transition duration-200 transform hover:-translate-y-0.5">
                        Acceso Jugadores VIP
                    </a>
                @endauth
                <a href="#features" class="px-7 py-4 rounded-full border border-slate-700 bg-slate-900/80 text-slate-200 font-bold text-base hover:border-amber-500/40 hover:text-white transition duration-200">
                    Conocer Más
                </a>
            </div>

            <!-- Casino Feature Cards Grid -->
            <div id="features" class="mt-16 sm:mt-24 grid grid-cols-1 md:grid-cols-3 gap-6 w-full text-left">
                
                <div class="p-8 rounded-3xl bg-slate-900/80 border border-amber-500/20 shadow-[0_0_30px_rgba(0,0,0,0.5)] backdrop-blur-xl relative group hover:border-amber-400/50 hover:shadow-[0_0_35px_rgba(245,158,11,0.2)] transition duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Salas de Juego en Vivo</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">Visualización dinámica de cupos, participantes registrados y ejecución de ruletas con sorteo aleatorio garantizado.</p>
                </div>

                <div class="p-8 rounded-3xl bg-slate-900/80 border border-amber-500/20 shadow-[0_0_30px_rgba(0,0,0,0.5)] backdrop-blur-xl relative group hover:border-amber-400/50 hover:shadow-[0_0_35px_rgba(245,158,11,0.2)] transition duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-red-600/10 border border-red-500/30 flex items-center justify-center text-red-400 mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Gestión de Clientes VIP</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">Registro ágil de jugadores, teléfonos, documentos y exportación a reportes detallados en formato Excel.</p>
                </div>

                <div class="p-8 rounded-3xl bg-slate-900/80 border border-amber-500/20 shadow-[0_0_30px_rgba(0,0,0,0.5)] backdrop-blur-xl relative group hover:border-amber-400/50 hover:shadow-[0_0_35px_rgba(245,158,11,0.2)] transition duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Control & Seguridad</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">Administración de usuarios por roles (Administrador y Operador), bloqueo seguro y máxima privacidad.</p>
                </div>

            </div>
        </main>

        <!-- Footer -->
        <footer class="w-full max-w-7xl mx-auto px-6 py-8 border-t border-amber-500/20 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400 relative z-10">
            <p>&copy; {{ date('Y') }} Casino Royale - Sorteos, Inversiones & Juegos Asociados. Todos los derechos reservados.</p>
            <div class="flex items-center gap-6 font-semibold text-slate-400">
                <span class="hover:text-amber-400 transition cursor-pointer">Términos del Servicio</span>
                <span class="hover:text-amber-400 transition cursor-pointer">Política de Privacidad</span>
                <span class="text-amber-400/80 font-bold">Juego Responsable</span>
            </div>
        </footer>

    </body>
</html>
