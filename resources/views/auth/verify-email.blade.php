<x-guest-layout>
    <div class="mb-4 text-xs text-slate-300 leading-relaxed">
        {{ __('¡Gracias por registrarte! Antes de comenzar, por favor verifica tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-bold text-xs text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl p-3">
            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo proporcionada.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button class="text-xs py-2.5">
                {{ __('Reenviar Enlace') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-xs text-red-400 font-bold hover:text-red-300 transition">
                {{ __('Cerrar Sesión') }}
            </button>
        </form>
    </div>
</x-guest-layout>

