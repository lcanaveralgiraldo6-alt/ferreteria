@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">✏️ Editar Producto</h2>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" value="{{ old('precio', $producto->precio) }}" min="0">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock disponible</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $producto->stock) }}" min="0">
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select name="categoria_id" class="form-select">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="proveedor_id" class="form-label">Proveedor</label>
            <select name="proveedor_id" class="form-select">
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ $producto->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">💾 Actualizar Producto</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">⬅️ Volver</a>
    </form>
</div>
@endsection
