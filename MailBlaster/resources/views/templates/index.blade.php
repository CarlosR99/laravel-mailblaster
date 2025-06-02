@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Plantillas de Correo</h1>
            <p class="text-slate-500 mt-1">Administra tus plantillas de correo electrónico</p>
        </div>
        <a href="{{ route('templates.create') }}" class="btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Nueva plantilla
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

    <div class="template-search">
        <form method="GET" action="{{ route('templates.index') }}" class="relative flex-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="template-search-icon h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="q" value="{{ request('q') }}" 
                   placeholder="Buscar por nombre o asunto..." 
                   class="template-search-input">
        </form>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="table-header px-5 py-3">Nombre</th>
                        <th class="table-header px-5 py-3">Asunto</th>
                        <th class="table-header px-5 py-3">Estado</th>
                        <th class="table-header px-5 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($templates as $template)
                    <tr class="table-row">
                        <td class="table-cell font-medium">{{ $template->name }}</td>
                        <td class="table-cell">{{ $template->subject ?: '-' }}</td>
                        <td class="table-cell">
                            @if($template->active)
                                <span class="template-status template-status-active">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Activa
                                </span>
                            @else
                                <span class="template-status template-status-inactive">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Inactiva
                                </span>
                            @endif
                        </td>
                        <td class="table-cell text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('templates.edit', $template) }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Editar
                                </a>
                                @if($template->active)
                                    <form action="{{ route('templates.disable', $template) }}" method="POST" onsubmit="return confirm('¿Deshabilitar esta plantilla?');">
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
                                    <form action="{{ route('templates.enable', $template) }}" method="POST" onsubmit="return confirm('¿Habilitar esta plantilla?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-emerald-600 hover:text-emerald-800 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                            Habilitar
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