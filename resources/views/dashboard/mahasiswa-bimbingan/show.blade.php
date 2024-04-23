<x-dashboard-layout title="Detail Mahasiswa Bimbingan">
    <x-slot name="header">
        Detail Mahasiswa Bimbingan
    </x-slot>

    <div class="card mb-3">
        <h5 class="card-header">Detail Mahasiswa Bimbingan</h5>
        <div class="card-body pb-1">
            <div class="row">
                <div class="mb-1 col-md-6">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <p class="border p-2 rounded">{{ $mahasiswa_bimbingan->fullname }}</p>
                </div>
                <div class="mb-1 col-md-6">
                    <label for="nim" class="form-label">NIM</label>
                    <p class="border p-2 rounded">{{ $mahasiswa_bimbingan->formattedNIM }}</p>
                </div>
                <div class="mb-1 col-md-6">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <p class="border p-2 rounded">{{ $mahasiswa_bimbingan->batch }}</p>
                </div>
                <div class="mb-1 col-md-6">
                    <label for="konsentrasi" class="form-label">Konsentrasi</label>
                    <p class="border p-2 rounded">{{ $mahasiswa_bimbingan->concentration }}</p>
                </div>
                <div class="mb-1 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <p class="border p-2 rounded">
                        {{ $mahasiswa_bimbingan->user->email ? $mahasiswa_bimbingan->user->email : '-' }}</p>
                </div>
                <div class="mb-1 col-md-6">
                    <label for="no-hp" class="form-label">Nomor HP</label>
                    <p class="border p-2 rounded">
                        {{ $mahasiswa_bimbingan->phone_number ? $mahasiswa_bimbingan->phone_number : '-' }}</p>
                </div>
                <div class="mb-1 col-md-6">
                    <label for="no-hp" class="form-label">Jumlah Bimbingan</label>
                    <p class="border p-2 rounded">
                        {{ $mahasiswa_bimbingan->guidanceCount ? $mahasiswa_bimbingan->guidanceCount : '-' }}</p>
                </div>
                <div class="mb-1 col-md-6">
                    <label for="no-hp" class="form-label">Tanggal Bimbingan Terakhir</label>
                    <p class="border p-2 rounded">
                        {{ $mahasiswa_bimbingan->guidance->last()?->schedule ? $mahasiswa_bimbingan->guidance->last()->schedule : '-' }}
                    </p>
                </div>
                <div class="mb-1">
                    <label for="judul-skripsi" class="form-label">Judul Skripsi</label>
                    <p class="border p-2 rounded text-justify">{{ $mahasiswa_bimbingan->thesis->title }}</p>
                </div>
                <div class="mb-1">
                    <label for="alamat" class="form-label">Alamat</label>
                    <p class="border p-2 rounded">
                        {{ $mahasiswa_bimbingan->address ? $mahasiswa_bimbingan->address : '-' }}</p>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 px-4 mb-4">
            @php
                $phone_number = preg_replace('/^0/', '62', $mahasiswa_bimbingan->phone_number);
            @endphp
            @if ($mahasiswa_bimbingan->phone_number)
                <a href="tel:+{{ $phone_number }}" class="d-flex align-items-center btn btn-outline-secondary">
                    <i class="fa-solid fa-phone me-2"></i>
                    Telepon
                </a>
                <a href="https://wa.me/{{ $phone_number }}"
                    class="d-flex align-items-center btn btn-outline-secondary">
                    <i class="fa fa-whatsapp me-2"></i>
                    Whatsapp
                </a>
            @endif
            @if ($mahasiswa_bimbingan->user->email)
                <a href="mailto:{{ $mahasiswa_bimbingan->user->email }}"
                    class="d-flex align-items-center btn btn-outline-secondary">
                    <i class="fa-regular fa-envelope me-2"></i>
                    Email
                </a>
            @endif
        </div>
        @if (count($guidances) < 1)
            <div class="px-4 mb-4">
                <div class="alert alert-info" role="alert">
                    Mahasiswa ini belum pernah melakukan bimbingan.
                </div>
            </div>
        @else
            <hr class="border border-1">
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
                                <td class="fw-medium" style="width: 50px">{{ $guidance->thesis->title }}</td>
                                <td class="fw-medium">{{ $guidance->topic }}</td>
                                <td class="text-center">{{ $guidance->schedule }}</td>
                                @if ($guidance->status_request == 'pending')
                                    <td class="text-center text-info text-capitalize">Diajukan</td>
                                @elseif ($guidance->status_request == 'approved')
                                    <td class="text-center text-success text-capitalize">Disetujui</td>
                                @endif
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.atur-jadwal-bimbingan.show', $guidance->id) }}">
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
        @endif
        <hr style="margin-top: -10px">
        <div class="d-flex mb-4 ms-3 mt-3">
            <a href="{{ route('dashboard.mahasiswa-bimbingan.index') }}"
                class="btn btn-outline-secondary ms-2">Kembali</a>
        </div>
    </div>
</x-dashboard-layout>
