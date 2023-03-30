<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Manrope">
    {{-- Css --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>

<body>
    <div class="box-content w-[100%] h-[100%] max-h-ful absolute">
        <img src="{{ asset('images/ImControl/bg.jpg') }}" class="w-[100%] h-[100%]" alt="">
    </div>
    <div>

        <!-- Navigation -->
        <header>
            <x-layouts.navigationD class="absolute"></x-layouts.navigationD>
        </header>

        <!-- Page Content -->
        <main style="font-family: 'Manrope',serif;">
            <div class="box-xontent w-[100%] h-[50%] absolute mt-[7%] z-40">


                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                Hola, <strong> {{ Auth::user()->name }} {{ Auth::user()->lastname }} </strong> <br>
                                Bienvenido a ImControl
                                <br><br>

                                <div class="flex">

                                    <div class="mr-2">
                                        <a class="group relative inline-flex items-center overflow-hidden rounded bg-cyan-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-cyan-500"
                                            href="{{ route('social_networks') }}">
                                            <span
                                                class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </span>

                                            <span class="text-sm font-medium transition-all group-hover:ml-4">
                                                Redes Sociales
                                            </span>
                                        </a>
                                    </div>

                                    <div class="mr-2">
                                        <a class="group relative inline-flex items-center overflow-hidden rounded bg-cyan-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-cyan-500"
                                            href="{{ route('profile.edit', Auth::user()->id) }}">
                                            <span
                                                class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </span>

                                            <span class="text-sm font-medium transition-all group-hover:ml-4">
                                                Mi Perfil
                                            </span>
                                        </a>
                                    </div>

                                    {{-- <div class="mr-2">
                                        <a class="group relative inline-flex items-center overflow-hidden rounded bg-cyan-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-cyan-500"
                                            href="#">
                                            <span
                                                class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </span>

                                            <span class="text-sm font-medium transition-all group-hover:ml-4">
                                                Panel de Administrador
                                            </span>
                                        </a>
                                    </div>
                                    --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </main>
        <div class="box-content h-[10%]  w-[100%] absolute">
            <x-layouts.soporte.soporte>
                </x-layouts.soporte>
        </div>
    </div>

</body>

</html>

{{-- <x-layouts.body.app>

    <x-slot name="content">
        <div class="box-xontent w-[100%] h-[50%] absolute mt-[7%] z-40">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __("You're logged in!") }}
                        </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.body.app> --}}
