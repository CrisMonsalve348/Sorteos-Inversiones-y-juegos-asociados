<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-black text-white tracking-tight">Acceso a la Plataforma</h2>
        <p class="text-xs text-amber-400/80 font-medium mt-1">Ingresa tus credenciales para acceder al casino</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="usuario@casino.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-amber-500/30 bg-slate-900 text-amber-500 shadow-sm focus:ring-amber-400/40" name="remember">
                <span class="ms-2 text-xs text-slate-300 font-semibold">{{ __('Recordarme') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-amber-400 hover:text-yellow-300 font-bold transition hover:underline" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-3 text-sm">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <div class="mt-6 text-center text-xs text-slate-400 pt-3 border-t border-slate-800">
                ¿No tienes una cuenta aún?
                <a href="{{ route('register') }}" class="text-amber-400 font-bold hover:text-yellow-300 transition hover:underline ml-1">
                    Regístrate aquí
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>

