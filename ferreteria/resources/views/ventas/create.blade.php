@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Registrar Venta</h2>

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select name="producto_id" id="producto_id" class="form-select">
                <option value="">-- Selecciona un producto --</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                    </option>
                @endforeach
            </select>
            @error('producto_id')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad') }}" class="form-control">
            @error('cantidad')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
            <input type="text" name="nombre_cliente" id="nombre_cliente" value="{{ old('nombre_cliente') }}" class="form-control">
            @error('nombre_cliente')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Registrar Venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
