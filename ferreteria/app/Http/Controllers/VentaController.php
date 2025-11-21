<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class VentaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role_id == 1) {
            $ventas = Venta::with('producto', 'usuario')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $ventas = Venta::with('producto', 'usuario')
                ->where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

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

        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.')->withInput();
        }

        $total = $producto->precio * $request->cantidad;

        Venta::create([
            'producto_id' => $producto->id,
            'user_id'     => Auth::id(),
            'cantidad'    => $request->cantidad,
            'total'       => $total,
            'nombre_cliente' => $request->nombre_cliente,
        ]);

        $producto->decrement('stock', $request->cantidad);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    public function show(Venta $venta)
    {
        return view('ventas.show', compact('venta'));
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

        if (Auth::user()->role_id != 1) {
            return redirect()->route('ventas.index')->with('error', 'No tienes permiso para eliminar ventas.');
        }

        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}
