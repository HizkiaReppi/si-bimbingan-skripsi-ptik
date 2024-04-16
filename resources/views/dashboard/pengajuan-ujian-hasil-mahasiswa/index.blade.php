<x-dashboard-layout title="Pengajuan Ujian Hasil Mahasiswa">
    <x-slot name="header">
        Pengajuan Ujian Hasil Mahasiswa
    </x-slot>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Pengajuan Ujian Hasil Mahasiswa</h5>
        </div>
        <div class="table-responsive text-wrap px-4 pb-4">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama Mahasiswa</th>
                        <th class="text-center">Judul Skripsi</th>
                        <th class="text-center">Tanggal Registrasi</th>
                        <th class="text-center">Persetujuan Ketua Jurusan</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($requestExams as $exam)
                        <tr>
                            <td class="text-center text-nowrap">{{ $exam->student->formattedNIM }}</td>
                            <td class="text-start">{{ $exam->student->fullname }}</td>
                            <td class="fw-medium">{{ $exam->thesis->title }}</td>
                            <td class="text-center">{{ $exam->created_at->diffForHumans() }}</td>
                            @if ($exam->status_request == 'pending')
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-info text-dark">Menggunggu Tanggapan</span>
                                </td>
                            @elseif ($exam->status_request == 'approved')
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-success">Disetujui</span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
