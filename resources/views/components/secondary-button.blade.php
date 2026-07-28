<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-slate-900 border border-slate-700/80 rounded-full font-bold text-xs text-slate-200 uppercase tracking-widest hover:bg-slate-800 hover:text-white hover:border-amber-500/40 hover:shadow-[0_0_15px_rgba(255,255,255,0.1)] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-amber-400/40 disabled:opacity-30 transition duration-200 shadow-sm']) }}>
    {{ $slot }}
</button>

