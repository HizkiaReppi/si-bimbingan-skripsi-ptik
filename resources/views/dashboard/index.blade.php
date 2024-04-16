<x-dashboard-layout title="Dashboard">
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="card px-4 pt-4 pb-3 mb-4">
        <div class="row">
            <div class="col-md-3 col-6 mb-2">
                <div class="card p-1">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons fa-solid fa-chalkboard-user"></i>
                                <span class="fw-medium d-block mb-1">Total Dosen</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{ route('dashboard.lecturer.index') }}">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title mb-0 mt-3">{{ $totalLecturers }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="card p-1">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons fa-solid fa-user"></i>
                                <span class="fw-medium d-block mb-1">Total Mahasiswa</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{ route('dashboard.student.index') }}">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title mb-0 mt-3">{{ $totalStudents }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="card p-1">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons fa-solid fa-user"></i>
                                <span class="fw-medium d-block mb-1">Total Bimbingan</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{ route('dashboard.aktivitas-bimbingan.index') }}">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title mb-0 mt-3">{{ $totalGuidances }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <div class="card p-1">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="menu-icon tf-icons fa-solid fa-user"></i>
                                <span class="fw-medium d-block mb-1">Total Ujian Hasil</span>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{ route('dashboard.pengajuan-ujian-mahasiswa.index') }}">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title mb-0 mt-3">{{ $totalApprovedExamResults }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header px-0 py-1 mb-3 text-justify">Daftar Mahasiswa Yang Telah Melakukan Bimbingan</h5>
        </div>
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Judul Skripsi</th>
                        <th class="text-center">Dosen Pembimbing 1</th>
                        <th class="text-center">Dosen Pembimbing 2</th>
                        <th class="text-center">Total Bimbingan</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($studentsWithTheses as $studentsWithThesis)
                        <tr>
                            <td class="text-center text-nowrap">{{ $studentsWithThesis->formattedNIM }}</td>
                            <td class="fw-medium text-nowrap">{{ $studentsWithThesis->fullname }}</td>
                            <td class="text-justify">{{ $studentsWithThesis->thesisTitle }}</td>
                            <td class="text-left">{{ $studentsWithThesis->firstSupervisorFullname }}</td>
                            <td class="text-left">{{ $studentsWithThesis->secondSupervisorFullname }}</td>
                            <td class="text-center">{{ $studentsWithThesis->guidanceCount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
