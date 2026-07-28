<x-guest-layout>
    <div class="mb-4 text-xs text-slate-300 leading-relaxed">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Ingresa tu correo electrónico registrado y te enviaremos un enlace de recuperación.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="usuario@casino.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-3 text-xs">
                {{ __('Enviar Enlace de Recuperación') }}
            </x-primary-button>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-xs text-amber-400 font-bold hover:text-yellow-300 transition">
                &larr; Volver a Iniciar Sesión
            </a>
        </div>
    </form>
</x-guest-layout>

