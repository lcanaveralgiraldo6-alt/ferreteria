<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ProveedorController extends Controller
{
    // Listar todos los proveedores (todos pueden ver)
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $proveedores = Proveedor::when($buscar, function ($query, $buscar) {
                $query->where('nombre', 'like', "%{$buscar}%")
                      ->orWhere('telefono', 'like', "%{$buscar}%");
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('proveedores.index', compact('proveedores', 'buscar'));
    }

    // Ver detalles de un proveedor (todos pueden ver)
    public function show(Proveedor $proveedor)
    {
        return view('proveedores.show', compact('proveedor'));
    }

    // Formulario para crear proveedor (solo admin)
    public function create()
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('proveedores.index')
                ->with('error', 'No tienes permiso para crear proveedores.');
        }

        return view('proveedores.create');
    }

    // Guardar nuevo proveedor (solo admin)
    public function store(Request $request): RedirectResponse
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('proveedores.index')
                ->with('error', 'No tienes permiso para crear proveedores.');
        }

        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\pN\s\.\,\-\&\(\)\/#áéíóúÁÉÍÓÚñÑ]+$/u'
            ],
            'nit' => [
                'required',
                'regex:/^[0-9\-]+$/',
                'max:50',
                'unique:proveedores,nit'
            ],
            'telefono' => [
                'required',
                'regex:/^[0-9]{7,15}$/'
            ],
            'email' => [
                'required',
                'email',
                'max:255'
            ],
            'direccion' => [
                'required',
                'string',
                'max:255'
            ],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre puede contener letras, números y caracteres especiales.',
            'nit.required' => 'El NIT es obligatorio.',
            'nit.regex' => 'Ingrese los números del NIT con su dígito de verificación (solo números y guion).',
            'nit.unique' => 'Ya existe un proveedor con este NIT.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono debe contener solo números (7 a 15 dígitos).',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no tiene un formato válido.',
            'direccion.required' => 'La dirección es obligatoria.',
        ]);

        Proveedor::create($request->all());

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor creado correctamente.');
    }

    // Editar proveedor (solo admin)
    public function edit(Proveedor $proveedor)
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('proveedores.index')
                ->with('error', 'No tienes permiso para editar proveedores.');
        }

        return view('proveedores.edit', compact('proveedor'));
    }

    // Actualizar proveedor (solo admin)
    public function update(Request $request, Proveedor $proveedor): RedirectResponse
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('proveedores.index')
                ->with('error', 'No tienes permiso para actualizar proveedores.');
        }

        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\pN\s\.\,\-\&\(\)\/#áéíóúÁÉÍÓÚñÑ]+$/u'
            ],
            'nit' => [
                'required',
                'regex:/^[0-9\-]+$/',
                'max:50',
                'unique:proveedores,nit,' . $proveedor->id
            ],
            'telefono' => [
                'required',
                'regex:/^[0-9]{7,15}$/'
            ],
            'email' => [
                'required',
                'email',
                'max:255'
            ],
            'direccion' => [
                'required',
                'string',
                'max:255'
            ],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre puede contener letras, números y caracteres especiales.',
            'nit.required' => 'El NIT es obligatorio.',
            'nit.regex' => 'Ingrese los números del NIT con su dígito de verificación (solo números y guion).',
            'nit.unique' => 'Ya existe un proveedor con este NIT.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono debe contener solo números (7 a 15 dígitos).',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no tiene un formato válido.',
            'direccion.required' => 'La dirección es obligatoria.',
        ]);

        $proveedor->update($request->all());

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    // Eliminar proveedor (solo admin)
    public function destroy(Proveedor $proveedor): RedirectResponse
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('proveedores.index')
                ->with('error', 'No tienes permiso para eliminar proveedores.');
        }

        $proveedor->delete();

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }
}
