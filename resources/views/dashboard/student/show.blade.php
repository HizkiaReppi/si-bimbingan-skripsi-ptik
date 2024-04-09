<x-dashboard-layout title="Manajemen Mahasiswa">
    <x-slot name="header">
        Manajemen Mahasiswa
    </x-slot>

    <div class="card mb-4">
        <h5 class="card-header">Detail Mahasiswa</h5>
        <div class="card-body" style="margin-bottom: -20px">
            <div class="d-flex flex-column align-items-start gap-4">
                <label for="foto" class="form-label" style="margin-bottom: -10px">Foto</label>
                @if ($student->photo == null)
                    <p class="border p-5 rounded"  style="margin-bottom: -15px">Tidak Ada Foto</p>
                @else
                <img src="{{ asset('storage/images/profile-photo/' . $student->photo) }}"
                    alt="{{ $student->fullname }}" class="d-block rounded w-100 h-100"
                    id="foto" />
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="fullname" class="form-label">Nama Lengkap</label>
                    <input class="form-control" type="text" id="fullname" name="fullname"
                        value="{{ $student->fullname }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim"
                        value="{{ $student->nim }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                        value="{{ $student->user->email }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <input class="form-control" type="text" id="angkatan" name="angkatan"
                        value="{{ $student->batch }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="konsentrasi" class="form-label">Konsentrasi</label>
                    <input type="text" class="form-control" id="konsentrasi" name="konsentrasi"
                        value="{{ $student->concentration }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="dosen-pembimbing" class="form-label">Dosen Pembimbing</label>
                    <input type="text" class="form-control" id="dosen-pembimbing" name="dosen-pembimbing"
                        value="{{ $student->supervisorFullname }}" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="no-hp" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control" id="no-hp" name="no-hp"
                        value="{{ $student->phone_number }}" readonly />
                </div>
                <div class="mb-3 col-md-12">
                    <label for="jabatan" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" value="{{ $student->address }}"
                        rows="2" readonly></textarea>
                </div>
            </div>
        </div>
        <!-- /Account -->
        <div class="d-flex mb-4 ms-3" style="margin-top: -15px">
            <a href="{{ route('dashboard.student.edit', $student->id) }}" class="btn btn-primary ms-2">Edit Data</a>
            <a href="{{ route('dashboard.student.destroy', $student->id) }}" class="btn btn-danger ms-2"
                data-confirm-delete="true">Hapus Data</a>
            <a href="{{ route('dashboard.student.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
        </div>
    </div>
</x-dashboard-layout>
