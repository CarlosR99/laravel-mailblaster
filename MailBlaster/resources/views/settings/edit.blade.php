@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Ajustes de Perfil</h1>
            <p class="text-slate-500 mt-1">Actualiza tu información personal</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-800 px-4 py-3 rounded-lg mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('settings.update') }}" class="settings-form">
            @csrf
            @method('PUT')
            
            <div class="settings-input-group">
                <label class="form-label">Nombre completo</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="form-input" required>
            </div>
            
            <div class="settings-input-group">
                <label class="form-label">Correo electrónico</label>
                <input type="email" value="{{ $user->email }}" 
                       class="form-input settings-disabled-input" disabled>
                <p class="text-sm text-slate-500 mt-1">Para cambiar tu email, contacta al administrador</p>
            </div>
            
            <div class="settings-input-group">
                <label class="form-label">Nueva contraseña</label>
                <input type="password" name="password" 
                       class="form-input" placeholder="Dejar vacío para no cambiar">
                <div class="password-strength hidden mt-1"></div>
            </div>
            
            <div class="settings-input-group">
                <label class="form-label">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" 
                       class="form-input" placeholder="Repite la nueva contraseña">
            </div>
            
            <div class="flex justify-end pt-4 border-t border-slate-100 mt-6">
                <button type="submit" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.querySelector('input[name="password"]');
    const strengthBar = document.querySelector('.password-strength');
    
    if (passwordInput && strengthBar) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            strengthBar.classList.remove('hidden');
            
            // Calcular fortaleza
            let strength = 0;
            if (password.length > 0) strength += 1;
            if (password.length >= 8) strength += 1;
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            // Actualizar barra
            strengthBar.className = 'password-strength mt-1';
            if (password.length === 0) {
                strengthBar.classList.add('hidden');
            } else if (strength <= 2) {
                strengthBar.classList.add('password-strength-weak');
            } else if (strength <= 4) {
                strengthBar.classList.add('password-strength-medium');
            } else {
                strengthBar.classList.add('password-strength-strong');
            }
        });
    }
});
</script>
@endpush
@endsection