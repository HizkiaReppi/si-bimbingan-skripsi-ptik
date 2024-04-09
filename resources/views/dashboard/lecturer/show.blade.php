<x-dashboard-layout title="Manajemen Dosen">
    <x-slot name="header">
        Manajemen Dosen
    </x-slot>

    <div class="card mb-4">
        <h5 class="card-header">Detail Dosen</h5>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="firstName" class="form-label">Nama Lengkap</label>
                    <input class="form-control" type="text" id="firstName" name="firstName"
                        value="{{ $lecturer->fullname }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="text" id="email" name="email"
                        value="{{ $lecturer->user->email }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="no-hp" class="form-label">Nomor HP</label>
                    <input class="form-control" type="text" id="no-hp" name="no-hp"
                        value="{{ $lecturer->phone_number }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip"
                        value="{{ $lecturer->nip }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nidn" class="form-label">NIDN</label>
                    <input type="text" class="form-control" id="nidn" name="nidn"
                        value="{{ $lecturer->nidn }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="pangkat" class="form-label">Pangkat</label>
                    <input type="text" class="form-control" id="pangkat" name="pangkat"
                        value="{{ $lecturer->rank }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                        value="{{ $lecturer->position }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="golongan" class="form-label">Golongan</label>
                    <input type="text" class="form-control" id="golongan" name="golongan"
                        value="{{ $lecturer->type }}" readonly />
                </div>
            </div>
        </div>
        <!-- /Account -->
        <div class="d-flex mb-4 ms-3" style="margin-top: -15px">
            <a href="{{ route('dashboard.lecturer.edit', $lecturer->id) }}" class="btn btn-primary ms-2">Edit Data</a>
            <a href="{{ route('dashboard.lecturer.destroy', $lecturer->id) }}" class="btn btn-danger ms-2"
                data-confirm-delete="true">Hapus Data</a>
            <a href="{{ route('dashboard.lecturer.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
        </div>
    </div>
</x-dashboard-layout>
