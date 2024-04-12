<x-dashboard-layout title="Pengajuan Ujian Hasil">
    <x-slot name="header">
        Pengajuan Ujian Hasil
    </x-slot>

    <div class="card mb-4">
        <h5 class="card-header">Pengajuan Ujian Hasil Mahasiswa</h5>
        <div class="card-body">
            <div class="row">
                <div class="mb-2 col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <p class="border p-2 rounded">{{ $ujian->student->fullname }}</p>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="nim" class="form-label">NIM</label>
                    <p class="border p-2 rounded">{{ $ujian->student->nim }}</p>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <p class="border p-2 rounded">{{ $ujian->student->batch }}</p>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="konsentrasi" class="form-label">Konsentrasi</label>
                    <p class="border p-2 rounded">{{ $ujian->student->concentration }}</p>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <p class="border p-2 rounded">{{ $ujian->student->user->email }}</p>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="no-hp" class="form-label">Nomor HP</label>
                    <p class="border p-2 rounded">{{ $ujian->student->no_hp ?? '-' }}</p>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="dosen-pembimbing-1" class="form-label">Dosen Pembimbing I</label>
                    <p class="border p-2 rounded">{{ $ujian->student->firstSupervisorFullname }}</p>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="dosen-pembimbing-2" class="form-label">Dosen Pembimbing II</label>
                    <p class="border p-2 rounded">{{ $ujian->student->secondSupervisorFullname }}</p>
                </div>
                <hr>
                <div class="mb-2">
                    <label for="judul-skripsi" class="form-label">Judul Skripsi</label>
                    <p class="border p-2 rounded text-justify">{{ $ujian->thesis->title }}</p>
                </div>
                <div class="mb-2">
                    <label for="judul-skripsi" class="form-label">File Skripsi</label>
                    <a href="{{ $ujian->thesis->filePath }}" download="" class="d-block btn btn-secondary">Download
                        File</a>
                </div>
                <hr class="mt-3">
                <form action="{{ route('dashboard.ujian.update', $ujian->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Tanggapi Status Pengajuan Ujian Hasil <span
                                style="font-size:14px;color:red">*</span></label>
                        <select
                            class="form-select {{ $errors->get('status_request') ? 'border-danger' : '' }} text-capitalize"
                            name="status_request" id="status_request" required>
                            @if (old('status_request', $ujian->status_request) == 'approved')
                                <option value="approved" selected>Setujui</option>
                                <option value="pending">Menunggu Persetujuan</option>
                            @else
                                <option value="approved">Setujui</option>
                                <option value="pending" selected>Menunggu Persetujuan</option>
                            @endif
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status_request')" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Tanggapi Pengajuan Ujian Hasil</button>
                        <a href="{{ route('dashboard.ujian.index') }}"
                            class="btn btn-outline-secondary ms-2">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
