<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductoController,
    CategoriaController,
    UsuarioController,
    VentaController,
    ReporteController,
    DashboardController,
    ProveedorController
};

// Página principal → Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // DASHBOARD (todos los usuarios logueados)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Recursos principales
    Route::resource('productos', ProductoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('proveedores', ProveedorController::class)->parameters([
        'proveedores' => 'proveedor'
    ]);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('ventas', VentaController::class);

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/pdf', [ReporteController::class, 'generarPDF'])->name('reportes.pdf');
    Route::get('/reportes/factura/{id}', [ReporteController::class, 'factura'])->name('reportes.factura');
    Route::get('/reportes/factura/{id}/pdf', [ReporteController::class, 'facturaPDF'])->name('reportes.factura.pdf');
});

require __DIR__ . '/auth.php';
