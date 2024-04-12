@php
    $concentrations = ['rpl', 'multimedia', 'tkj'];
@endphp

<section class="card mb-4">
    <h5 class="card-header pb-0">Profile Details</h5>
    <!-- Account -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update.admin') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="card-body">
            <div class="row">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control" type="text" id="name" name="name"
                        value="{{ old('name', $user->name) }}" placeholder="Nama" autofocus required />
                </div>
                <div class="mb-3">
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
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    @if ($user->photo)
                        <img src="{{ $user->photoFile }}" alt="{{ $user->name }}"
                            class="img-preview img-thumbnail rounded mb-2" style="width: 300px; height: auto;">
                    @else
                        <img class="img-preview img-thumbnail rounded" style="width: 300px; height: auto;">
                    @endif
                    <input class="form-control" type="file" id="foto" name="foto"
                        accept=".png, .jpg, .jpeg" />
                    <x-input-error class="mt-2" :messages="$errors->get('foto')" />
                    <div id="form-help" class="form-text">
                        <small>PNG, JPG atau JPEG (Max. 2 MB).</small>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
            </div>
        </div>
    </form>
    <!-- /Account -->
</section>
