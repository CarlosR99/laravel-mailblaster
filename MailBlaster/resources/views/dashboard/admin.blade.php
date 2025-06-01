@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Panel de Administrador</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="stat-card">
            <p class="text-gray-500 dark:text-gray-400">Campañas activas</p>
            <p class="text-2xl font-bold">12</p>
            <p class="text-sm text-green-500">↑ 2.5% desde el mes pasado</p>
        </div>
        
        <div class="stat-card">
            <p class="text-gray-500 dark:text-gray-400">Correos enviados</p>
            <p class="text-2xl font-bold">1,234</p>
            <p class="text-sm text-green-500">↑ 12.3% desde ayer</p>
        </div>
        
        <div class="stat-card">
            <p class="text-gray-500 dark:text-gray-400">Usuarios registrados</p>
            <p class="text-2xl font-bold">8</p>
            <p class="text-sm text-blue-500">↑ 3 nuevos (últimos 7 días)</p>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Campañas recientes -->
        <div class="card">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Campañas recientes</h2>
                <button class="text-blue-500 hover:text-blue-700">Ver todas</button>
            </div>
            
            <div class="space-y-3">
                <div class="border-l-4 border-green-500 pl-3 py-1">
                    <div class="flex justify-between">
                        <h3 class="font-medium">Campaña de Verano 2024</h3>
                        <span class="badge badge-active">Activa</span>
                    </div>
                    <p class="text-sm text-gray-500">05/06/2024 - 1,234 enviados</p>
                </div>
                
                <div class="border-l-4 border-blue-500 pl-3 py-1">
                    <div class="flex justify-between">
                        <h3 class="font-medium">Oferta Especial Mayo</h3>
                        <span class="badge badge-completed">Completada</span>
                    </div>
                    <p class="text-sm text-gray-500">02/06/2024 - 987 enviados</p>
                </div>
                
                <div class="border-l-4 border-yellow-500 pl-3 py-1">
                    <div class="flex justify-between">
                        <h3 class="font-medium">Newsletter Abril</h3>
                        <span class="badge badge-scheduled">Programada</span>
                    </div>
                    <p class="text-sm text-gray-500">28/05/2024 - 2,045 enviados</p>
                </div>
            </div>
            
            <button class="mt-4 w-full py-2 border border-dashed border-gray-300 rounded text-gray-500 hover:border-blue-500 hover:text-blue-500">
                + Nueva campaña
            </button>
        </div>
        
        <!-- Resumen de usuarios -->
        <div class="card">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Resumen de usuarios</h2>
                <button class="text-blue-500 hover:text-blue-700">Gestionar</button>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-gray-100 dark:bg-gray-700 rounded p-3 text-center">
                    <p class="text-xl font-bold text-indigo-600">2</p>
                    <p class="text-sm">Administradores</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 rounded p-3 text-center">
                    <p class="text-xl font-bold text-green-600">4</p>
                    <p class="text-sm">Publicistas</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 rounded p-3 text-center">
                    <p class="text-xl font-bold text-blue-600">2</p>
                    <p class="text-sm">Invitados</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 rounded p-3 text-center">
                    <p class="text-xl font-bold text-purple-600">8</p>
                    <p class="text-sm">Total</p>
                </div>
            </div>
            
            <h3 class="font-medium mb-3">Actividad reciente</h3>
            <div class="space-y-3">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                        <span class="text-indigo-800 text-xs">MJ</span>
                    </div>
                    <div>
                        <p class="font-medium">María Jiménez</p>
                        <p class="text-sm text-gray-500">Creada nueva campaña</p>
                    </div>
                    <span class="ml-auto text-xs text-gray-500">2h</span>
                </div>
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <span class="text-green-800 text-xs">CR</span>
                    </div>
                    <div>
                        <p class="font-medium">Carlos Ruiz</p>
                        <p class="text-sm text-gray-500">Actualizó plantilla</p>
                    </div>
                    <span class="ml-auto text-xs text-gray-500">5h</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection