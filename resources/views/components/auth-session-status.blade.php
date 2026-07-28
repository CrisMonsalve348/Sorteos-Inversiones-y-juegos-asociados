@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-bold text-xs text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl px-4 py-3 shadow-[0_0_15px_rgba(16,185,129,0.2)]']) }}>
        {{ $status }}
    </div>
@endif

