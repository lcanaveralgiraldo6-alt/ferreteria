<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u',
                'max:50',
                'unique:categorias,nombre',
            ],
            'descripcion' => ['required', 'string', 'max:255'],
        ], [
            'nombre.required' => ' El nombre de la categoría es obligatorio.',
            'nombre.regex' => ' El nombre solo puede contener letras y espacios.',
            'nombre.max' => ' El nombre no puede tener más de 50 caracteres.',
            'nombre.unique' => ' Ya existe una categoría con ese nombre.',
            'descripcion.required' => ' La descripción es obligatoria.',
            'descripcion.max' => ' La descripción no puede superar los 255 caracteres.',
        ]);

        Categoria::create($validated);

        return redirect()->route('categorias.index')->with('success', '✅ Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u',
                'max:50',
                'unique:categorias,nombre,' . $categoria->id,
            ],
            'descripcion' => ['required', 'string', 'max:255'],
        ], [
            'nombre.required' => ' El nombre de la categoría es obligatorio.',
            'nombre.regex' => ' El nombre solo puede contener letras y espacios.',
            'nombre.max' => ' El nombre no puede tener más de 50 caracteres.',
            'nombre.unique' => ' Ya existe una categoría con ese nombre.',
            'descripcion.required' => ' La descripción es obligatoria.',
            'descripcion.max' => ' La descripción no puede superar los 255 caracteres.',
        ]);

        $categoria->update($validated);

        return redirect()->route('categorias.index')->with('success', '✏️ Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', '🗑️ Categoría eliminada correctamente.');
    }
}
