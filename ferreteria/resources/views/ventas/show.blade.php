@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles de Venta #{{ $venta->id }}</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Producto:</strong> {{ $venta->producto->nombre }}</p>
            <p><strong>Empleado:</strong> {{ $venta->usuario->name }}</p>
            <p><strong>Cliente:</strong> {{ $venta->nombre_cliente }}</p>
            <p><strong>Cantidad:</strong> {{ $venta->cantidad }}</p>
            <p><strong>Total:</strong> ${{ number_format($venta->total, 0, ',', '.') }}</p>
            <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
