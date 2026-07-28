<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-black tracking-tight text-amber-300 drop-shadow-[0_0_15px_rgba(251,191,36,0.5)]">
            Perfil de Usuario VIP
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="p-6 sm:p-8 bg-slate-900/90 border border-amber-500/20 shadow-[0_0_40px_rgba(0,0,0,0.6)] rounded-3xl backdrop-blur-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-slate-900/90 border border-amber-500/20 shadow-[0_0_40px_rgba(0,0,0,0.6)] rounded-3xl backdrop-blur-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-slate-900/90 border border-red-500/30 shadow-[0_0_40px_rgba(220,38,38,0.15)] rounded-3xl backdrop-blur-xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

