<x-auth-layout>
    <div class="mb-2" style="font-size:12px;">
        Terimakasih telah mendaftar! Sebelum memulai, bisakah anda memverifikasi alamat email anda dengan mengklik link yang baru saja kami kirimkan ke email anda? Jika anda tidak menerima email, kami akan dengan senang hati mengirimkan yang lain.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-2 fw-medium text-success" style="font-size:12px;">
            Link verifikasi baru telah dikirim ke alamat email yang anda gunakan saat registrasi.
        </div>
    @endif

    <div class="mt-2 d-flex align-items-center justify-content-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit" class="btn btn-primary">
                    Kirim Ulang Email Verifikasi
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-secondary">
                Keluar
            </button>
        </form>
    </div>
</x-auth-layout>
