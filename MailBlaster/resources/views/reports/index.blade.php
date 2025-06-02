@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Reportes de Campañas</h1>
            <p class="text-slate-500 mt-1">Resumen del desempeño de tus campañas</p>
        </div>
        <div class="flex items-center">
            <a href="{{ route('campaigns.index') }}" class="btn-outline mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                Ver campañas
            </a>
        </div>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="table-header px-5 py-3">Campaña</th>
                        <th class="table-header px-5 py-3 text-center">Enviados</th>
                        <th class="table-header px-5 py-3 text-center">Fallidos</th>
                        <th class="table-header px-5 py-3 text-center">Total</th>
                        <th class="table-header px-5 py-3">Estado</th>
                        <th class="table-header px-5 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaigns as $campaign)
                    <tr class="table-row">
                        <td class="table-cell font-medium">
                            <div class="flex items-center">
                                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </div>
                                {{ $campaign->name }}
                            </div>
                        </td>
                        <td class="table-cell text-center">
                            <span class="font-medium text-emerald-600">{{ $campaign->sent_emails }}</span>
                        </td>
                        <td class="table-cell text-center">
                            <span class="font-medium text-rose-600">{{ $campaign->failed_emails }}</span>
                        </td>
                        <td class="table-cell text-center">
                            <span class="font-medium text-indigo-600">{{ $campaign->total_emails }}</span>
                        </td>
                        <td class="table-cell">
                            @if($campaign->status === 'completed')
                                <span class="status-badge bg-blue-100 text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Completada
                                </span>
                            @elseif($campaign->status === 'active')
                                <span class="status-badge bg-emerald-100 text-emerald-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    Activa
                                </span>
                            @else
                                <span class="status-badge bg-amber-100 text-amber-800">
                                    {{ ucfirst($campaign->status) }}
                                </span>
                            @endif
                        </td>
                        <td class="table-cell text-right">
                            <a href="{{ route('reports.show', $campaign) }}" class="text-indigo-600 hover:text-indigo-800 flex items-center justify-end">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Ver detalle
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection