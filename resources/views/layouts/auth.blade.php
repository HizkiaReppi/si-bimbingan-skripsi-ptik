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
    <x-meta-data :title="$title" csrfToken="{{ csrf_token() }}" :baseurl="$baseUrl"/>

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
