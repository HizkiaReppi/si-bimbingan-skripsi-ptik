@php
    $concentrations = ['rpl', 'multimedia', 'tkj'];
@endphp

<section class="card mb-4">
    <h5 class="card-header">Profile Details</h5>
    <!-- Account -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update.student') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100"
                    width="100" id="uploadedAvatar" />
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" />
                    </label>
                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>

                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                </div>
            </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control" type="text" id="name" name="name"
                        value="{{ old('name', $user->name) }}" placeholder="Nama" autofocus required />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nim" class="form-label">NIM</label>
                    <p class="border p-2 rounded m-0">{{ $user->student->formattedNIM }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" type="email" id="email" name="email"
                        value="{{ old('email', $user->email) }}" placeholder="Email" required />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification"
                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="no-hp">Nomor HP</label>
                    <input type="number" id="no-hp" name="no-hp" class="form-control" placeholder="Nomor HP" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <p class="border p-2 rounded m-0">{{ $user->student->batch }}</p>
                </div>
                <div class="mb-3">
                    <label for="konsentrasi" class="form-label">Konsentrasi <span
                            style="font-size:14px;color:red">*</span></label>
                    <select class="form-select {{ $errors->get('konsentrasi') ? 'border-danger' : '' }}"
                        id="konsentrasi" name="konsentrasi" aria-label="Konsentrasi" required>
                        @foreach ($concentrations as $concentration)
                            @if (old('konsentrasi', strtolower($user->student->concentration)) == $concentration)
                                <option value="{{ $concentration }}" selected>{{ strtoupper($concentration) }}
                                </option>
                            @else
                                <option value="{{ $concentration }}">{{ strtoupper($concentration) }}</option>
                            @endif
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('konsentrasi')" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"
                        value="{{ old('alamat', $user->student->address) }}" rows="2">
                        {{ old('alamat', $user->student->address) }}
                    </textarea>
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Simpan Data</button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </div>
    </form>
    <!-- /Account -->
</section>
