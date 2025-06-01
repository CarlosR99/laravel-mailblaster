<div class="max-w-lg space-y-4">
    <div>
        <label class="block mb-1 font-semibold">Nombre</label>
        <input type="text" name="name" class="w-full rounded border-gray-300"
               value="{{ old('name', $user->name ?? '') }}" required>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Email</label>
        <input type="email" name="email" class="w-full rounded border-gray-300"
               value="{{ old('email', $user->email ?? '') }}" required>
    </div>
    <div>
        <label class="block mb-1 font-semibold">
            Contraseña{{ isset($user) && $user ? ' (dejar vacío para no cambiar)' : '' }}
        </label>
        <input type="password" name="password" class="w-full rounded border-gray-300" {{ isset($user) && $user ? '' : 'required' }}>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" class="w-full rounded border-gray-300" {{ isset($user) && $user ? '' : 'required' }}>
    </div>
    <div>
        <label class="block mb-1 font-semibold">Rol</label>
        <select name="role" class="w-full rounded border-gray-300" required>
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