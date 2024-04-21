<x-dashboard-layout title="Bimbingan">
    <x-slot name="header">
        Bimbingan
    </x-slot>

    @if ($examResult)
        <div class="card mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Status Pengajuan Ujian Hasil</h5>
                @if ($examResult->status_request == 'approved')
                    <a href="{{ route('dashboard.cetak-persetujuan-ujian') }}" class="btn btn-primary me-4">
                        <i class="fa fa-print me-0 me-md-2"></i>
                        <span class="d-none d-md-inline">Cetak Persetujuan Ujian</span>
                    </a>
                @endif
            </div>
            <div class="table-responsive text-wrap px-4 pb-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Judul Skripsi</th>
                            <th class="text-center text-nowrap">Tanggal Registrasi</th>
                            <th class="text-center text-nowrap">Persetujuan Ketua Jurusan</th>
                            @if ($examResult->status_request == 'pending')
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td class="fw-medium">{{ $examResult->thesis->title }}</td>
                            <td class="text-center">{{ $examResult->created_at->diffForHumans() }}</td>
                            @if ($examResult->status_request == 'pending')
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-info text-dark">Diajukan</span>
                                </td>
                            @elseif ($examResult->status_request == 'approved')
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-success">Disetujui</span>
                                </td>
                            @endif
                            @if ($examResult->status_request == 'pending')
                                <td class="text-center">
                                    <a href="{{ route('dashboard.ujian.destroy', $examResult->id) }}"
                                        data-confirm-delete="true">Batal</a>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if ($totalGuidance1 >= 6 && $totalGuidance2 >= 6)
        <div class="card mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Status Skripsi</h5>
                @if ($thesis->approval_lecturer_1 === 'approved' && $thesis->approval_lecturer_2 === 'approved' && !$examResult)
                    <form
                        action="{{ route('dashboard.ujian.store', [
                            'student_id' => $thesis->student_id,
                            'guidance_id' => $latestGuidance->id,
                            'thesis_id' => $thesis->id,
                        ]) }}"
                        method="post">
                        @csrf

                        <button type="submit" class="btn btn-primary me-4">Request Persetujuan Ujian</button>
                    </form>
                @endif

            </div>
            <div class="table-responsive text-wrap px-4 pb-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Judul Skripsi</th>
                            <th class="text-center">Persetujuan Pembimbing 1</th>
                            <th class="text-center">Persetujuan Pembimbing 2</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td class="fw-medium">{{ $thesis->title }}</td>
                            @if ($thesis->approval_lecturer_1 == 'pending')
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-info text-dark">Diajukan</span>
                                </td>
                            @elseif ($thesis->approval_lecturer_1 == 'approved')
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-success">Disetujui</span>
                                </td>
                            @endif
                            @if ($thesis->approval_lecturer_2 == 'pending')
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-info text-dark">Diajukan</span>
                                </td>
                            @elseif ($thesis->approval_lecturer_2 == 'approved')
                                <td class="text-center text-capitalize">
                                    <span class="badge bg-success">Disetujui</span>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Riwayat Bimbingan</h5>
        </div>
        <div class="table-responsive text-wrap px-4 pb-4">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">Bimbingan Ke</th>
                        <th class="text-center" style="width: 50px">Judul Skripsi</th>
                        <th class="text-center">Topik Bimbingan</th>
                        <th class="text-center">Tanggal Bimbingan</th>
                        <th class="text-center">Status Request</th>
                        <th class="text-center">Dosen Pembimbing</th>
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
                            <td class="text-nowrap">{{ $guidance->lecturer->fullname }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
