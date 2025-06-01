{{-- filepath: resources/views/settings/edit.blade.php --}}
@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">Ajustes de perfil</h1>
    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('settings.update') }}" class="max-w-md space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold mb-1">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded border-gray-300" required>
        </div>
        <div>
            <label class="block font-semibold mb-1">Correo electrónico</label>
            <input type="email" value="{{ $user->email }}" class="w-full rounded border-gray-300 bg-gray-100" disabled>
        </div>
        <div>
            <label class="block font-semibold mb-1">Nueva contraseña</label>
            <input type="password" name="password" class="w-full rounded border-gray-300">
        </div>
        <div>
            <label class="block font-semibold mb-1">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="w-full rounded border-gray-300">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar cambios</button>
    </form>
@endsection