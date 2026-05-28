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
                       @csrf             
                        <label for="nombre">Nombre completo del cliente:</label>
                        <input type="text" id="nombre" name="nombre" required>
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        <label for="numero_identificacion">Número de identificación:</label>
                        <input type="text" id="numero_identificacion" name="numero_identificacion" >
                        <x-input-error :messages="$errors->get('numero_identificacion')" class="mt-2" />
                        <label for="telefono">Número de teléfono:</label>
                        <input type="text" id="telefono" name="telefono" required>
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        <label for="id_juego">Juego</label>
                        <select name="id_juego" id="id_juego">
                            @foreach($juegos as $juego)
                                <option value="{{$juego->id}}">{{$juego->nombre}}</option>
                            @endforeach
                        </select>
                        <button type="submit">Agregar cliente</button>  

                    </form>

 

  
    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
