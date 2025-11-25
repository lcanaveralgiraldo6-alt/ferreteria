<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Venta;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        $totalUsuarios = User::count();
        $totalVentas = Venta::count();
        $totalProveedores = Proveedor::count();

        $productos_bajo_stock = Producto::where('stock', '<', 5)->get();

        if ($usuario->role_id == 2) {
            return view('dashboard', [
                'titulo' => 'Panel de Empleado - Pico & Pala',
                'totalProductos' => $totalProductos,
                'totalCategorias' => $totalCategorias,
                'totalProveedores' => $totalProveedores,
                'totalVentas' => $totalVentas,
                'usuario' => $usuario,
                'productos_bajo_stock' => $productos_bajo_stock,
            ]);
        }

        return view('dashboard', [
            'titulo' => 'Panel Administrativo de Control de Inventario',
            'totalProductos' => $totalProductos,
            'totalCategorias' => $totalCategorias,
            'totalUsuarios' => $totalUsuarios,
            'totalProveedores' => $totalProveedores,
            'totalVentas' => $totalVentas,
            'usuario' => $usuario,
            'productos_bajo_stock' => $productos_bajo_stock,
        ]);
    }
}
