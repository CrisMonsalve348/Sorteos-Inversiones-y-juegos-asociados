<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <linearGradient id="casinoGold" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#FCD34D" />
            <stop offset="50%" stop-color="#F59E0B" />
            <stop offset="100%" stop-color="#B45309" />
        </linearGradient>
        <linearGradient id="casinoRed" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#EF4444" />
            <stop offset="100%" stop-color="#991B1B" />
        </linearGradient>
    </defs>
    <!-- Outer Chip Ring -->
    <circle cx="50" cy="50" r="44" stroke="url(#casinoGold)" stroke-width="4" stroke-dasharray="10 4" />
    <circle cx="50" cy="50" r="38" stroke="url(#casinoGold)" stroke-width="2" />
    <!-- Inner Diamond / Crown Emblem -->
    <path d="M50 18L72 50L50 82L28 50L50 18Z" fill="url(#casinoGold)" opacity="0.9" />
    <path d="M50 26L64 50L50 74L36 50L50 26Z" fill="url(#casinoRed)" />
    <!-- Center Star -->
    <polygon points="50,38 53,46 62,46 55,51 58,59 50,54 42,59 45,51 38,46 47,46" fill="#FDF0A6" />
</svg>

