<x-error-layout title="403">
    <div class="mb-0">
        <img src="/403.svg" alt="403" width="500" class="img-fluid" />
    </div>
    <h1 class="mb-2 mx-2">Akses Ditolak :(</h1>
    <h5 class="mb-4 mx-2">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</h5>
    <button type="button" id="back" class="btn btn-primary">Kembali ke Halaman Sebelumnya</button>

    <script>
        document.getElementById('back').addEventListener('click', function() {
            window.history.back();
        });

        setTimeout(() => {
            window.history.back();
        }, 10000);
    </script>
</x-error-layout>
