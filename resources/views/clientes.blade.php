<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clientes
        </h2>
    </x-slot>

  {{-- Tu contenido va aquí --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                
                    <form action="{{route('CrearCliente')}}" method="post">
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
                        <label for="nombre">Nombre completo del cliente:</label>
                        <input type="text" id="nombre" name="nombre" required>
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        <label for="numero_identificacion">Número de identificación:</label>
                        <input type="text" id="numero_identificacion" name="numero_identificacion" >
                        <x-input-error :messages="$errors->get('numero_identificacion')" class="mt-2" />
                        <label for="telefono">Número de teléfono:</label>
                        <input type="text" id="telefono" name="numero_telefono" required>
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        <label for="id_juego">Juego</label>
                        <select name="id_juego" id="id_juego">
                            @foreach($juegos as $juego)
                                <option value="{{$juego->id}}">{{$juego->nombre}}</option>
                            @endforeach
                        </select>
                        <button type="submit">Agregar cliente</button>  
                        <x-input-error :messages="$errors->get('id_juego')" class="mt-2" />
                    </form>

        
                <div class="mt-4">
                    <a href="{{ route('clientes.export') }}">Descargar Excel</a>
                    @forelse($clientes as $cliente)
                        <p>{{ $cliente->nombre }}</p>
                        <p>{{ $cliente->numero_identificacion }}</p>
                        <p>{{ $cliente->numero_telefono }}</p>
                        <p>{{ $cliente->juego?->nombre }}</p>

                            <button type="button" onclick="abrirModalCliente(
        {{ $cliente->id }},
        '{{ addslashes($cliente->nombre) }}',
        '{{ addslashes($cliente->numero_identificacion) }}',
        '{{ addslashes($cliente->numero_telefono) }}',
        {{ $cliente->id_juego }}
    )">
        Editar
    </button>
    <button type="button" onclick="modalEliminar({{ $cliente->id }})">
    Bloquear
</button>

                        *************************************
                    @empty
                        <p>No hay clientes registrados.</p>
                    @endforelse   
                </div>
    <div id="modal-cliente" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3>Editar Cliente</h3>
        <form id="form-cliente" method="POST">
            @csrf
            @method('PUT')
            <label>Nombre:</label>
            <input type="text" name="nombre" id="modal-cliente-nombre">
            <label>Número de identificación:</label>
            <input type="text" name="numero_identificacion" id="modal-cliente-identificacion">
            <label>Número de teléfono:</label>
            <input type="text" name="numero_telefono" id="modal-cliente-telefono">
            <label>Juego:</label>
            <select name="id_juego" id="modal-cliente-juego">
                @foreach($juegos as $juego)
                    <option value="{{ $juego->id }}">{{ $juego->nombre }}</option>
                @endforeach
            </select>
            <button type="submit">Actualizar</button>
            <button type="button" onclick="cerrarModalCliente()">Cancelar</button>
        </form>
    </div>
</div>
<div id="modal-bloquear" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3>¿Bloquear cliente?</h3>
        <p>El cliente dejará de aparecer en el sistema.</p>
        <form id="form-bloquear" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit">Confirmar</button>
            <button type="button" onclick="cerrarModalBloquear()">Cancelar</button>
        </form>
    </div>
</div>

  
    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function abrirModalCliente(id, nombre, identificacion, telefono, idJuego) {
    document.getElementById('modal-cliente').classList.remove('hidden');
    document.getElementById('modal-cliente-nombre').value = nombre;
    document.getElementById('modal-cliente-identificacion').value = identificacion;
    document.getElementById('modal-cliente-telefono').value = telefono;
    document.getElementById('modal-cliente-juego').value = idJuego;
    document.getElementById('form-cliente').action = `/clientes/${id}`;
}

function cerrarModalCliente() {
    document.getElementById('modal-cliente').classList.add('hidden');
}
function modalEliminar(id) {
    document.getElementById('modal-bloquear').classList.remove('hidden');
    document.getElementById('form-bloquear').action = `/clientes/${id}/bloquear`;
}

function cerrarModalBloquear() {
    document.getElementById('modal-bloquear').classList.add('hidden');
}
</script>