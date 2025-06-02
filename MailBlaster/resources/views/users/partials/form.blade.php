<div class="space-y-5">
    <div>
        <label class="form-label">Nombre completo</label>
        <input type="text" name="name" class="form-input"
               value="{{ old('name', $user->name ?? '') }}"
               placeholder="Ej: Juan Pérez" required>
    </div>
    
    <div>
        <label class="form-label">Correo electrónico</label>
        <input type="email" name="email" class="form-input"
               value="{{ old('email', $user->email ?? '') }}"
               placeholder="Ej: usuario@dominio.com" required>
    </div>
    
    <div>
        <label class="form-label">
            Contraseña{{ isset($user) && $user ? ' (dejar vacío para no cambiar)' : '' }}
        </label>
        <input type="password" name="password" class="form-input"
               placeholder="••••••••" {{ isset($user) && $user ? '' : 'required' }}>
        <div class="password-strength mt-1 hidden"></div>
    </div>
    
    <div>
        <label class="form-label">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" class="form-input"
               placeholder="••••••••" {{ isset($user) && $user ? '' : 'required' }}>
    </div>
    
    <div>
        <label class="form-label">Rol del usuario</label>
        <select name="role" class="form-select" required>
            <option value="">Seleccione un rol</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}"
                    @if(old('role', isset($user) && $user ? $user->roles->first()->name ?? '' : '') == $role->name) selected @endif>
                    {{ ucfirst($role->name) }}
                </option>
            @endforeach
        </select>
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