@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Gestión de Productos</h2>

    <!-- Botón para agregar producto (visible para todos) -->
    <a href="{{ route('productos.create') }}" class="btn btn-success mb-3">➕ Nuevo Producto</a>

    <!-- Buscador -->
    <form method="GET" action="{{ route('productos.index') }}" class="mb-4 d-flex" style="max-width: 500px;">
        <input 
            type="text" 
            name="buscar" 
            class="form-control me-2" 
            placeholder="Buscar por nombre o categoría..." 
            value="{{ request('buscar') }}"
        >
        <button type="submit" class="btn btn-primary me-2">Buscar</button>
        @if(request('buscar'))
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Limpiar</a>
        @endif
    </form>

    <!-- Tabla -->
    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos->sortBy('id') as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>${{ number_format($producto->precio, 2) }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                        <td>{{ $producto->proveedor->nombre ?? 'Sin proveedor' }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm me-1"> Editar</a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                     Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No se encontraron productos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-3">
        {{ $productos->appends(['buscar' => request('buscar')])->links() }}
    </div>
</div>
@endsection
