@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📦 Categorías</h2>

    <a href="{{ route('categorias.create') }}" class="btn btn-primary mb-3">➕ Nueva Categoría</a>

    <div style="overflow-x:auto;">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta categoría?')">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
