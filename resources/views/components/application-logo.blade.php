@php
    $logoExists = file_exists(public_path('images/logo.png'));
@endphp

@if ($logoExists)
    <img
        src="{{ asset('images/logo.png') }}"
        alt="Inversiones y juegos asociados SAS"
        {{ $attributes->merge(['class' => 'object-contain']) }}
    />
@else
    <div
        {{ $attributes->merge(['class' => 'flex items-center justify-center rounded-lg border-2 border-dashed border-amber-500/40 bg-slate-800/30 text-amber-500/40']) }}
        title="Coloque el logo de la empresa en public/images/logo.png"
    >
        <svg class="w-1/2 h-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </div>
@endif
