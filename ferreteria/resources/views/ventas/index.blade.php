@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">💵 Listado de Ventas</h2>

    {{-- 🔥 Eliminado el bloque de mensajes duplicados porque ya se muestran en app.blade.php --}}

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
                    <th>Cliente</th> {{-- ✅ Nueva columna --}}
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
                        <td>{{ $venta->nombre_cliente ?? 'No especificado' }}</td> {{-- ✅ Mostramos nombre cliente --}}
                        <td>{{ $venta->usuario->name ?? 'N/A' }}</td>
                        <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>

                        @if(Auth::user()->role_id == 1)
                            <td class="text-center">
                                <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta venta?')">
                                        🗑️ Eliminar
                                    </button>
                                </form>
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
