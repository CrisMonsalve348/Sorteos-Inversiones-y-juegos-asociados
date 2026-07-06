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
                    @forelse($users as $user)
    <p>{{ $user->name }}</p>
    <p>{{ $user->email}}</p>
    <p>{{$user->role}}</p>
    <p>{{$user->phone_number}}</p>
    *******************************

       <button type="button" onclick="abrirModal(
    {{ $user->id }},                        
    '{{ addslashes($user->name) }}',       
    '{{ $user->email }}',         
    '{{ addslashes($user->role) }}',   
    '{{ $user->phone_number }}',               

)">
    Editar
</button>


<button type="button" onclick="modalEliminar({{ $user->id }})">
    Bloquear
</button>

    @empty
    <p>No hay usuarios registrados.</p>
@endforelse

                </div>
      <div id="modal-usuario" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3>Editar Usuario</h3>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="form-usuario" method="POST" action="{{ url('/user') }}" onsubmit="this.action = '/user/' + document.getElementById('modal-user-id').value">
            @csrf
            @method('PUT')
            <input type="hidden" id="modal-user-id" value="">
            <label>Nombre:</label>
            <input type="text" name="name" id="modal-user-nombre">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <label>Correo:</label>
            <input type="email" name="email" id="modal-user-email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <label>Teléfono:</label>
            <input type="text" name="phone_number" id="modal-user-telefono">
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />

            <label>Rol:</label>
           <select name="role" id="modal-user-role">
    <option value="admin">Administrador</option>
    <option value="worker">Trabajador</option>
</select>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />

            <button type="submit">Actualizar</button>
            <button type="button" onclick="cerrarModal()">Cancelar</button>
        </form>
    </div>
</div>
<div id="modal-bloquear" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3>¿Bloquear usuario?</h3>
        <p>El usuario dejará de aparecer en el sistema.</p>
        <form id="form-bloquear" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit">Confirmar</button>
            <button type="button" onclick="cerrarModalBloquear()">Cancelar</button>
        </form>
    </div>
</div>
<script>

function abrirModal(id, nombre, email, role, telefono) {
    console.log('id recibido:', id); // verifica aquí
    document.getElementById('modal-usuario').classList.remove('hidden');
    document.getElementById('modal-user-nombre').value = nombre;
    document.getElementById('modal-user-email').value = email;
    document.getElementById('modal-user-telefono').value = telefono;
    document.getElementById('modal-user-role').value = role;
    document.getElementById('modal-user-id').value = id;
    document.getElementById('form-usuario').action = `/user/${id}`;
    console.log('action:', document.getElementById('form-usuario').action); // y aquí
}

function cerrarModal() {
    document.getElementById('modal-usuario').classList.add('hidden');
}
// Abrir el modal automáticamente si hay errores de validación
@if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('modal-usuario').classList.remove('hidden');
    });
@endif

function modalEliminar(id) {
    document.getElementById('modal-bloquear').classList.remove('hidden');
    document.getElementById('form-bloquear').action = `/user/${id}/bloquear`;
}
function cerrarModalBloquear() {
    document.getElementById('modal-bloquear').classList.add('hidden');
}
</script>
            </div>
        </div>
    </div>
</x-app-layout>
