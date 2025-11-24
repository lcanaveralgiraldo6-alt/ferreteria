<x-guest-layout>
    <head>
        <!-- Font Awesome para el ícono de mostrar/ocultar contraseña -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <style>
            /* Intento robusto para ocultar el ícono nativo de mostrar contraseña en varios navegadores.
               Si tu navegador sigue mostrando algo, dime cuál usas (Chrome / Edge / Safari) y lo afino. */

            /* Edge / IE */
            input[type="password"]::-ms-reveal,
            input[type="password"]::-ms-clear {
                display: none !important;
            }

            /* Chrome / Safari (varias pseudoclases probadas) */
            input[type="password"]::-webkit-credentials-auto-fill-button,
            input[type="password"]::-webkit-clear-button,
            input[type="password"]::-webkit-password-toggle-button,
            input[type="password"]::-webkit-textfield-decoration-container {
                display: none !important;
                visibility: hidden !important;
                -webkit-appearance: none !important;
            }

            /* For good measure, quitar apariencias nativas */
            input[type="password"] {
                -webkit-appearance: none;
                appearance: none;
            }
        </style>
    </head>

    <div class="flex items-center justify-center min-h-screen bg-gray-100 overflow-y-auto">
        <div class="bg-white shadow-lg rounded-xl p-10 w-full max-w-md text-center">

            <!-- Logo -->
            <div class="mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Ferretería Pico & Pala" class="w-28 mx-auto mb-3">
                <h1 class="text-3xl font-extrabold text-gray-800">
                    Ferretería <span class="text-yellow-600">Pico &amp; Pala</span>
                </h1>
                <p class="text-gray-500 mt-2">Inicia sesión para continuar</p>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}" class="text-left relative">
                @csrf

                <!-- Correo -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Correo electrónico')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full border-gray-300 focus:border-yellow-600 focus:ring-yellow-500 rounded-lg"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Contraseña -->
                <div class="mb-4 relative">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <div class="relative">
                        <x-text-input id="password"
                            class="block mt-1 w-full border-gray-300 focus:border-yellow-600 focus:ring-yellow-500 rounded-lg pr-10"
                            type="password" name="password" required autocomplete="current-password" />
                        <!-- Icono ojo -->
                        <button type="button"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-yellow-600 focus:outline-none toggle-password"
                            toggle="#password">
                            <i class="fa-solid fa-eye text-lg"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Recordarme -->
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-yellow-600 shadow-sm focus:ring-yellow-500"
                        name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</label>
                </div>

                <!-- Botón de inicio de sesión -->
                <div class="flex justify-center">
                    <x-primary-button
                        class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-6 rounded-lg w-full text-center">
                        {{ __('Iniciar sesión') }}
                    </x-primary-button>
                </div>

                <!-- Enlace a registro -->
                <div class="text-center mt-6 text-sm">
                    <p>¿No tienes cuenta?
                        <a href="{{ route('register') }}"
                            class="text-yellow-600 font-semibold hover:underline">Regístrate aquí</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para mostrar/ocultar contraseña -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
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
