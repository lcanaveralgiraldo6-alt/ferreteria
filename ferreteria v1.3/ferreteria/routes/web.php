<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProveedorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se definen todas las rutas principales del sistema Pico & Pala.
| La página inicial redirige al login.
|
*/

// 🔐 Página principal → Login
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔐 Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // 📊 DASHBOARD (accesible para todos los usuarios logueados)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 👑 ADMIN — puede hacer TODO
    Route::resource('productos', ProductoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('proveedores', ProveedorController::class)->parameters([
        'proveedores' => 'proveedor' // 🩹 Corrige el error "Missing parameter: proveedore"
    ]);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('ventas', VentaController::class);

    // 📈 Reportes (solo admin)
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/pdf', [ReporteController::class, 'generarPDF'])->name('reportes.pdf');
    Route::get('/reportes/factura/{id}', [ReporteController::class, 'factura'])->name('reportes.factura');

    // 🧾 Nueva ruta — Descargar factura individual en PDF
    Route::get('/reportes/factura/{id}/pdf', [ReporteController::class, 'facturaPDF'])->name('reportes.factura.pdf');

    // 👷 EMPLEADO — solo puede acceder a ciertas secciones
    Route::middleware(['empleado'])->group(function () {
        Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');
        Route::get('categorias', [CategoriaController::class, 'index'])->name('categorias.index');
        Route::get('proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
        Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
        Route::resource('ventas', VentaController::class)->only(['index', 'create', 'store']);
    });
});

require __DIR__ . '/auth.php';
