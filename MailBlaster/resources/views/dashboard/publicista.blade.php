@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Panel de Publicista</h1>
            <p class="text-slate-500 mt-1">Resumen de tus campañas y plantillas</p>
        </div>
    </div>
    
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="stat-card">
            <div class="text-indigo-500 mx-auto mb-3 bg-indigo-100 p-2 rounded-full w-12 h-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <p class="text-slate-500 text-sm">Tus campañas activas</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ $myActiveCampaigns }}</p>
        </div>
        
        <div class="stat-card">
            <div class="text-emerald-500 mx-auto mb-3 bg-emerald-100 p-2 rounded-full w-12 h-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="text-slate-500 text-sm">Tus correos enviados</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ $mySentEmails }}</p>
        </div>
        
        <div class="stat-card">
            <div class="text-blue-500 mx-auto mb-3 bg-blue-100 p-2 rounded-full w-12 h-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                </svg>
            </div>
            <p class="text-slate-500 text-sm">Plantillas activas</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ $activeTemplates }}</p>
        </div>
    </div>
    
    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Campañas Recientes -->
        <div class="card">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-semibold">Tus campañas recientes</h2>
                <a href="{{ route('campaigns.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                    Ver todas
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            <div class="space-y-4">
                @forelse($myCampaigns as $campaign)
                <div class="border-l-3 border-indigo-500 pl-4 py-2">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-medium text-slate-800">{{ $campaign->name }}</h3>
                            <p class="text-sm text-slate-500 mt-1">
                                {{ $campaign->created_at->format('d M, Y') }} • 
                                <span class="font-medium">{{ $campaign->sent_emails }} enviados</span>
                            </p>
                        </div>
                        <span class="badge badge-{{ $campaign->status === 'finished' ? 'completed' : 'active' }}">
                            {{ $campaign->status === 'finished' ? 'Completada' : ucfirst($campaign->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-slate-400">No tienes campañas recientes.</p>
                @endforelse
            </div>
            
            <a href="{{ route('campaigns.create') }}" class="btn-outline mt-5 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nueva campaña
            </a>
        </div>

        <!-- Plantillas Info -->
        <div class="card">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-semibold">Plantillas activas</h2>
                <a href="{{ route('templates.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                    Ver todas
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <p class="text-slate-500 mb-2">Puedes gestionar y crear nuevas plantillas para tus campañas.</p>
            <a href="{{ route('templates.create') }}" class="btn-outline mt-2 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nueva plantilla
            </a>
        </div>
    </div>
</div>
@endsection