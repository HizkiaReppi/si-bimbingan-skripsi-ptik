<section class="card mb-4">
    <h5 class="card-header pb-0">Profile Details</h5>
    <!-- Account -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update.lecturer') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="card-body">
            <div class="row">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Nama Lengkap</label>
                    <input class="form-control" type="text" id="fullname" name="fullname"
                        value="{{ old('fullname', $user->user->name) }}" placeholder="Nama Lengkap" autofocus required />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nidn" class="form-label">NIDN</label>
                    <p class="border p-2 rounded m-0">{{ $user->nidn }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nip" class="form-label">NIP</label>
                    <p class="border p-2 rounded m-0">{{ $user->formattedNIP }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" type="email" id="email" name="email"
                        value="{{ old('email', $user->user->email) }}" placeholder="Email" required />

                    @if ($user->user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->user->hasVerifiedEmail())
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
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="no-hp">Nomor HP</label>
                    <input type="number" id="no-hp" name="no-hp" class="form-control" placeholder="Nomor HP" value="{{ old('no-hp', $user->phone_number) }}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="gelar-depan">Gelar Depan</label>
                    <input type="text" id="gelar-depan" name="gelar-depan" class="form-control" placeholder="Gelar Depan" value="{{ old('gelar-depan', $user->front_degree) }}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="gelar-belakang">Gelar Belakang</label>
                    <input type="text" id="gelar-belakang" name="gelar-belakang" class="form-control" placeholder="Gelar Belakang" value="{{ old('gelar-belakang', $user->back_degree) }}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="jabatan">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Jabatan" value="{{ old('jabatan', $user->position) }}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="pangkat">Pangkat</label>
                    <input type="text" id="pangkat" name="pangkat" class="form-control" placeholder="Pangkat" value="{{ old('pangkat', $user->rank) }}" />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="golongan">Golongan</label>
                    <input type="text" id="golongan" name="golongan" class="form-control" placeholder="Golongan" value="{{ old('golongan', $user->type) }}" />
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
