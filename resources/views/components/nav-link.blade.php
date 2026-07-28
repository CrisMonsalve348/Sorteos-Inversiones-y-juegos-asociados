@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3.5 py-2 rounded-full border border-amber-500/40 bg-amber-500/10 text-amber-300 font-bold text-sm leading-5 shadow-[0_0_15px_rgba(245,158,11,0.25)] focus:outline-none transition duration-200 ease-in-out'
            : 'inline-flex items-center px-3.5 py-2 rounded-full border border-transparent text-slate-300 hover:text-white hover:bg-slate-900 hover:border-amber-500/20 font-medium text-sm leading-5 focus:outline-none transition duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

