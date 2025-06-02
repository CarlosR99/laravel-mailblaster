<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Listar usuarios
    public function index(Request $request)
    {
        $query = User::query()->with('roles');
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhereHas('roles', function($qr) use ($search) {
                      $qr->where('name', 'like', "%$search%");
                  });
            });
        }
        $users = $query->orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'active' => true,
        ]);
        $user->assignRole($validated['role']);

        // Log de creación
        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'user',
            'entity_id' => $user->id,
            'action' => 'created',
            'description' => 'Usuario creado: ' . $user->email,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|confirmed|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
        $user->syncRoles([$validated['role']]);
        $user->save();

        // Log de actualización
        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'user',
            'entity_id' => $user->id,
            'action' => 'updated',
            'description' => 'Usuario actualizado: ' . $user->email,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Deshabilitar usuario (soft delete)
    public function disable(User $user)
    {
        $user->active = false;
        $user->save();

        // Log de deshabilitar
        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'user',
            'entity_id' => $user->id,
            'action' => 'disabled',
            'description' => 'Usuario deshabilitado: ' . $user->email,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario deshabilitado correctamente.');
    }

    // Habilitar usuario
    public function enable(User $user)
    {
        $user->active = true;
        $user->save();

        // Log de habilitar
        SystemLog::create([
            'user_id' => auth()->id(),
            'entity_type' => 'user',
            'entity_id' => $user->id,
            'action' => 'enabled',
            'description' => 'Usuario habilitado: ' . $user->email,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario activado correctamente.');
    }
}
