@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">Crear campaña</h1>
    {{-- Aquí irá el formulario para crear campaña --}}
    <div class="bg-white rounded shadow p-4">
        <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('campaigns.partials.form', ['campaign' => null])
            <div class="mt-4 flex justify-end gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Crear campaña
                </button>
                <a href="{{ route('campaigns.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
@endsection