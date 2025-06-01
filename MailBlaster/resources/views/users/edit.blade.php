@extends('layouts.admin')

@section('admin-content')
<div x-data="{ open: true }">
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-lg shadow-lg relative">
            <button @click="open = false; window.location='{{ route('users.index') }}'" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
            <h1 class="text-2xl font-bold mb-6">Editar usuario</h1>

            @if($errors->any())
                <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                @include('users.partials.form', ['user' => $user, 'roles' => $roles])
                <div class="mt-4 flex justify-end gap-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar usuario</button>
                    <a href="{{ route('users.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection