@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Reporte de Campaña</h1>
            <p class="text-slate-500 mt-1">{{ $campaign->name }}</p>
        </div>
        <a href="{{ route('reports.index') }}" class="btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver a reportes
        </a>
    </div>

    <!-- Sección de métricas mejorada -->
    <div class="report-summary">
        <div class="report-metric report-metric-sent">
            <div class="report-metric-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <p class="report-metric-value">{{ $campaign->sent_emails }}</p>
            <p class="report-metric-label">Enviados con éxito</p>
        </div>

        <div class="report-metric report-metric-failed">
            <div class="report-metric-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <p class="report-metric-value">{{ $campaign->failed_emails }}</p>
            <p class="report-metric-label">Fallidos</p>
        </div>

        <div class="report-metric report-metric-total">
            <div class="report-metric-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </div>
            <p class="report-metric-value">{{ $campaign->total_emails }}</p>
            <p class="report-metric-label">Total de correos</p>
        </div>

        <div class="report-metric report-metric-status">
            <div class="report-metric-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="report-metric-value capitalize">{{ $campaign->status }}</p>
            <p class="report-metric-label">Estado</p>
        </div>
    </div>

    <!-- Sección de tabla mejorada -->
    <div class="card">
        <div class="flex justify-between items-center mb-5">
            <h3 class="font-medium text-slate-800">Detalle de envíos</h3>
            <div class="relative w-64">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" placeholder="Buscar email..." class="form-input pl-10" id="search-recipients">
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="detail-table" id="recipients-table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Error</th>
                        <th>Fecha envío</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaign->recipients as $recipient)
                    <tr class="hover:bg-slate-50 recipient-row">
                        <td>{{ $recipient->email }}</td>
                        <td>
                            @if($recipient->status === 'sent')
                                <span class="status-badge bg-emerald-100 text-emerald-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Enviado
                                </span>
                            @elseif($recipient->status === 'failed')
                                <span class="status-badge bg-rose-100 text-rose-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Fallido
                                </span>
                            @else
                                <span class="status-badge bg-slate-100 text-slate-800">
                                    Pendiente
                                </span>
                            @endif
                        </td>
                        <td class="text-slate-500">{{ $recipient->error_message ?: '-' }}</td>
                        <td class="text-slate-500">{{ $recipient->sent_at ? $recipient->sent_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-recipients');
    const recipientRows = document.querySelectorAll('.recipient-row');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            recipientRows.forEach(row => {
                const email = row.querySelector('td:first-child').textContent.toLowerCase();
                row.style.display = email.includes(searchTerm) ? '' : 'none';
            });
        });
    }
});
</script>
@endpush
@endsection