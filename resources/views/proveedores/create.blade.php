@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Crear Proveedor</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Por favor corrige los siguientes errores:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proveedores.store') }}" method="POST" novalidate>
        @csrf

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input 
                type="text" 
                id="nombre" 
                name="nombre" 
                value="{{ old('nombre') }}" 
                class="form-control @error('nombre') is-invalid @enderror" 
                required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- NIT --}}
        <div class="mb-3">
            <label for="nit" class="form-label">NIT *</label>
            <input 
                type="text" 
                id="nit" 
                name="nit" 
                value="{{ old('nit') }}" 
                class="form-control @error('nit') is-invalid @enderror" 
                required>
            @error('nit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Teléfono --}}
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono *</label>
            <input 
                type="text" 
                id="telefono" 
                name="telefono" 
                value="{{ old('telefono') }}" 
                class="form-control @error('telefono') is-invalid @enderror" 
                required>
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Correo --}}
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico *</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                class="form-control @error('email') is-invalid @enderror" 
                required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Dirección --}}
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección *</label>
            <input 
                type="text" 
                id="direccion" 
                name="direccion" 
                value="{{ old('direccion') }}" 
                class="form-control @error('direccion') is-invalid @enderror" 
                required>
            @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botones --}}
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
