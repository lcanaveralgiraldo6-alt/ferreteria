@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Título -->
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">{{ $titulo }}</h1>
        <h5 class="text-muted">Bienvenido, {{ $usuario->name }}</h5>
        
        @if($productos_bajo_stock->count() > 0)
    <div class="alert alert-warning mt-3">
        <strong>⚠ Atención:</strong> Algunos productos tienen menos de 5 unidades en stock:
        <ul class="mb-0">
            @foreach($productos_bajo_stock as $p)
                <li>{{ $p->nombre }} (Stock: {{ $p->stock }})</li>
            @endforeach
        </ul>
    </div>
@endif

    </div>

    <!-- Estadísticas principales -->
    <div class="row justify-content-center g-4 text-center">
        <!-- Productos -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Productos</h5>
                    <h2 class="fw-bold text-dark">{{ $totalProductos }}</h2>
                    <p class="text-muted mb-0">Registrados</p>
                </div>
            </div>
        </div>

        <!-- Categorías -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Categorías</h5>
                    <h2 class="fw-bold text-dark">{{ $totalCategorias }}</h2>
                    <p class="text-muted mb-0">Disponibles</p>
                </div>
            </div>
        </div>

        <!-- Usuarios (solo si es admin) -->
        @if(isset($totalUsuarios))
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Usuarios</h5>
                    <h2 class="fw-bold text-dark">{{ $totalUsuarios }}</h2>
                    <p class="text-muted mb-0">Activos</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Ventas -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Ventas</h5>
                    <h2 class="fw-bold text-dark">{{ $totalVentas }}</h2>
                    <p class="text-muted mb-0">Realizadas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensaje motivacional -->
    <div class="mt-5 text-center">
        <p class="text-muted">
            Mantén el control total de tus productos, ventas y categorías desde este panel.
        </p>
    </div>
</div>
@endsection
