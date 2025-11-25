@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"> Editar Venta #{{ $venta->id }}</h2>

    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select name="producto_id" id="producto_id" class="form-select">
                <option value="">-- Selecciona un producto --</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ $venta->producto_id == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }} - ${{ number_format($producto->precio, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
            @error('producto_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad', $venta->cantidad) }}">
            @error('cantidad')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
            <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" value="{{ old('nombre_cliente', $venta->nombre_cliente) }}">
            @error('nombre_cliente')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="text-end">
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary"> Volver</a>
            <button type="submit" class="btn btn-primary"> Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
