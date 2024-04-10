<x-error-layout title="404">
    <div class="mb-0">
        <img src="/404.svg" alt="404" width="500" class="img-fluid" />
    </div>
    <h1 class="mb-2 mx-2">Halaman Tidak Ditemukan :(</h1>
    <h5 class="mb-4 mx-2">Maaf, halaman yang Anda cari tidak ditemukan.</h5>
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
