@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Título -->
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">{{ $titulo }}</h1>
        <h5 class="text-muted">Bienvenido, {{ $usuario->name }}</h5>
    </div>

    <!-- Estadísticas principales -->
    <div class="row g-4">
        <!-- Productos -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Productos</h5>
                    <h2 class="fw-bold text-dark">{{ $totalProductos }}</h2>
                    <p class="text-muted mb-0">Registrados</p>
                </div>
            </div>
        </div>

        <!-- Categorías -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Categorías</h5>
                    <h2 class="fw-bold text-dark">{{ $totalCategorias }}</h2>
                    <p class="text-muted mb-0">Disponibles</p>
                </div>
            </div>
        </div>

        <!-- Proveedores -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Proveedores</h5>
                    <h2 class="fw-bold text-dark">{{ $totalProveedores }}</h2>
                    <p class="text-muted mb-0">Registrados</p>
                </div>
            </div>
        </div>

        <!-- Ventas -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Ventas</h5>
                    <h2 class="fw-bold text-dark">{{ $totalVentas }}</h2>
                    <p class="text-muted mb-0">Realizadas</p>
                </div>
            </div>
        </div>

        <!-- Usuarios (solo si es admin) -->
        @if(isset($totalUsuarios))
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Usuarios</h5>
                    <h2 class="fw-bold text-dark">{{ $totalUsuarios }}</h2>
                    <p class="text-muted mb-0">Activos</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Mensaje motivacional -->
    <div class="mt-5 text-center">
        <p class="text-muted">
            Mantén el control total de tus productos, ventas, proveedores y categorías desde este panel.
        </p>
    </div>
</div>
@endsection
