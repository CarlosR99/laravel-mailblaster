@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Gestión de Campañas</h1>
            <p class="text-slate-500 mt-1">Lista de todas las campañas de marketing</p>
        </div>
        <a href="{{ route('campaigns.create') }}" class="btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Nueva campaña
        </a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="table-header px-5 py-3">Nombre</th>
                        <th class="table-header px-5 py-3">Plantilla</th>
                        <th class="table-header px-5 py-3">Total emails</th>
                        <th class="table-header px-5 py-3">Estado</th>
                        <th class="table-header px-5 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaigns as $campaign)
                    <tr class="table-row">
                        <td class="table-cell font-medium">{{ $campaign->name }}</td>
                        <td class="table-cell">
                            @if(is_object($campaign->template) && $campaign->template)
                                {{ $campaign->template->name }}
                            @elseif(!empty($campaign->template) && is_string($campaign->template))
                                {{ $campaign->template }}
                            @elseif($campaign->image_path)
                                <span class="badge badge-scheduled">Imagen personalizada</span>
                            @else
                                <span class="badge badge-completed">Sin plantilla</span>
                            @endif
                        </td>
                        <td class="table-cell">{{ $campaign->total_emails }}</td>
                        <td class="table-cell">
                            @if($campaign->status === 'active')
                                <span class="status-badge bg-emerald-100 text-emerald-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Activa
                                </span>
                            @elseif($campaign->status === 'completed')
                                <span class="status-badge bg-blue-100 text-blue-800">Completada</span>
                            @else
                                <span class="status-badge bg-amber-100 text-amber-800">{{ ucfirst($campaign->status) }}</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            <a href="{{ route('campaigns.report', $campaign) }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Reporte
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