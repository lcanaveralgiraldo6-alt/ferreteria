@extends('layouts.app')

@section('content')
<div class="container" style="overflow-y:auto; max-height:90vh;">
    <h2 class="mb-4">👥 Gestión de Usuarios</h2>

    <a href="{{ route('usuarios.create') }}" class="btn btn-success mb-3">➕ Nuevo Usuario</a>

    <!--  Buscador -->
    <form method="GET" action="{{ route('usuarios.index') }}" class="d-flex mb-3" role="search">
        <input 
            type="text" 
            name="search" 
            class="form-control me-2" 
            placeholder="Buscar por nombre, rol o correo..." 
            value="{{ request('search') }}"
        >
        <button type="submit" class="btn btn-primary me-2"> Buscar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary"> Limpiar</a>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->role->nombre ?? 'Sin rol' }}</td>
                        <td class="text-center">
                            <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning btn-sm"> Editar</a>
                            <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este usuario?')">
                                     Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron usuarios.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
