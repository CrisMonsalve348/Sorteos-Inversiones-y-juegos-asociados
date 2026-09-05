<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Inversiones y juegos asociados SAS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|outfit:500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-100 antialiased bg-[#070a0f] selection:bg-amber-400 selection:text-slate-950">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-0 bg-[#070a0f] bg-[radial-gradient(circle_at_center,_rgba(245,158,11,0.12)_0%,_rgba(7,10,15,1)_70%)] px-4">
            <div class="mb-6 transform hover:scale-105 transition duration-300">
                <a href="/" class="flex flex-col items-center gap-2 group">
                    <div class="p-4 rounded-3xl bg-slate-950/80 border border-amber-500/30 shadow-[0_0_30px_rgba(245,158,11,0.25)] ring-1 ring-amber-400/20">
                        <x-application-logo class="w-20 h-20" />
                    </div>
                    <span class="text-xs text-center max-w-xs font-extrabold text-amber-400/90 group-hover:text-yellow-300 transition leading-snug">Inversiones y juegos asociados SAS</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 bg-slate-900/90 backdrop-blur-xl border border-amber-500/25 shadow-[0_0_60px_rgba(245,158,11,0.15)] ring-1 ring-amber-400/20 rounded-3xl relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-12 -left-12 w-32 h-32 bg-red-600/10 rounded-full blur-2xl pointer-events-none"></div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

