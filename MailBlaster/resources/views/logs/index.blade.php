@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Registros del Sistema</h1>
            <p class="text-slate-500 mt-1">Historial de actividades recientes</p>
        </div>
        <div class="search-container w-full md:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="search-icon h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" placeholder="Buscar registros..." class="search-input" id="search-logs">
        </div>
    </div>

    <div class="log-table-container">
        <div class="log-table-responsive">
            <table class="log-table">
                <thead>
                    <tr>
                        <th class="log-table-header w-40">Fecha</th>
                        <th class="log-table-header w-32">Usuario</th>
                        <th class="log-table-header w-32">Acción</th>
                        <th class="log-table-header w-40">Entidad</th>
                        <th class="log-table-header">Detalles</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($logs as $log)
                    <tr class="log-table-row">
                        <td class="log-table-cell whitespace-nowrap">
                            {{ $log->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="log-table-cell">
                            <div class="flex items-center">
                                <div class="user-avatar mr-3">
                                    {{ strtoupper(substr($log->user->name ?? '?', 0, 2)) }}
                                </div>
                                <span class="truncate max-w-[120px]">{{ $log->user->name ?? 'Sistema' }}</span>
                            </div>
                        </td>
                        <td class="log-table-cell capitalize">
                            <span class="px-2 py-1 bg-slate-100 rounded-md">{{ $log->action }}</span>
                        </td>
                        <td class="log-table-cell">
                            @if($log->entity_type === 'campaign')
                                <span class="text-indigo-600 font-medium">Campaña:</span>
                                <span class="truncate">
                                    {{ $log->entity_name 
                                        ?? optional($log->campaign)->name 
                                        ?? optional(\App\Models\Campaign::find($log->entity_id))->name 
                                        ?? '-' }}
                                </span>
                            @elseif($log->entity_type === 'user')
                                <span class="text-indigo-600 font-medium">Usuario:</span>
                                <span class="truncate">
                                    {{ $log->entity_name 
                                        ?? optional($log->targetUser)->email 
                                        ?? optional(\App\Models\User::find($log->entity_id))->email 
                                        ?? '-' }}
                                </span>
                            @elseif($log->entity_type === 'template')
                                <span class="text-indigo-600 font-medium">Plantilla:</span>
                                <span class="truncate">
                                    {{ $log->entity_name 
                                        ?? optional($log->template)->name 
                                        ?? optional(\App\Models\Template::find($log->entity_id))->name 
                                        ?? '-' }}
                                </span>
                            @elseif($log->entity_type === 'settings')
                                <span class="text-indigo-600 font-medium">Ajustes</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="log-table-cell text-slate-500">
                            <div class="line-clamp-1">{{ $log->description }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="log-empty-state">
                            No hay registros de actividad
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($logs->hasPages())
        <div class="log-pagination">
            {{ $logs->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-logs');
    const logRows = document.querySelectorAll('.log-table-row');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            logRows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchTerm) ? '' : 'none';
            });
        });
    }
});
</script>
@endpush
@endsection