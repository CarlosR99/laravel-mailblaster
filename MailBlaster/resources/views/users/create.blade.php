@extends('layouts.admin')

@section('admin-content')
<div class="modal-overlay" x-data="{ open: true }" x-show="open" x-cloak>
    <div class="modal-content">
        <button @click="open = false; window.location='{{ route('users.index') }}'" class="modal-close">&times;</button>
        
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Crear Nuevo Usuario</h1>
            <p class="text-slate-500 mt-1">Complete los datos del usuario</p>
        </div>

        @if($errors->any())
            <div class="bg-rose-100 text-rose-800 px-4 py-3 rounded-lg mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span>Por favor corrija los siguientes errores:</span>
                <ul class="list-disc pl-5 ml-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @include('users.partials.form', ['user' => null, 'roles' => $roles])
            
            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100 mt-8">
                <button type="submit" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Crear usuario
                </button>
                <a href="{{ route('users.index') }}" class="btn-outline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection