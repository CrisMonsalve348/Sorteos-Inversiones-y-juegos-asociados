<x-guest-layout>
    <div class="mb-4 text-xs text-slate-300 leading-relaxed">
        {{ __('Esta es un área protegida del sistema. Por favor confirma tu contraseña antes de continuar.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-3 text-xs">
                {{ __('Confirmar Acceso') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

