<x-auth-layout title="Login">
    <!-- Register -->
    <section class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100vh;">
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center fs-2 mb-5">
                    <a href="/" class="app-brand-link">
                        SI BIMBINGAN SKRIPSI
                    </a>
                </div>
                <h4 class="mb-2 fs-4 text-center">Selamat Datang di SI Bimbingan Skripsi</h4>

                <form class="mb-3" method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ old('email') }}" autofocus />
                        @if ($errors->any())
                            <p style="font-size:12px;color:red;margin-top:3px">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </p>
                        @endif
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                            <a href="{{ route('password.request') }}">
                                <small>Lupa Password?</small>
                            </a>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="******" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                            <label class="form-check-label" for="remember"> Ingat Saya </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-auth-layout>
