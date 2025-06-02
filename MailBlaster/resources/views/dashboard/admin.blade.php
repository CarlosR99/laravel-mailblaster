@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Panel de Administración</h1>
            <p class="text-slate-500 mt-1">Resumen de actividad y métricas clave</p>
        </div>
    </div>
    
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
        <div class="stat-card">
            <div class="text-indigo-500 mx-auto mb-3 bg-indigo-100 p-2 rounded-full w-12 h-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <p class="text-slate-500 text-sm">Campañas activas</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ $activeCampaigns }}</p>
        </div>
        
        <div class="stat-card">
            <div class="text-emerald-500 mx-auto mb-3 bg-emerald-100 p-2 rounded-full w-12 h-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="text-slate-500 text-sm">Correos enviados</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ $sentEmails }}</p>
        </div>
        
        <div class="stat-card">
            <div class="text-amber-500 mx-auto mb-3 bg-amber-100 p-2 rounded-full w-12 h-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <p class="text-slate-500 text-sm">Usuarios registrados</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ $usersCount }}</p>
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
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Campañas Recientes -->
        <div class="card">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-semibold">Campañas recientes</h2>
                <a href="{{ route('campaigns.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                    Ver todas
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            <div class="space-y-4">
                @foreach($recentCampaigns as $campaign)
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
                @endforeach
            </div>
            
            <a href="{{ route('campaigns.create') }}" class="btn-outline mt-5 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nueva campaña
            </a>
        </div>

        <!-- Plantillas Recientes -->
        <div class="card">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-semibold">Plantillas recientes</h2>
                <a href="{{ route('templates.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                    Ver todas
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            <div class="space-y-4">
                @foreach($recentTemplates as $template)
                <div class="flex items-start">
                    <div class="bg-indigo-50 p-2 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-medium text-slate-800">{{ $template->name }}</h3>
                        <p class="text-sm text-slate-500 mt-1">
                            Actualizada: {{ $template->updated_at->format('d M, Y') }}
                        </p>
                    </div>
                    <span class="badge badge-{{ $template->active ? 'active' : 'completed' }}">
                        {{ $template->active ? 'Activa' : 'Inactiva' }}
                    </span>
                </div>
                @endforeach
            </div>
            
            <a href="{{ route('templates.create') }}" class="btn-outline mt-5 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nueva plantilla
            </a>
        </div>

        <!-- Resumen de Usuarios -->
        <div class="card">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-semibold">Resumen de usuarios</h2>
                <a href="{{ route('users.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                    Gestionar
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-slate-50 rounded-lg p-4 text-center border border-slate-100">
                    <p class="text-2xl font-bold text-indigo-600">{{ $adminsCount }}</p>
                    <p class="text-sm text-slate-500 mt-1">Administradores</p>
                </div>
                <div class="bg-slate-50 rounded-lg p-4 text-center border border-slate-100">
                    <p class="text-2xl font-bold text-emerald-600">{{ $publicistasCount }}</p>
                    <p class="text-sm text-slate-500 mt-1">Publicistas</p>
                </div>
            </div>
            
            <h3 class="font-semibold mb-4">Actividad reciente</h3>
            <div class="space-y-4">
                @foreach($recentLogs as $log)
                <div class="flex items-center">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                        <span class="text-indigo-800 font-medium text-xs">
                            {{ strtoupper(substr($log->user->name ?? '?', 0, 2)) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-800 truncate">{{ $log->user->name ?? '-' }}</p>
                        <p class="text-sm text-slate-500 truncate">
                            @if($log->entity_type === 'campaign')
                                Campaña
                            @elseif($log->entity_type === 'user')
                                Usuario
                            @elseif($log->entity_type === 'template')
                                Plantilla
                            @else
                                Sistema
                            @endif
                            • {{ ucfirst($log->action) }}
                        </p>
                    </div>
                    <span class="text-xs text-slate-400 whitespace-nowrap ml-2">
                        {{ $log->created_at->diffForHumans() }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection