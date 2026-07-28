<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-red-600 to-rose-700 border border-red-500/40 rounded-full font-bold text-xs text-white uppercase tracking-widest hover:brightness-110 hover:shadow-[0_0_25px_rgba(220,38,38,0.5)] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-red-500/50 transition duration-200 shadow-md shadow-red-900/30']) }}>
    {{ $slot }}
</button>

