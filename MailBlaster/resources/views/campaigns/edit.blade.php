@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">Editar campaña</h1>
    <div class="bg-white rounded shadow p-4">
        <form action="{{ route('campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('campaigns.partials.form', ['campaign' => $campaign])
            <div class="mt-4 flex justify-end gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar campaña</button>
                <a href="{{ route('campaigns.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
@endsection