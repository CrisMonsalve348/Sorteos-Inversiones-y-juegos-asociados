<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Juegos
        </h2>
    </x-slot>

  {{-- Tu contenido va aquí --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   @forelse($games as $game)
    <p>{{ $game->nombre }}</p>
    <p>{{ $game->descripcion }}</p>
    <p> {{ $game->cantidad_jugadores}} </p>

    @empty
    <p>No hay juegos registrados.</p>
@endforelse

    <div class="mt-4">
        <form action="{{ route('games') }}" method="POST">
    @csrf
    <label for="nombre">Nombre del juego:</label>
    <input type="text" id="nombre" name="nombre" required>
    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
    <label for="descripcion">Descripción del juego:</label>
    <textarea id="descripcion" name="descripcion" required></textarea>
    <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    <label for="tipo">Tipo de juego:</label>
    <select id="tipo_juego" name="tipo_juego">
        @foreach($tipo_juego as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre_juego }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('tipo_juego_id')" class="mt-2" />
    <label for="cantidad_jugadores">Cantidad de jugadores:</label>
    <input type="number" id="cantidad_jugadores" name="cantidad_jugadores" required>
    <x-input-error :messages="$errors->get('cantidad_jugadores')" class="mt-2" />
    <label for="casino">Casino de procedencia</label>
    <select id="casino" name="casino">
        @foreach($casinos as $casino)
            <option value="{{ $casino->id }}">{{ $casino->nombre }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('id_casino')" class="mt-2" />
    <button type="submit">Agregar juego</button>
</form>

    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
