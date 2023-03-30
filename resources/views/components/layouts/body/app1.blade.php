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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Manrope">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> --}}
    {{-- Css --}}
    @notifyCss
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>

<body style="font-family: 'Manrope',serif; background-image:url(https://im-control.com/main/public/images/ImControl/ba.png);">
    <div>

        <!-- Page Navigation -->
        <header>
            <x-layouts.navigation1 class="absolute"></x-layouts1.navigation>
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
        <main>
            {{ $content }}
        </main>
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
