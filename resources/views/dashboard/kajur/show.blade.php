<x-dashboard-layout title="Manajemen Ketua Jurusan">
    <x-slot name="header">
        Manajemen Ketua Jurusan
    </x-slot>

    <div class="card mb-4">
        <h5 class="card-header">Detail Ketua Jurusan</h5>
        <div class="card-body" style="margin-bottom: -20px">
            <div class="d-flex flex-column align-items-start gap-4">
                <label for="foto" class="form-label" style="margin-bottom: -10px">Foto</label>
                @if ($ketua_jurusan->user->photo == null)
                    <p class="border p-5 rounded" style="margin-bottom: -15px">Tidak Ada Foto</p>
                @else
                    <img src="{{ $ketua_jurusan->user->photoFile }}"
                        alt="{{ $ketua_jurusan->fullname }}" class="d-block rounded" style="width: 250px" id="foto" />
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Nama Lengkap</label>
                    <p class="border p-2 rounded m-0">{{ $ketua_jurusan->fullname }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <p class="border p-2 rounded m-0">{{ $ketua_jurusan->user->email }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="no-hp" class="form-label">Nomor HP</label>
                    <p class="border p-2 rounded m-0">{{ $ketua_jurusan->phone_number ?? '-' }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nip" class="form-label">NIP</label>
                    <p class="border p-2 rounded m-0">{{ $ketua_jurusan->formattedNIP }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nidn" class="form-label">NIDN</label>
                    <p class="border p-2 rounded m-0">{{ $ketua_jurusan->nidn }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="pangkat" class="form-label">Pangkat</label>
                    <p class="border p-2 rounded m-0">{{ $ketua_jurusan->rank ?? '-' }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <p class="border p-2 rounded m-0">{{ $ketua_jurusan->position ?? '-' }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="golongan" class="form-label">Golongan</label>
                    <p class="border p-2 rounded m-0">{{ $ketua_jurusan->type ?? '-' }}</p>
                </div>
            </div>
        </div>
        <!-- /Account -->
        <div class="d-flex mb-4 ms-3" style="margin-top: -15px">
            <a href="{{ route('dashboard.kajur.edit', $ketua_jurusan->id) }}" class="btn btn-primary ms-2">Edit Data</a>
            <a href="{{ route('dashboard.kajur.destroy', $ketua_jurusan->id) }}" class="btn btn-danger ms-2"
                data-confirm-delete="true">Hapus Data</a>
            <a href="{{ route('dashboard.kajur.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
        </div>
    </div>
</x-dashboard-layout>
