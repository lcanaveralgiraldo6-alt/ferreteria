@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">➕ Crear Usuario</h2>

    <form action="{{ route('usuarios.store') }}" method="POST" class="card shadow-sm p-4 border-0">
        @csrf

        <!-- Nombre -->
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nombre completo</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" 
                required
                pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                title="Solo se permiten letras y espacios">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Correo electrónico</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" 
                required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Contraseña -->
        <div class="mb-3 position-relative">
            <label for="password" class="form-label fw-semibold">Contraseña</label>
            <div class="input-group">
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror"
                    required
                    minlength="8"
                    title="Debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.">
                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                </button>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <small class="text-muted">Debe contener una mayúscula, una minúscula, un número y un carácter especial.</small>
        </div>

        <!-- Rol -->
        <div class="mb-4">
            <label for="role_id" class="form-label fw-semibold">Rol</label>
            <select 
                id="role_id" 
                name="role_id" 
                class="form-select @error('role_id') is-invalid @enderror" 
                required>
                <option value="">Seleccione un rol</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}" {{ old('role_id') == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordField = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const isPassword = passwordField.type === 'password';
    passwordField.type = isPassword ? 'text' : 'password';
    eyeIcon.classList.toggle('fa-eye');
    eyeIcon.classList.toggle('fa-eye-slash');
});
</script>
@endsection
