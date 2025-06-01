@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">Plantillas de correo</h1>
    <a href="{{ route('templates.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Nueva plantilla</a>
    <form method="GET" action="{{ route('templates.index') }}" class="mb-4 flex">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por nombre o asunto..." class="border rounded px-2 py-1 mr-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Buscar</button>
    </form>
    <div class="bg-white rounded shadow p-4">
        @if(session('success'))
            <div class="mb-2 text-green-600">{{ session('success') }}</div>
        @endif
        <table class="min-w-full">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Asunto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($templates as $template)
                <tr>
                    <td>{{ $template->name }}</td>
                    <td>{{ $template->subject }}</td>
                    <td>
                        <a href="{{ route('templates.edit', $template) }}" class="text-blue-600 hover:underline">Editar</a>
                        @if($template->active)
                            <form action="{{ route('templates.disable', $template) }}" method="POST" class="inline" onsubmit="return confirm('¿Deshabilitar plantilla?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-red-600 hover:underline ml-2">Deshabilitar</button>
                            </form>
                        @else
                            <form action="{{ route('templates.enable', $template) }}" method="POST" class="inline" onsubmit="return confirm('¿Habilitar plantilla?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-green-600 hover:underline ml-2">Habilitar</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection