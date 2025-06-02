@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Editar Campaña</h1>
            <p class="text-slate-500 mt-1">Actualiza los detalles de tu campaña</p>
        </div>
        <a href="{{ route('campaigns.index') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver
        </a>
    </div>

    <div class="card">
        <form action="{{ route('campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                @include('campaigns.partials.form', ['campaign' => $campaign])
                
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <button type="submit" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Actualizar campaña
                    </button>
                    <a href="{{ route('campaigns.index') }}" class="btn-outline">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection