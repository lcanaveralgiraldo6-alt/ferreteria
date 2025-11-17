@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📊 Reportes de Ventas</h1>

    {{-- Filtros por fecha --}}
    <form method="GET" action="{{ route('reportes.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="fecha_inicio" class="form-label">Desde:</label>
            <input 
                type="date" 
                id="fecha_inicio" 
                name="fecha_inicio" 
                value="{{ request('fecha_inicio') }}" 
                min="{{ now()->subYear()->toDateString() }}" 
                max="{{ now()->toDateString() }}" 
                class="form-control">
        </div>
        <div class="col-md-4">
            <label for="fecha_fin" class="form-label">Hasta:</label>
            <input 
                type="date" 
                id="fecha_fin" 
                name="fecha_fin" 
                value="{{ request('fecha_fin') }}" 
                max="{{ now()->toDateString() }}" 
                class="form-control">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary me-2">Filtrar</button>
            <a href="{{ route('reportes.index') }}" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    {{-- Totales --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <strong>Total vendido:</strong> ${{ number_format($totalVentas, 0, ',', '.') }}<br>
            <strong>Cantidad total:</strong> {{ $cantidadProductos }}
        </div>
        <div>
            <a href="{{ route('reportes.pdf', request()->all()) }}" class="btn btn-success">
                📄 Descargar reporte PDF
            </a>
        </div>
    </div>

    {{-- Tabla de ventas --}}
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th>Fecha</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Usuario</th>
                <th>Factura</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventas as $venta)
                <tr class="text-center">
                    <td>{{ $venta->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $venta->producto->nombre ?? '—' }}</td>
                    <td>{{ $venta->cantidad }}</td>
                    <td>${{ number_format($venta->total, 0, ',', '.') }}</td>
                    <td>{{ $venta->usuario->name ?? 'Sin usuario' }}</td>
                    <td>
                        {{-- Ver factura individual --}}
                        <a href="{{ route('reportes.factura', ['id' => $venta->id]) }}" 
                           class="btn btn-outline-primary btn-sm">
                            🧾 Ver Factura
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No hay registros en este rango de fechas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- 🔒 Lógica para restringir fechas --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const desde = document.getElementById('fecha_inicio');
    const hasta = document.getElementById('fecha_fin');

    // Cuando cambie la fecha "Desde", actualiza el mínimo permitido en "Hasta"
    desde.addEventListener('change', function () {
        hasta.min = desde.value;
    });

    // Si hay un valor precargado en "Desde" (por filtros previos)
    if (desde.value) {
        hasta.min = desde.value;
    }
});
</script>
@endsection
