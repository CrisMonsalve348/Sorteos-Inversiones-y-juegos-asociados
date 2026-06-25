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
                    @forelse($clientes as $cliente)
                        <p>{{ $cliente->nombre }}</p>
                        <p>{{ $cliente->numero_identificacion }}</p>
                        <p>{{ $cliente->numero_telefono }}</p>
                        <p>{{ $cliente->juego?->nombre }}</p>
                        *************************************
                    @empty
                        <p>No hay clientes registrados.</p>
                    @endforelse   
                </div>
  

  
    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
