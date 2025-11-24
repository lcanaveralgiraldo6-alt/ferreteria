@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">💵 Listado de Ventas</h2>

    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <a href="{{ route('ventas.create') }}" class="btn btn-success mb-3">➕ Nueva Venta</a>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Fecha</th>
                    @if(Auth::user()->role_id == 1)
                        <th>Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->producto->nombre ?? 'Producto eliminado' }}</td>
                        <td>{{ $venta->cantidad }}</td>
                        <td>${{ number_format($venta->total, 0, ',', '.') }}</td>
                        <td>{{ $venta->nombre_cliente ?? 'No especificado' }}</td>
                        <td>{{ $venta->usuario->name ?? 'N/A' }}</td>
                        <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>

                        @if(Auth::user()->role_id == 1)
                            <td class="text-center">
                                <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">
                                    ✏️ Editar
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $ventas->links() }}
    </div>
</div>
@endsection
