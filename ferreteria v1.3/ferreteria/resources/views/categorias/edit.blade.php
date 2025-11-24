@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">✏️ Editar Categoría</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Se encontraron algunos errores:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input 
                type="text" 
                name="nombre" 
                id="nombre" 
                value="{{ old('nombre', $categoria->nombre) }}"
                class="form-control @error('nombre') is-invalid @enderror"
            >
            @error('nombre')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción *</label>
            <textarea 
                name="descripcion" 
                id="descripcion" 
                class="form-control @error('descripcion') is-invalid @enderror" 
                rows="3"
            >{{ old('descripcion', $categoria->descripcion) }}</textarea>
            @error('descripcion')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">💾 Actualizar</button>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">⬅️ Cancelar</a>
    </form>
</div>
@endsection
