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
    @empty
    <p>No hay usuarios registrados.</p>
@endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
