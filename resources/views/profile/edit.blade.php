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
    {{-- <body style="background-image: url('images/ImControl/bg.jpg');"> --}}
    <div class="box-content w-[100%] h-[100%] max-h-ful absolute">
        <img src="{{ asset('images/ImControl/bg.jpg') }}" class="w-[100%] h-[100%]" alt="">
    </div>
    <div>

        <!-- Navigation -->
        <header>
            <x-layouts.navigationD class="absolute" :inicio=true></x-layouts.navigationD>
        </header>

        <!-- Page Content -->
        <main style="font-family: 'Manrope',serif;">
            <div class="box-content w-[100%] h-[50%] absolute mt-[7%] z-40">

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class=" overflow-hidden shadow-sm sm:rounded-lg flex items-center space-x-6">
                            <div class="p-4 sm:p-8 bg-[#152a3a] shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>

                            <div class="p-4 sm:p-8 bg-[#152a3a] shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>

                            <div class="p-4 sm:p-8 bg-[#152a3a] shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </main>

    </div>

</body>

</html>

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
