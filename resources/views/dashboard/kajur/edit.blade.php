<x-dashboard-layout title="Edit Data Ketua Jurusan">
    <x-slot name="header">
        Edit Data Ketua Jurusan
    </x-slot>

    <div class="card p-4">
        <form method="POST" action="{{ route('dashboard.kajur.update', $ketua_jurusan->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" for="fullname">Nama Lengkap <span
                        style="font-size:14px;color:red">*</span></label>
                <input type="text" class="form-control {{ $errors->get('fullname') ? 'border-danger' : '' }}"
                    id="fullname" name="fullname" placeholder="Nama Lengkap"
                    value="{{ old('fullname', $ketua_jurusan->user->name) }}" autofocus required />
                <x-input-error class="mt-2" :messages="$errors->get('fullname')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="nidn">NIDN <span style="font-size:14px;color:red">*</span></label>
                <input type="text" class="form-control {{ $errors->get('nidn') ? 'border-danger' : '' }}"
                    id="nidn" name="nidn" placeholder="NIDN" value="{{ old('nidn', $ketua_jurusan->nidn) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('nidn')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="nip">NIP <span style="font-size:14px;color:red">*</span></label>
                <input type="text" class="form-control {{ $errors->get('nip') ? 'border-danger' : '' }}"
                    id="nip" name="nip" placeholder="NIP" value="{{ old('nip', $ketua_jurusan->nip) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('nip')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="gelar-depan">Gelap Depan</label>
                <input type="text" class="form-control {{ $errors->get('gelar-depan') ? 'border-danger' : '' }}"
                    id="gelar-depan" name="gelar-depan" placeholder="Gelar Depan"
                    value="{{ old('gelar-depan', $ketua_jurusan->front_degree) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('gelar-depan')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="gelar-belakang">Gelar Belakang</label>
                <input type="text" class="form-control {{ $errors->get('gelar-belakang') ? 'border-danger' : '' }}"
                    id="gelar-belakang" name="gelar-belakang" placeholder="Gelar Belakang"
                    value="{{ old('gelar-belakang', $ketua_jurusan->back_degree) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('gelar-belakang')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="jabatan">Jabatan</label>
                <input type="text" class="form-control {{ $errors->get('jabatan') ? 'border-danger' : '' }}"
                    id="jabatan" name="jabatan" placeholder="Jabatan"
                    value="{{ old('jabatan', $ketua_jurusan->position) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('jabatan')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="pangkat">Pangkat</label>
                <input type="text" class="form-control {{ $errors->get('pangkat') ? 'border-danger' : '' }}"
                    id="pangkat" name="pangkat" placeholder="Pangkat" value="{{ old('pangkat', $ketua_jurusan->rank) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('pangkat')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="golongan">Golongan</label>
                <input type="text" class="form-control {{ $errors->get('golongan') ? 'border-danger' : '' }}"
                    id="golongan" name="golongan" placeholder="Golongan"
                    value="{{ old('golongan', $ketua_jurusan->type) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('golongan')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="no-hp">Nomor HP</label>
                <input type="text" class="form-control {{ $errors->get('no-hp   ') ? 'border-danger' : '' }}"
                    id="no-hp" name="no-hp" placeholder="Nomor HP"
                    value="{{ old('no-hp', $ketua_jurusan->phone_number) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('no-hp')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control {{ $errors->get('email   ') ? 'border-danger' : '' }}"
                    id="email" name="email" placeholder="Email"
                    value="{{ old('email', $ketua_jurusan->user->email) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                @if ($ketua_jurusan->user->photo)
                    <img src="{{ $ketua_jurusan->user->photoFile }}" alt="{{ $ketua_jurusan->fullname }}"
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
            <div>
                <button type="submit" class="btn btn-primary">Edit Data</button>
                <a href="{{ route('dashboard.kajur.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </div>
        </form>
    </div>
</x-dashboard-layout>
