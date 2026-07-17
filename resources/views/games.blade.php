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

    <details class="group mb-4 rounded-lg border border-gray-200 bg-gray-50 p-4 shadow-sm">
        <summary class="cursor-pointer list-none">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-lg font-semibold text-gray-900">{{ $game->nombre }}</p>
                    <p class="text-sm text-gray-600">{{ $game->descripcion }}</p>
                </div>
                <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700">
                    {{ $game->clientes->count() }}/{{ $game->cantidad_jugadores }}
                </span>
            </div>
        </summary>

        <div class="mt-4 border-t border-gray-200 pt-4">
            <div class="space-y-2 text-sm text-gray-700">
                <p><span class="font-semibold">Estado:</span> {{ ucfirst(str_replace('_', ' ', $game->estado)) }}</p>
                <p><span class="font-semibold">Jugadores inscritos:</span> {{ $game->clientes->count() }}/{{ $game->cantidad_jugadores }}</p>

                <div>
                    <p class="font-semibold">Todos los jugadores</p>
                    @if($game->clientes->isEmpty())
                        <p class="mt-2 text-gray-500">No hay jugadores registrados para este juego.</p>
                    @else
                        <ul class="mt-2 max-h-40 overflow-y-auto rounded border border-gray-200 bg-white">
                            @foreach($game->clientes as $cliente)
                                <li class="border-b border-gray-100 px-3 py-2 text-sm last:border-b-0">
                                    {{ $cliente->nombre }} - {{ $cliente->numero_identificacion }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="mt-4 flex flex-wrap gap-2">
                <button type="button" onclick="abrirModal(
                    {{ $game->id }},
                    '{{ addslashes($game->nombre) }}',
                    {{ $game->cantidad_jugadores }},
                    '{{ addslashes($game->descripcion) }}',
                    {{ $game->tipo_juego_id }},
                    {{ $game->id_casino }}
                )" class="rounded bg-yellow-500 px-3 py-2 text-sm font-medium text-white">
                    Editar
                </button>

                <button type="button" onclick="modalEliminar({{ $game->id }})" class="rounded bg-red-600 px-3 py-2 text-sm font-medium text-white">
                    Bloquear
                </button>
            </div>
        </div>
    </details>

    @empty
    <p>No hay juegos registrados.</p>
@endforelse
{{-- Modal (fuera del forelse, una sola vez en la página) --}}
<div id="modal-editar" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3>Editar Juego</h3>
        <form id="form-editar" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="nombre" id="modal-nombre">
            <textarea name="descripcion" id="modal-descripcion"></textarea>
            <input type="number" name="cantidad_jugadores" id="modal-cantidad">
            <select name="tipo_juego" id="modal-tipo-juego">
                @foreach($tipo_juego as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre_juego }}</option>
                @endforeach

            </select>
            <button type="submit">Actualizar</button>
            <button type="button" onclick="cerrarModal()">Cancelar</button>
            <select name="casino" id="modal-casino">
                @foreach($casinos as $casino)
                    <option value="{{ $casino->id }}">{{ $casino->nombre }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>
<div id="modal-bloquear" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3>¿Bloquear juego?</h3>
        <p>El juego y sus clientes dejarán de aparecer en el sistema.</p>
        <form id="form-bloquear" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit">Confirmar</button>
            <button type="button" onclick="cerrarModalBloquear()">Cancelar</button>
        </form>
    </div>
</div>

<script>
function abrirModal(id, nombre, cantidad, descripcion, tipoJuegoId, idCasino) {
    document.getElementById('modal-editar').classList.remove('hidden');
    document.getElementById('modal-nombre').value = nombre;
    document.getElementById('modal-cantidad').value = cantidad;
    document.getElementById('modal-descripcion').value = descripcion;
    document.getElementById('form-editar').action = `/games/${id}`;
    
    // Seleccionar el tipo de juego actual
    document.getElementById('modal-tipo-juego').value = tipoJuegoId;
    
    // Seleccionar el casino actual
    document.getElementById('modal-casino').value = idCasino;
}
function cerrarModal() {
    document.getElementById('modal-editar').classList.add('hidden');
}
function modalEliminar(id) {
    document.getElementById('modal-bloquear').classList.remove('hidden');
    document.getElementById('form-bloquear').action = `/games/${id}/bloquear`;
}

function cerrarModalBloquear() {
    document.getElementById('modal-bloquear').classList.add('hidden');
}
</script>
    <div class="mt-4">
<form action="{{ route('games') }}" method="POST">
    @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
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
