{{-- filepath: resources/views/logs/index.blade.php --}}
@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">Registros del sistema</h1>
    <div class="bg-white rounded shadow p-4 overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Usuario</th>
                    <th class="px-4 py-2">Acción</th>
                    <th class="px-4 py-2">Entidad</th>
                    <th class="px-4 py-2">Descripción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="px-4 py-2">{{ $log->created_at }}</td>
                    <td class="px-4 py-2">{{ $log->user->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $log->action }}</td>
                    <td class="px-4 py-2">
                        @if($log->entity_type === 'campaign')
                            Campaña: {{ optional(\App\Models\Campaign::find($log->entity_id))->name ?? '-' }}
                        @elseif($log->entity_type === 'user')
                            Usuario: {{ optional(\App\Models\User::find($log->entity_id))->email ?? '-' }}
                        @elseif($log->entity_type === 'template')
                            Plantilla: {{ optional(\App\Models\Template::find($log->entity_id))->name ?? '-' }}
                        @elseif($log->entity_type === 'settings')
                            Ajustes
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $log->description }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-400 py-4">No hay registros.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
@endsection