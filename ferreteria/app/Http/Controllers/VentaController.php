<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    public function index()
    {
        // Todos los usuarios (admin y empleado) pueden ver todas las ventas
        $ventas = Venta::with('producto', 'usuario')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Producto::where('stock', '>', 0)->get();
        return view('ventas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'nombre_cliente' => 'required|string|max:255|regex:/^[\pL\s]+$/u',
        ], [
            'producto_id.required' => 'Por favor selecciona un producto.',
            'producto_id.exists' => 'El producto seleccionado no es válido.',
            'cantidad.required' => 'Por favor ingresa la cantidad.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima es 1.',
            'nombre_cliente.required' => 'El nombre del cliente es obligatorio.',
            'nombre_cliente.regex' => 'El nombre del cliente solo puede contener letras y espacios.',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Si no hay suficiente stock, muestra mensaje una sola vez
        if ($producto->stock < $request->cantidad) {
            return redirect()->route('ventas.create')
                ->with('error', 'No hay suficiente stock disponible.')
                ->withInput();
        }

        $total = $producto->precio * $request->cantidad;

        Venta::create([
            'producto_id' => $producto->id,
            'user_id'     => Auth::id(),
            'cantidad'    => $request->cantidad,
            'total'       => $total,
            'nombre_cliente' => $request->nombre_cliente,
        ]);

        // Actualizar stock
        $producto->decrement('stock', $request->cantidad);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    public function edit(Venta $venta)
    {
        // Solo el admin puede editar
        if (Auth::user()->role_id != 1) {
            return redirect()->route('ventas.index')->with('error', 'No tienes permiso para editar ventas.');
        }

        $productos = Producto::where('stock', '>', 0)->get();
        return view('ventas.edit', compact('venta', 'productos'));
    }

    public function update(Request $request, Venta $venta)
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->route('ventas.index')->with('error', 'No tienes permiso para editar ventas.');
        }

        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'nombre_cliente' => 'required|string|max:255|regex:/^[\pL\s]+$/u',
        ], [
            'producto_id.required' => 'Por favor selecciona un producto.',
            'producto_id.exists' => 'El producto seleccionado no es válido.',
            'cantidad.required' => 'Por favor ingresa la cantidad.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima es 1.',
            'nombre_cliente.required' => 'El nombre del cliente es obligatorio.',
            'nombre_cliente.regex' => 'El nombre del cliente solo puede contener letras y espacios.',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Reajuste de stock: validar que no supere lo disponible
        if ($producto->stock + $venta->cantidad < $request->cantidad) {
            return redirect()->route('ventas.edit', $venta->id)
                ->with('error', 'No hay suficiente stock disponible para este cambio.')
                ->withInput();
        }

        // Reajustar stock correctamente
        $producto->increment('stock', $venta->cantidad);
        $producto->decrement('stock', $request->cantidad);

        $total = $producto->precio * $request->cantidad;

        $venta->update([
            'producto_id' => $producto->id,
            'cantidad' => $request->cantidad,
            'total' => $total,
            'nombre_cliente' => $request->nombre_cliente,
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }
}
