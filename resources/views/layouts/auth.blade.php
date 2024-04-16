<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistem Informasi Bimbingan Skripsi PTIK" />

    <title>{{ $title }} - SI Bimbingan Skripsi PTIK</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    @vite(['resources/vendor/fonts/boxicons.css', 'resources/css/demo.css', 'resources/vendor/css/core.css', 'resources/vendor/css/theme-default.css', 'resources/vendor/js/helpers.js', 'resources/js/config.js'])
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                {{ $slot }}
            </div>
        </div>

        @vite(['resources/vendor/libs/jquery/jquery.js', 'resources/vendor/libs/popper/popper.js', 'resources/vendor/js/bootstrap.js', 'resources/vendor/libs/perfect-scrollbar/perfect-scrollbar.js', 'resources/vendor/js/menu.js', 'resources/vendor/libs/apex-charts/apexcharts.js', 'resources/js/main.js'])

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
