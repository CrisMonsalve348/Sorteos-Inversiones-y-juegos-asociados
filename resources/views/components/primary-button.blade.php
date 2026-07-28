<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 border border-yellow-300/40 rounded-full font-bold text-xs text-slate-950 uppercase tracking-widest hover:brightness-110 hover:shadow-[0_0_25px_rgba(245,158,11,0.5)] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-amber-400/50 transition duration-200 shadow-md shadow-amber-500/20']) }}>
    {{ $slot }}
</button>

