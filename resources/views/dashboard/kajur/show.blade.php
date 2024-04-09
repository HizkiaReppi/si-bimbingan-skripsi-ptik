<x-dashboard-layout title="Manajemen Ketua Jurusan">
    <x-slot name="header">
        Manajemen Ketua Jurusan
    </x-slot>

    <div class="card mb-4">
        <h5 class="card-header">Detail Ketua Jurusan</h5>
        <div class="card-body" style="margin-bottom: -20px">
            <div class="d-flex flex-column align-items-start gap-4">
                <label for="foto" class="form-label" style="margin-bottom: -10px">Foto</label>
                @if ($kajur->user->photo == null)
                    <p class="border p-5 rounded"  style="margin-bottom: -15px">Tidak Ada Foto</p>
                @else
                <img src="{{ asset('storage/images/profile-photo/' . $kajur->user->photo) }}"
                    alt="{{ $kajur->fullname }}" class="d-block rounded w-100 h-100"
                    id="foto" />
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Nama Lengkap</label>
                    <input class="form-control" type="text" id="firstName" name="firstName"
                        value="{{ $kajur->fullname }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="text" id="email" name="email" value="{{ $kajur->user->email }}"
                        readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="no-hp" class="form-label">Nomor HP</label>
                    <input class="form-control" type="text" id="no-hp" name="no-hp" value="{{ $kajur->phone_number }}"
                        readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ $kajur->nip }}"
                        readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nidn" class="form-label">NIDN</label>
                    <input type="text" class="form-control" id="nidn" name="nidn" value="{{ $kajur->nidn }}"
                        readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="pangkat" class="form-label">Pangkat</label>
                    <input type="text" class="form-control" id="pangkat" name="pangkat"
                        value="{{ $kajur->rank }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                        value="{{ $kajur->position }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="golongan" class="form-label">Golongan</label>
                    <input type="text" class="form-control" id="golongan" name="golongan"
                        value="{{ $kajur->type }}" readonly />
                </div>
            </div>
        </div>
        <!-- /Account -->
        <div class="d-flex mb-4 ms-3" style="margin-top: -15px">
            <a href="{{ route('dashboard.kajur.edit', $kajur->id) }}" class="btn btn-primary ms-2">Edit Data</a>
            <a href="{{ route('dashboard.kajur.destroy', $kajur->id) }}" class="btn btn-danger ms-2" data-confirm-delete="true">Hapus Data</a>
            <a href="{{ route('dashboard.kajur.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
        </div>
    </div>
</x-dashboard-layout>
