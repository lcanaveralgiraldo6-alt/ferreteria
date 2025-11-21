<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;


class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('role')->orderBy('id', 'asc')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:255'],
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',      // Mayúscula
                'regex:/[a-z]/',      // Minúscula
                'regex:/[0-9]/',      // Número
                'regex:/[@$!%*#?&]/', // Símbolo
            ],
            'role_id' => 'required|exists:roles,id',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo no es válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'Debe incluir al menos una mayúscula, una minúscula, un número y un carácter especial.',
            'role_id.required' => 'El rol es obligatorio.',
            'role_id.exists' => 'El rol seleccionado no es válido.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario)
    {
        $roles = Role::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:255'],
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'role_id' => 'required|exists:roles,id',
            'password' => [
                'nullable',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo no es válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'Debe incluir al menos una mayúscula, una minúscula, un número y un carácter especial.',
            'role_id.required' => 'El rol es obligatorio.',
            'role_id.exists' => 'El rol seleccionado no es válido.',
        ]);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        if ($request->filled('password')) {
            $usuario->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
