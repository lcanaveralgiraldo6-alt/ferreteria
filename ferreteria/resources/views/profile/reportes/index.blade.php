@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">📊 Panel de Reportes</h1>

    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-warning">{{ $totalProductos }}</h4>
                    <p class="text-muted">Productos Registrados</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-primary">{{ $totalUsuarios }}</h4>
                    <p class="text-muted">Usuarios Totales</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-success">{{ $admins }}</h4>
                    <p class="text-muted">Administradores</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-info">{{ $empleados }}</h4>
                    <p class="text-muted">Empleados</p>
                </div>
            </div>
        </div>
    </div>

    @if(class_exists(\App\Models\Venta::class))
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-3"> Productos más vendidos</h5>
                    <canvas id="productosChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-success">{{ $ventasTotales }}</h4>
                    <p class="text-muted">Ventas Registradas</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(!empty($topProductos))
        const ctx = document.getElementById('productosChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topProductos->pluck('nombre')) !!},
                datasets: [{
                    label: 'Cantidad Vendida',
                    data: {!! json_encode($topProductos->pluck('cantidad')) !!},
                    backgroundColor: '#fdd835',
                    borderColor: '#1a1a1a',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    @endif
</script>
@endsection
