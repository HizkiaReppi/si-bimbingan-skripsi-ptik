<section class="mt-2 mb-3 card p-4" id="update-password">
    <header>
        <h5 class="card-header p-0">
            Update Password
        </h5>

        <p class="mt-1" style="font-size:12px">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-2">
        @csrf
        @method('put')

        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="update_password_current_password">Password Saat Ini</label>
            <div class="input-group input-group-merge">
                <input type="password" id="update_password_current_password" class="form-control" name="current_password"
                    placeholder="******" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="update_password_password">Password Baru</label>
            <div class="input-group input-group-merge">
                <input type="password" id="update_password_password" class="form-control" name="password"
                    placeholder="******" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="update_password_password_confirmation">Konfirmasi Password Baru</label>
            <div class="input-group input-group-merge">
                <input type="password" id="update_password_password_confirmation" class="form-control"
                    name="password_confirmation" placeholder="******" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <button class="btn btn-primary" type="submit">Simpan Password</button>
    </form>
</section>
