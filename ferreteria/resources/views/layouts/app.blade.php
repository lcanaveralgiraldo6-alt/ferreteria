<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pico & Pala - Dashboard</title>

    <!-- Carga los estilos compilados con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap 5 para componentes (alertas, modales, etc.) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>

<body class="flex bg-gray-100 text-gray-900" style="overflow-y: auto;">
    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#1a1a1a] text-white flex flex-col shadow-lg min-h-screen fixed left-0 top-0">
        <div class="p-6 text-center border-b border-gray-700">
            
            <img src="{{ asset('images/logo.png') }}" alt="Logo Pico & Pala" class="w-20 mx-auto mb-3">
            <h4 class="text-yellow-400 font-bold text-xl">Pico & Pala</h4>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
               {{ request()->routeIs('dashboard') ? 'bg-yellow-400 text-black' : '' }}">
               🏠 Dashboard
            </a>

            {{-- ADMINISTRADOR --}}
            @if(Auth::user()->role_id == 1)
                <a href="{{ route('productos.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('productos.*') ? 'bg-yellow-400 text-black' : '' }}">
                   🧰 Productos
                </a>
                <a href="{{ route('categorias.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('categorias.*') ? 'bg-yellow-400 text-black' : '' }}">
                   📦 Categorías
                </a>
                <a href="{{ route('proveedores.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('proveedores.*') ? 'bg-yellow-400 text-black' : '' }}">
                   🚚 Proveedores
                </a>
                <a href="{{ route('ventas.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('ventas.*') ? 'bg-yellow-400 text-black' : '' }}">
                   💵 Ventas
                </a>
                <a href="{{ route('usuarios.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('usuarios.*') ? 'bg-yellow-400 text-black' : '' }}">
                   👥 Usuarios
                </a>
                <a href="{{ route('reportes.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('reportes.*') ? 'bg-yellow-400 text-black' : '' }}">
                   📊 Reportes
                </a>

            {{-- EMPLEADO --}}
            @elseif(Auth::user()->role_id == 2)
                <a href="{{ route('productos.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('productos.*') ? 'bg-yellow-400 text-black' : '' }}">
                   🧰 Productos
                </a>
                <a href="{{ route('categorias.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('categorias.*') ? 'bg-yellow-400 text-black' : '' }}">
                   📦 Categorías
                </a>
                <a href="{{ route('proveedores.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('proveedores.*') ? 'bg-yellow-400 text-black' : '' }}">
                   🚚 Proveedores
                </a>
                <a href="{{ route('ventas.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('ventas.*') ? 'bg-yellow-400 text-black' : '' }}">
                   💵 Ventas
                </a>
                <a href="{{ route('reportes.index') }}"
                   class="block py-2 px-3 rounded hover:bg-yellow-400 hover:text-black 
                   {{ request()->routeIs('reportes.*') ? 'bg-yellow-400 text-black' : '' }}">
                   📊 Reportes
                </a>
            @endif
        </nav>

        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded transition">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-1 ml-64 p-6" style="min-height: 100vh; overflow-y: auto;">
        {{-- ALERTAS --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Cierra las alertas automáticamente después de 5 segundos
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>
