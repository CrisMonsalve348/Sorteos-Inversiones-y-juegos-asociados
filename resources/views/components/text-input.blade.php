@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-slate-900/90 border border-amber-500/25 focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30 text-slate-100 placeholder:text-slate-500 rounded-2xl shadow-inner shadow-slate-950/50 transition duration-200']) }}>

