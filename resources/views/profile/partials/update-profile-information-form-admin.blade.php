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
                            <p class="my-2" style="font-size:12px;">
                                Email anda belum terverifikasi.
                            </p>
                            <button form="send-verification"
                                class="btn btn-secondary" style="font-size:12px;">
                                Klik disini untuk mengirim ulang email verifikasi.
                            </button>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-1 fw-medium text-success" style="font-size:14px">
                                    Link verifikasi baru telah dikirim ke alamat email anda.
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
