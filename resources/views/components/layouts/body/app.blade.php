<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? 'Default meta description' }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Manrope">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    {{-- Css --}}
    @notifyCss
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="box-content w-[100%] h-[100%] max-h-ful absolute">
        <img src="public/images/ImControl/bg.jpg" class="w-[100%] h-[100%]" alt="">
    </div>
    <div>

        <!-- Page Navigation -->
        <header>
            <x-layouts.nav class="absolute"></x-layouts.nav>
        </header>

        <!-- Page Heading -->
        @if (isset($header))
            <div class="bg-white shadow">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </div>
        @endif

        <!-- Page Content -->
        <main style="font-family: 'Manrope',serif;">
            {{ $content }}
        </main>
        <div class="box-content h-[10%]  w-[100%] absolute">
            <x-layouts.soporte.soporte />
        </div>
    </div>
    <!-- Page Footer -->
    @if (isset($footer))
        <footer class="bg-gray-900 text-white body-font ">
            {{ $footer }}
        </footer>
    @endif

    <x:notify-messages />
    @notifyJs
</body>

</html>
