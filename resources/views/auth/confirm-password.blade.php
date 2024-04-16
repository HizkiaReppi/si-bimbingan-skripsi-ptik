<x-auth-layout>
    <div class="mb-2 text-secondary" style="font-size:12px;">
        Ini adalah area aman dari aplikasi. Harap konfirmasi password anda sebelum melanjutkan.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="******" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <div class="d-flex justify-content-end mt-2">
            <button type="submit" class="btn btn-primary">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-auth-layout>
