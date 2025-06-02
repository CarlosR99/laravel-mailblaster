<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TrixUploadController;

// Redirige la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Dashboard general protegido (todos los autenticados)
Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Dashboard admin explícito (solo admin debería ver este enlace)
Route::middleware(['auth', 'can:user.manage'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// Configuración de usuario autenticado (Livewire)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', \App\Livewire\Settings\Profile::class)->name('settings.profile');
    Route::get('settings/password', \App\Livewire\Settings\Password::class)->name('settings.password');
    Route::get('settings/appearance', \App\Livewire\Settings\Appearance::class)->name('settings.appearance');
});

// Rutas para campañas y plantillas (publicista y admin)
Route::middleware(['auth'])->group(function () {
    // Campañas
    Route::get('/campanas', [CampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/campanas/crear', [CampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/campanas', [CampaignController::class, 'store'])->name('campaigns.store');
    Route::get('/campanas/{campaign}/reporte', [CampaignController::class, 'report'])->name('campaigns.report');
    Route::get('/campanas/{campaign}/editar', [CampaignController::class, 'edit'])->name('campaigns.edit');
    Route::put('/campanas/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');

    // Plantillas
    Route::get('/plantillas', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/plantillas/crear', [TemplateController::class, 'create'])->name('templates.create');
    Route::post('/plantillas', [TemplateController::class, 'store'])->name('templates.store');
    Route::get('/plantillas/{template}/editar', [TemplateController::class, 'edit'])->name('templates.edit');
    Route::put('/plantillas/{template}', [TemplateController::class, 'update'])->name('templates.update');
    Route::put('/plantillas/{template}/deshabilitar', [TemplateController::class, 'disable'])->name('templates.disable');
    Route::put('/plantillas/{template}/habilitar', [TemplateController::class, 'enable'])->name('templates.enable');
});

// Rutas solo para administrador (protege con 'can:user.manage')
Route::middleware(['auth', 'can:user.manage'])->group(function () {
    // Usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('users.store');
    Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('users.update');
    Route::put('/usuarios/{user}/deshabilitar', [UserController::class, 'disable'])->name('users.disable');
    Route::put('/usuarios/{user}/activar', [UserController::class, 'enable'])->name('users.enable');

    // Reportes
    Route::get('/reportes', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reportes/{id}', [ReportController::class, 'show'])->name('reports.show');

    // Registros (logs)
    Route::get('/registros', [\App\Http\Controllers\LogController::class, 'index'])->name('logs.index');
});

// Rutas para la carga de archivos Trix (si aplica a ambos roles)
Route::post('/trix-upload', [TrixUploadController::class, 'store'])->name('trix.upload');

// Rutas para ajustes de la aplicación
Route::middleware(['auth'])->group(function () {
    Route::get('/ajustes', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/ajustes', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
