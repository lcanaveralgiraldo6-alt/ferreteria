<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ferretería Pico & Pala</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center font-sans antialiased">

    <!-- Contenedor principal del contenido -->
    <main class="w-full flex justify-center">
        <div class="w-full sm:max-w-md bg-white shadow-xl rounded-lg px-10 py-8 border border-gray-200">
            {{ $slot }}
        </div>
    </main>

    <!-- Pie de página -->
    <footer class="mt-8 text-sm text-gray-500 text-center">
        © {{ date('Y') }} Ferretería Pico & Pala. Todos los derechos reservados.
    </footer>

</body>
</html>
