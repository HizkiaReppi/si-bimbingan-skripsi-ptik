<x-dashboard-layout title="Pengajuan Ujian Hasil">
    <x-slot name="header">
        Pengajuan Ujian Hasil
    </x-slot>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Pengajuan Ujian Hasil Yang Menunggu Persetujuan</h5>
        </div>
        <div class="table-responsive text-wrap px-4 pb-4">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama Mahasiswa</th>
                        <th class="text-center">Dosen Pembimbing I</th>
                        <th class="text-center">Dosen Pembimbing II</th>
                        <th class="text-center">Judul Skripsi</th>
                        <th class="text-center">Tanggal Registrasi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($requestExams as $exam)
                        <tr>
                            <td class="text-center text-nowrap">{{ $exam->student->formattedNIM }}</td>
                            <td class="text-start">{{ $exam->student->fullname }}</td>
                            <td class="text-start">{{ $exam->student->firstSupervisorFullname }}</td>
                            <td class="text-start">{{ $exam->student->secondSupervisorFullname }}</td>
                            <td class="fw-medium">{{ $exam->thesis->title }}</td>
                            <td class="text-center">{{ $exam->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <a href="{{ route('dashboard.ujian.show', $exam->id) }}">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Pengajuan Ujian Hasil Yang Disetujui</h5>
        </div>
        <div class="table-responsive text-wrap px-4 pb-4">
            <table class="table" id="table-2">
                <thead>
                    <tr>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama Mahasiswa</th>
                        <th class="text-center">Dosen Pembimbing I</th>
                        <th class="text-center">Dosen Pembimbing II</th>
                        <th class="text-center">Judul Skripsi</th>
                        <th class="text-center">Tanggal Disetujui</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($approvedExams as $exam)
                        <tr>
                            <td class="text-center text-nowrap">{{ $exam->student->formattedNIM }}</td>
                            <td class="text-start">{{ $exam->student->fullname }}</td>
                            <td class="text-start">{{ $exam->student->firstSupervisorFullname }}</td>
                            <td class="text-start">{{ $exam->student->secondSupervisorFullname }}</td>
                            <td class="fw-medium">{{ $exam->thesis->title }}</td>
                            <td class="text-center">{{ $exam->updated_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <a href="{{ route('dashboard.ujian.show', $exam->id) }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
