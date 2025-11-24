@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">🧾 Factura de Venta</h4>
            <a href="{{ route('reportes.factura.pdf', ['id' => $venta->id]) }}" class="btn btn-light btn-sm">
                📄 Descargar PDF
            </a>
        </div>

        <div class="card-body">
            {{-- Encabezado de factura --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5><strong>Ferretería Pico & Pala</strong></h5>
                    <p class="mb-0">NIT: 900.123.456-7</p>
                    <p class="mb-0">Tel: (601) 555-1234</p>
                    <p class="mb-0">Dirección: Calle 123 #45-67, Bogotá</p>
                </div>
                <div class="col-md-6 text-end">
                    <h6><strong>Factura No:</strong> {{ $venta->id }}</h6>
                    <p><strong>Fecha:</strong> {{ $venta->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            {{-- Información del cliente y vendedor --}}
            <div class="mb-4">
                <h6><strong>Cliente:</strong> {{ $venta->nombre_cliente ?? '—' }}</h6>
                <h6><strong>Vendedor:</strong> {{ $venta->usuario->name ?? 'Sin asignar' }}</h6>
            </div>

            {{-- Detalle de productos --}}
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $venta->producto->nombre ?? '—' }}</td>
                        <td>{{ $venta->producto->categoria->nombre ?? '—' }}</td>
                        <td>{{ $venta->cantidad }}</td>
                        <td>${{ number_format(($venta->total / $venta->cantidad), 0, ',', '.') }}</td>
                        <td>${{ number_format($venta->total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Totales --}}
            <div class="text-end mt-4">
                <h5><strong>Total a pagar: </strong>${{ number_format($venta->total, 0, ',', '.') }}</h5>
                <p class="text-muted mb-0">Gracias por su compra 💪</p>
            </div>
        </div>

        <div class="card-footer text-center">
            <a href="{{ route('reportes.index') }}" class="btn btn-secondary">
                ⬅️ Volver a Reportes
            </a>
        </div>
    </div>
</div>
@endsection
