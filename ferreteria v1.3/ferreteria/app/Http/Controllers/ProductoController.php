<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ProductoController extends Controller
{
    // 📋 Mostrar lista de productos (todos pueden ver)
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $productos = Producto::with(['categoria', 'proveedor'])
            ->when($buscar, function ($query, $buscar) {
                $query->where('nombre', 'like', "%{$buscar}%")
                    ->orWhereHas('categoria', function ($q) use ($buscar) {
                        $q->where('nombre', 'like', "%{$buscar}%");
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('productos.index', compact('productos'));
    }

    // 👀 Ver detalles de un producto (todos pueden ver)
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    // 🧰 Formulario de creación (solo admin)
    public function create()
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('productos.index')
                ->with('error', 'No tienes permiso para crear productos.');
        }

        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.create', compact('categorias', 'proveedores'));
    }

    // 💾 Guardar producto nuevo (solo admin)
    public function store(Request $request): RedirectResponse
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('productos.index')
                ->with('error', 'No tienes permiso para crear productos.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'descripcion.required' => 'La descripción del producto es obligatoria.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    // ✏️ Formulario de edición (solo admin)
    public function edit(Producto $producto)
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('productos.index')
                ->with('error', 'No tienes permiso para editar productos.');
        }

        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    // 🔁 Actualizar producto (solo admin)
    public function update(Request $request, Producto $producto): RedirectResponse
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('productos.index')
                ->with('error', 'No tienes permiso para actualizar productos.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'descripcion.required' => 'La descripción del producto es obligatoria.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    // 🗑️ Eliminar producto (solo admin)
    public function destroy(Producto $producto): RedirectResponse
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('productos.index')
                ->with('error', 'No tienes permiso para eliminar productos.');
        }

        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
