@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Reporte de Campaña</h1>
            <p class="text-slate-500 mt-1">{{ $campaign->name }}</p>
        </div>
        <a href="{{ route('campaigns.index') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="stat-card">
            <div class="text-emerald-500 mx-auto mb-3 bg-emerald-100 p-2 rounded-full w-12 h-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <p class="text-slate-500 text-sm">Enviados con éxito</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ $campaign->sent_emails }}</p>
        </div>
        
        <div class="stat-card">
            <div class="text-rose-500 mx-auto mb-3 bg-rose-100 p-2 rounded-full w-12 h-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <p class="text-slate-500 text-sm">Fallidos</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ $campaign->failed_emails }}</p>
        </div>
        
        <div class="stat-card">
            <div class="text-indigo-500 mx-auto mb-3 bg-indigo-100 p-2 rounded-full w-12 h-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </div>
            <p class="text-slate-500 text-sm">Total de correos</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ $campaign->total_emails }}</p>
        </div>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="table-header px-5 py-3">Email</th>
                        <th class="table-header px-5 py-3">Estado</th>
                        <th class="table-header px-5 py-3">Error</th>
                        <th class="table-header px-5 py-3">Enviado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recipients as $recipient)
                    <tr class="table-row">
                        <td class="table-cell">{{ $recipient->email }}</td>
                        <td class="table-cell">
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
                                <span class="status-badge bg-slate-100 text-slate-800">Pendiente</span>
                            @endif
                        </td>
                        <td class="table-cell text-sm text-slate-500">{{ $recipient->error_message ?: '-' }}</td>
                        <td class="table-cell text-sm text-slate-500">{{ $recipient->sent_at ? $recipient->sent_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection