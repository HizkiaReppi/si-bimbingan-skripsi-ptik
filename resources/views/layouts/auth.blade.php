<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@php
    $baseUrl = config('app.url');

    $baseUrl = explode('://', $baseUrl)[1];

    if (request()->secure()) {
        $baseUrl = 'https://' . $baseUrl;
    } else {
        $baseUrl = 'http://' . $baseUrl;
    }
@endphp

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

    <link rel="stylesheet" href="{{ $baseUrl }}/assets/css/app.css">
    <link rel="stylesheet" href="{{ $baseUrl }}/assets/css/demo.css">
    <link rel="stylesheet" href="{{ $baseUrl }}/assets/vendor/fonts/boxicons.css">
    <link rel="stylesheet" href="{{ $baseUrl }}/assets/vendor/css/core.css">
    <link rel="stylesheet" href="{{ $baseUrl }}/assets/vendor/css/theme-default.css">
    <script src="{{ $baseUrl }}/assets/vendor/js/helpers.js"></script>
    <script src="{{ $baseUrl }}/assets/js/config.js"></script>
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                {{ $slot }}
            </div>
        </div>

        <script src="{{ $baseUrl }}/assets/vendor/libs/jquery/jquery.js"></script>
        <script src="{{ $baseUrl }}/assets/vendor/libs/popper/popper.js"></script>
        <script src="{{ $baseUrl }}/assets/vendor/js/bootstrap.js"></script>
        <script src="{{ $baseUrl }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="{{ $baseUrl }}/assets/vendor/js/menu.js"></script>
        <script src="{{ $baseUrl }}/assets/js/main.js"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
