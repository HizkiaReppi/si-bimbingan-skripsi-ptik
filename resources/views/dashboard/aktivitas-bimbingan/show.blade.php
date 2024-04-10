<x-dashboard-layout title="Aktivitas Bimbingan">
    <x-slot name="header">
        Aktivitas Bimbingan
    </x-slot>

    <div class="card mb-4">
        <h5 class="card-header">Detail Bimbingan Ke-{{ $aktivitas_bimbingan->guidance_number }}</h5>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="judul-skripsi" class="form-label">Nama Mahasiswa</label>
                    <p class="border p-2 rounded">{{ $aktivitas_bimbingan->student->fullname }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="judul-skripsi" class="form-label">NIM</label>
                    <p class="border p-2 rounded">{{ $aktivitas_bimbingan->student->nim }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="judul-skripsi" class="form-label">Angkatan</label>
                    <p class="border p-2 rounded">{{ $aktivitas_bimbingan->student->batch }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="judul-skripsi" class="form-label">Konsentrasi</label>
                    <p class="border p-2 rounded">{{ $aktivitas_bimbingan->student->concentration }}</p>
                </div>
                <div class="mb-3 col-md-12">
                    <label for="judul-skripsi" class="form-label">Dosen Pembimbing</label>
                    <p class="border p-2 rounded">{{ $aktivitas_bimbingan->student->supervisorFullname }}</p>
                </div>
                <hr class="border border-1">
                <div class="mb-3">
                    <label for="judul-skripsi" class="form-label">Judul Skripsi</label>
                    <p class="border p-2 rounded text-justify">{{ $aktivitas_bimbingan->thesis_title }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="schedule" class="form-label">Jadwal Bimbingan</label>
                    <p class="border p-2 rounded text-justify">{{ $aktivitas_bimbingan->schedule }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="status" class="form-label">Status Request</label>
                    @if ($aktivitas_bimbingan->status == 'pending')
                        <p class="border p-2 rounded text-justify text-capitalize">Diajukan</p>
                    @elseif ($aktivitas_bimbingan->status == 'approved')
                        <p class="border p-2 rounded text-justify text-capitalize">Disetujui</p>
                    @elseif ($aktivitas_bimbingan->status == 'rejected')
                        <p class="border p-2 rounded text-justify text-capitalize">Ditolak</p>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="topik" class="form-label">Topik Yang Dibicarakan</label>
                    <p class="border p-2 rounded text-justify">{{ $aktivitas_bimbingan->topic }}</p>
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Dari Mahasiswa</label>
                    <p class="border p-2 rounded text-justify">
                        {{ $aktivitas_bimbingan->explanation ? $aktivitas_bimbingan->explanation : '-' }}</p>
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Dari Dosen</label>
                    <p class="border p-2 rounded text-justify">
                        {{ $aktivitas_bimbingan->lecturer_notes ? $aktivitas_bimbingan->lecturer_notes : '-' }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="thesis_file" class="form-label">File Skripsi</label>
                    <a href="{{ asset('storage/file/skripsi/' . $aktivitas_bimbingan->thesis_file) }}" download=""
                        class="d-block btn btn-primary">Download File</a>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="thesis_file_review" class="form-label">File Skripsi Setelah Direview</label>
                    @if ($aktivitas_bimbingan->thesis_file_review)
                        <a href="{{ asset('storage/file/skripsi/' . $aktivitas_bimbingan->thesis_file_review) }}"
                            download="" class="d-block btn btn-secondary" @disabled(true)>Download
                            File</a>
                    @else
                        <button class="d-block btn btn-secondary" style="width: 100%" type="button">Download
                            File</button>
                    @endif
                </div>
            </div>
        </div>
        <hr class="border border-1">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Daftar Bimbingan</h5>
            </div>
            <div class="table-responsive text-wrap px-4 pb-4">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">Bimbingan Ke</th>
                            <th class="text-center" style="width: 50px">Judul Skripsi</th>
                            <th class="text-center">Topik Bimbingan</th>
                            <th class="text-center">Tanggal Bimbingan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($guidances as $guidance)
                            <tr>
                                <td class="text-center">{{ $guidance->guidance_number }}</td>
                                <td class="fw-medium" style="width: 50px">{{ $guidance->thesis_title }}</td>
                                <td class="fw-medium">{{ $guidance->topic }}</td>
                                <td class="text-center">{{ $guidance->schedule }}</td>
                                @if ($guidance->status == 'pending')
                                    <td class="text-center text-info text-capitalize">Diajukan</td>
                                @elseif ($guidance->status == 'approved')
                                    <td class="text-center text-success text-capitalize">Disetujui</td>
                                @elseif ($guidance->status == 'rejected')
                                    <td class="text-center text-danger text-capitalize">Ditolak</td>
                                @endif
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.aktivitas-bimbingan.show', $guidance->id) }}">
                                                <i class="bx bxs-user-detail me-1"></i> Detail
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.aktivitas-bimbingan.edit', $guidance->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr style="margin-top: -10px">
        <div class="d-flex mb-4 ms-3 mt-3">
            <a href="{{ route('dashboard.aktivitas-bimbingan.edit', $aktivitas_bimbingan->id) }}"
                class="btn btn-primary ms-2">Edit
                Data</a>
            <a href="{{ route('dashboard.aktivitas-bimbingan.index') }}"
                class="btn btn-outline-secondary ms-2">Kembali</a>
        </div>
    </div>
</x-dashboard-layout>
