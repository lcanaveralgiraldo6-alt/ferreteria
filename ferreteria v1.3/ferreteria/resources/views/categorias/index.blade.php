@extends('layouts.app') 

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📦 Lista de Categorías</h2>

    {{-- ✅ Botón y buscador --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <a href="{{ route('categorias.create') }}" class="btn btn-success mb-2">➕ Nueva Categoría</a>

        <form method="GET" action="{{ route('categorias.index') }}" class="d-flex" style="max-width: 380px;">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2" 
                placeholder="Buscar categoría..." 
                value="{{ request('search') }}"
            >
            <button type="submit" class="btn btn-primary me-2">Buscar</button>

            @if(request('search'))
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary"> Limpiar</a>
            @endif
        </form>
    </div>

    {{-- ✅ Tabla con scroll --}}
    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm me-1">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron categorías.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
