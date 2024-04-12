<x-auth-layout title="Lupa Password">
    <section class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100vh;">
        <div class="card">
            <div class="card-body">
                <div class="app-brand justify-content-center fs-2 mb-5">
                    <a href="/" class="app-brand-link">
                        SI BIMBINGAN SKRIPSI
                    </a>
                </div>
                <h4 class="mb-2">Lupa Password? 🔒</h4>
                <p class="mb-3">
                    Masukkan email Anda dan kami akan mengirimkan instruksi untuk reset password Anda
                </p>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Masukan Email Anda" autofocus />
                        @if ($errors->any())
                            <p style="font-size:12px;color:red;margin-top:3px">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </p>
                        @endif
                    </div>
                    <button class="btn btn-primary d-grid w-100" type="submit">Kirim Reset Link</button>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                        Kembali ke login
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-auth-layout>
