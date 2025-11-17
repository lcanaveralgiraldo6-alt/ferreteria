<x-guest-layout>
    <head>
        <!-- Font Awesome para los íconos de mostrar/ocultar contraseña -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>

    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Pico & Pala" class="w-20 mx-auto mb-2">
            <h1 class="text-2xl font-bold text-gray-800">Ferretería <span class="text-yellow-600">&nbsp;Pico &amp; Pala</span></h1>
        </div>

        <!-- Título -->
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Regístrate</h2>

        <!-- Formulario -->
        <form method="POST" action="{{ route('register') }}" class="bg-white p-6 rounded-lg shadow-md w-80 relative">
            @csrf

            <!-- Nombre -->
            <div>
                <x-input-label for="name" :value="__('Nombre completo')" />
                <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-yellow-600 focus:ring-yellow-500 rounded-lg"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Correo -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Correo electrónico')" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-yellow-600 focus:ring-yellow-500 rounded-lg"
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Contraseña -->
            <div class="mt-4 relative">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-yellow-600 focus:ring-yellow-500 rounded-lg pr-10"
                    type="password" name="password" required autocomplete="new-password" />
                <span class="toggle-password absolute top-9 right-3 flex items-center cursor-pointer text-gray-500" toggle="#password">
                    <i class="fa-solid fa-eye"></i>
                </span>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmar contraseña -->
            <div class="mt-4 relative">
                <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-yellow-600 focus:ring-yellow-500 rounded-lg pr-10"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <span class="toggle-password absolute top-9 right-3 flex items-center cursor-pointer text-gray-500" toggle="#password_confirmation">
                    <i class="fa-solid fa-eye"></i>
                </span>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Botón -->
            <div class="flex items-center justify-center mt-6">
                <x-primary-button class="bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded w-full">
                    {{ __('Registrarse') }}
                </x-primary-button>
            </div>

            <!-- Enlace -->
            <div class="text-center mt-4 text-sm">
                <p>¿Ya tienes una cuenta?
                    <a href="{{ route('login') }}" class="text-yellow-600 font-semibold hover:underline">Inicia sesión</a>
                </p>
            </div>
        </form>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function () {
                const input = document.querySelector(this.getAttribute('toggle'));
                const isPassword = input.getAttribute('type') === 'password';
                input.setAttribute('type', isPassword ? 'text' : 'password');
                const eyeIcon = this.querySelector('i');
                eyeIcon.classList.toggle('fa-eye', !isPassword);
                eyeIcon.classList.toggle('fa-eye-slash', isPassword);
            });
        });
    </script>
</x-guest-layout>
