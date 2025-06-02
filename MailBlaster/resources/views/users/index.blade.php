@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Gestión de Usuarios</h1>
            <p class="text-slate-500 mt-1">Administra los usuarios del sistema</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Nuevo usuario
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-800 px-4 py-3 rounded-lg mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-6">
        <form method="GET" action="{{ route('users.index') }}" class="flex items-center gap-4">
            <div class="relative flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Buscar por nombre, email o rol..."
                    class="form-input pl-10">
            </div>
            <button type="submit" class="btn-primary px-6">
                Buscar
            </button>
            @if(request('search'))
                <a href="{{ route('users.index') }}" class="text-slate-600 hover:text-slate-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Limpiar
                </a>
            @endif
        </form>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="table-header px-5 py-3">Usuario</th>
                        <th class="table-header px-5 py-3">Email</th>
                        <th class="table-header px-5 py-3">Rol</th>
                        <th class="table-header px-5 py-3">Estado</th>
                        <th class="table-header px-5 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="table-row">
                        <td class="table-cell">
                            <div class="flex items-center">
                                <div class="user-avatar mr-3">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span class="font-medium">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="table-cell">{{ $user->email }}</td>
                        <td class="table-cell">
                            <span class="status-badge bg-indigo-100 text-indigo-800">
                                {{ $user->roles->first()->name ?? 'Sin rol' }}
                            </span>
                        </td>
                        <td class="table-cell">
                            @if($user->active)
                                <span class="user-status user-status-active">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Activo
                                </span>
                            @else
                                <span class="user-status user-status-inactive">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Inactivo
                                </span>
                            @endif
                        </td>
                        <td class="table-cell text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Editar
                                </a>
                                @if($user->active)
                                    <form action="{{ route('users.disable', $user) }}" method="POST" onsubmit="return confirm('¿Deshabilitar este usuario?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                            </svg>
                                            Deshabilitar
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('users.enable', $user) }}" method="POST" onsubmit="return confirm('¿Activar este usuario?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-emerald-600 hover:text-emerald-800 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                            Activar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection