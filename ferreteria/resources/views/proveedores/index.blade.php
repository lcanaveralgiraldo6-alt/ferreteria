@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Gestión de Proveedores</h2>

    <!-- Botón para agregar proveedor -->
    <a href="{{ route('proveedores.create') }}" class="btn btn-success mb-3">➕ Nuevo Proveedor</a>

    <!-- Buscador -->
    <form method="GET" action="{{ route('proveedores.index') }}" class="mb-4 d-flex" style="max-width: 400px;">
        <input 
            type="text" 
            name="buscar" 
            class="form-control me-2" 
            placeholder="Buscar por nombre o teléfono..." 
            value="{{ request('buscar') }}"
        >
        <button type="submit" class="btn btn-primary me-2">Buscar</button>

        @if(request('buscar'))
            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary"> Limpiar</a>
        @endif
    </form>

    <!-- Tabla de proveedores -->
    <div class="table-responsive" style="max-height: 600px; overflow-y: auto; overflow-x: auto;">
        <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>NIT</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proveedores->sortBy('id') as $proveedor)
                    <tr>
                        <td>{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->nit }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->direccion }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning btn-sm me-1"> Editar</a>
                            <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este proveedor?')"> Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No se encontraron proveedores.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-3">
        {{ $proveedores->appends(['buscar' => request('buscar')])->links() }}
    </div>
</div>
@endsection
