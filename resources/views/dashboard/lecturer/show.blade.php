<x-dashboard-layout title="Manajemen Dosen">
    <x-slot name="header">
        Manajemen Dosen
    </x-slot>

    <div class="card mb-4">
        <h5 class="card-header">Detail Dosen</h5>
        <div class="card-body" style="margin-bottom: -20px">
            <div class="d-flex flex-column align-items-start gap-4">
                <label for="foto" class="form-label" style="margin-bottom: -10px">Foto</label>
                @if ($dosen->user->photo == null)
                    <p class="border p-5 rounded" style="margin-bottom: -15px">Tidak Ada Foto</p>
                @else
                    <img src="{{ $dosen->user->photoFile }}"
                        alt="{{ $dosen->fullname }}" class="d-block rounded" style="width: 250px" id="foto" />
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="firstName" class="form-label">Nama Lengkap</label>
                    <p class="border p-2 rounded m-0">{{ $dosen->fullname }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <p class="border p-2 rounded m-0">{{ $dosen->user->email }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="no-hp" class="form-label">Nomor HP</label>
                    <p class="border p-2 rounded m-0">{{ $dosen->phone_number ?? '-' }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nip" class="form-label">NIP</label>
                    <p class="border p-2 rounded m-0">{{ $dosen->formattedNIP }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nidn" class="form-label">NIDN</label>
                    <p class="border p-2 rounded m-0">{{ $dosen->nidn }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="pangkat" class="form-label">Pangkat</label>
                    <p class="border p-2 rounded m-0">{{ $dosen->rank ?? '-' }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <p class="border p-2 rounded m-0">{{ $dosen->position ?? '-' }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="golongan" class="form-label">Golongan</label>
                    <p class="border p-2 rounded m-0">{{ $dosen->type ?? '-' }}</p>
                </div>
            </div>
            <hr>
            <div>
                <h5>Daftar Mahasiswa Bimbingan</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Nama</th>
                                <th class="text-center">NIM</th>
                                <th class="text-center">Angkatan</th>
                                <th class="text-center">Konsentrasi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($students as $student)
                                <tr>
                                    <td class="fw-medium">{{ $student->user->name }}</td>
                                    <td class="text-center text-nowrap">{{ $student->formattedNIM }}</td>
                                    <td class="text-center">{{ $student->batch }}</td>
                                    <td class="text-center">{{ $student->concentration }}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.student.show', $student->id) }}">
                                                    <i class="bx bxs-user-detail me-1"></i> Detail
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
        </div>
        <!-- /Account -->
        <div class="d-flex mb-4 ms-3" style="margin-top: -15px">
            <a href="{{ route('dashboard.lecturer.edit', $dosen->id) }}" class="btn btn-primary ms-2">Edit Data</a>
            <a href="{{ route('dashboard.lecturer.destroy', $dosen->id) }}" class="btn btn-danger ms-2"
                data-confirm-delete="true">Hapus Data</a>
            <a href="{{ route('dashboard.lecturer.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
        </div>
    </div>
</x-dashboard-layout>
