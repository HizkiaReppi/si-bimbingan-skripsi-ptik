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
      <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
      <script src="https://kit.fontawesome.com/29057e6c17.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('layouts.navbar')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="mb-4 order-0">
                  @if (isset($header))
                  <header class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">{{ $header }}</h5>
                          @if (isset($header_subtitle))
                          <p class="mb-4">
                            {{ $header_subtitle }}
                          </p>
                          @endif
                        </div>
                      </div>
                    </div>
                  </header>
                  @endif
                  
                  <main class="mt-4">
                    {{ $slot }}
                  </main>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            @include('layouts.footer')

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    @include('sweetalert::alert')

    @vite(['resources/vendor/libs/jquery/jquery.js', 'resources/vendor/libs/popper/popper.js', 'resources/vendor/js/bootstrap.js', 'resources/vendor/libs/perfect-scrollbar/perfect-scrollbar.js', 'resources/vendor/js/menu.js', 'resources/vendor/libs/apex-charts/apexcharts.js', 'resources/js/main.js', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

    <script>
        new DataTable('#table');
    </script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

  </body>
</html>
