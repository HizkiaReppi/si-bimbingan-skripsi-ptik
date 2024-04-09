<x-dashboard-layout title="Tambah Data Dosen">
    <x-slot name="header">
        Edit Data Dosen
    </x-slot>

    <div class="card p-4">
        <form method="POST" action="{{ route('dashboard.lecturer.update', $lecturer->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" for="fullname">Nama Lengkap <span
                        style="font-size:14px;color:red">*</span></label>
                <input type="text" class="form-control {{ $errors->get('fullname') ? 'border-danger' : '' }}"
                    id="fullname" name="fullname" placeholder="Nama Lengkap"
                    value="{{ old('fullname', $lecturer->user->name) }}" autofocus required />
                <x-input-error class="mt-2" :messages="$errors->get('fullname')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email <span style="font-size:14px;color:red">*</span></label>
                <input type="email" class="form-control {{ $errors->get('email') ? 'border-danger' : '' }}"
                    id="email" name="email" placeholder="Email" value="{{ old('email', $lecturer->user->email) }}"
                    required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="nidn">NIDN <span style="font-size:14px;color:red">*</span></label>
                <input type="number" class="form-control {{ $errors->get('nidn') ? 'border-danger' : '' }}"
                    id="nidn" name="nidn" placeholder="NIDN" value="{{ old('nidn', $lecturer->nidn) }}"
                    required />
                <x-input-error class="mt-2" :messages="$errors->get('nidn')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="nip">NIP <span style="font-size:14px;color:red">*</span></label>
                <input type="number" class="form-control {{ $errors->get('nip') ? 'border-danger' : '' }}"
                    id="nip" name="nip" placeholder="NIP" value="{{ old('nip', $lecturer->nip) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('nip')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="gelar-depan">Gelap Depan</label>
                <input type="text" class="form-control {{ $errors->get('gelar-depan') ? 'border-danger' : '' }}"
                    id="gelar-depan" name="gelar-depan" placeholder="Gelar Depan"
                    value="{{ old('gelar-depan', $lecturer->front_degree) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('gelar-depan')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="gelar-belakang">Gelar Belakang</label>
                <input type="text" class="form-control {{ $errors->get('gelar-belakang') ? 'border-danger' : '' }}"
                    id="gelar-belakang" name="gelar-belakang" placeholder="Gelar Belakang"
                    value="{{ old('gelar-belakang', $lecturer->back_degree) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('gelar-belakang')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="jabatan">Jabatan</label>
                <input type="text" class="form-control {{ $errors->get('jabatan') ? 'border-danger' : '' }}"
                    id="jabatan" name="jabatan" placeholder="Jabatan"
                    value="{{ old('jabatan', $lecturer->position) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('jabatan')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="pangkat">Pangkat</label>
                <input type="text" class="form-control {{ $errors->get('pangkat') ? 'border-danger' : '' }}"
                    id="pangkat" name="pangkat" placeholder="Pangkat"
                    value="{{ old('pangkat', $lecturer->rank) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('pangkat')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="golongan">Golongan</label>
                <input type="text" class="form-control {{ $errors->get('golongan') ? 'border-danger' : '' }}"
                    id="golongan" name="golongan" placeholder="Golongan"
                    value="{{ old('golongan', $lecturer->type) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('golongan')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="no-hp">Nomor HP</label>
                <input type="number" class="form-control {{ $errors->get('no-hp   ') ? 'border-danger' : '' }}"
                    id="no-hp" name="no-hp" placeholder="Nomor HP"
                    value="{{ old('no-hp', $lecturer->phone_number) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('no-hp')" />
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Edit Data</button>
                <a href="{{ route('dashboard.lecturer.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </div>
        </form>
    </div>
</x-dashboard-layout>
