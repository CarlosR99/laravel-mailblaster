@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Usuarios</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 flex items-center gap-2">
        <form method="GET" action="{{ route('users.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Buscar usuario, email o rol..."
                class="rounded border-gray-300 px-3 py-2 w-64">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Buscar</button>
            @if(request('search'))
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:underline ml-2">Limpiar</a>
            @endif
        </form>
        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 ml-auto">Nuevo usuario</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Rol</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b dark:border-gray-700">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">
                        {{ $user->roles->first()->name ?? 'Sin rol' }}
                    </td>
                    <td class="px-4 py-2">
                        @if($user->active)
                            <span class="badge badge-active">Activo</span>
                        @else
                            <span class="badge badge-completed">Deshabilitado</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:underline">Editar</a>
                        @if($user->active)
                            <form action="{{ route('users.disable', $user) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas deshabilitar este usuario?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-red-600 hover:underline">Deshabilitar</button>
                            </form>
                        @else
                            <form action="{{ route('users.enable', $user) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas activar este usuario?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-green-600 hover:underline">Activar</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection