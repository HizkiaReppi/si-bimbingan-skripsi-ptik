<x-dashboard-layout title="Manajemen Mahasiswa">
    <x-slot name="header">
        Manajemen Mahasiswa
    </x-slot>

    <div class="card mb-4">
        <h5 class="card-header">Detail Mahasiswa</h5>
        <div class="card-body" style="margin-bottom: -20px">
            <div class="d-flex flex-column align-items-start gap-4">
                <label for="foto" class="form-label" style="margin-bottom: -10px">Foto</label>
                @if ($student->user->photo == null)
                    <div class="border p-5 rounded" style="margin-bottom: -15px">Tidak Ada Foto</div>
                @else
                    <img src="{{ asset('storage/images/profile-photo/' . $student->user->photo) }}"
                        alt="{{ $student->fullname }}" class="d-block rounded" style="width: 250px" id="foto" />
                @endif
            </div>
        </div>
        <div class="card-body {{ $guidances->count() < 1 ? 'pb-2' : '' }}">
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="fullname" class="form-label">Nama Lengkap</label>
                    <p class="border p-2 rounded m-0">{{ $student->fullname }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nim" class="form-label">NIM</label>
                    <p class="border p-2 rounded m-0">{{ $student->formattedNIM }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="judu-skripsi" class="form-label">Judul Skripsi</label>
                    <p class="border p-2 rounded m-0">{{ $student->thesisTitle }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <p class="border p-2 rounded m-0">{{ $student->batch }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="konsentrasi" class="form-label">Konsentrasi</label>
                    <p class="border p-2 rounded m-0">{{ $student->concentration }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="dosen-pembimbing-1" class="form-label">Dosen Pembimbing I</label>
                    <p class="border p-2 rounded m-0">{{ $student->firstSupervisorFullname }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="dosen-pembimbing-2" class="form-label">Dosen Pembimbing II</label>
                    <p class="border p-2 rounded m-0">{{ $student->secondSupervisorFullname }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <p class="border p-2 rounded m-0">{{ $student->user->email }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="no-hp" class="form-label">Nomor HP</label>
                    <p class="border p-2 rounded m-0">{{ $student->phone_number ?? '-' }}</p>
                </div>
                <div class="mb-3 col-md-12">
                    <label for="jabatan" class="form-label">Alamat</label>
                    <p class="border p-2 rounded m-0">{{ $student->address ?? '-' }}</p>
                </div>
            </div>
        </div>
        @if ($guidances->count() > 0)
            <hr class="border border-1">
            <div>
                <h5 class="card-header">Daftar Bimbingan</h5>
                <div class="table-responsive text-wrap px-4 pb-4">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Bimbingan Ke</th>
                                <th class="text-center" style="width: 50px">Judul Skripsi</th>
                                <th class="text-center">Topik Bimbingan</th>
                                <th class="text-center">Tanggal Bimbingan</th>
                                <th class="text-center">Dosen Pembimbing</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($guidances as $guidance)
                                <tr>
                                    <td class="text-center">{{ $guidance->guidance_number }}</td>
                                    <td class="fw-medium" style="width: 50px">{{ $guidance->thesis->title }}</td>
                                    <td class="fw-medium">{{ $guidance->topic }}</td>
                                    <td class="text-center">{{ $guidance->schedule }}</td>
                                    <td class="text-start">{{ $guidance->lecturer->fullname }}</td>
                                    @if ($guidance->status_request == 'pending')
                                        <td class="text-center text-info text-capitalize">Diajukan</td>
                                    @elseif ($guidance->status_request == 'approved')
                                        <td class="text-center text-success text-capitalize">Disetujui</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="card-body pt-0">
                <p class="alert alert-info">Mahasiswa ini belum pernah melakukan bimbingan.</p>
            </div>
        @endif
        <div class="d-flex mb-4 ms-3" style="margin-top: -15px">
            <a href="{{ route('dashboard.student.edit', $student->id) }}" class="btn btn-primary ms-2">Edit Data</a>
            <a href="{{ route('dashboard.student.destroy', $student->id) }}" class="btn btn-danger ms-2"
                data-confirm-delete="true">Hapus Data</a>
            <a href="{{ route('dashboard.student.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
        </div>
    </div>
</x-dashboard-layout>
