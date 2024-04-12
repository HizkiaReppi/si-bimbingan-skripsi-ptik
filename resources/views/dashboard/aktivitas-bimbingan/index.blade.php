<x-dashboard-layout title="Aktivitas Bimbingan">
    <x-slot name="header">
        Aktivitas Bimbingan
    </x-slot>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Aktivitas Bimbingan Mahasiswa</h5>
        </div>
        <div class="table-responsive text-wrap px-4 pb-4">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama Mahasiswa</th>
                        <th class="text-center">Dosen Pembimbing</th>
                        <th class="text-center">Bimbingan Ke</th>
                        <th class="text-center">Topik Bimbingan</th>
                        <th class="text-center">Tanggal Bimbingan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($guidances as $guidance)
                        <tr>
                            <td class="text-center">{{ $guidance->student->nim }}</td>
                            <td>{{ $guidance->student->fullname }}</td>
                            <td>{{ $guidance->lecturer->fullname }}</td>
                            <td class="text-center">{{ $guidance->guidance_number }}</td>
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
</x-dashboard-layout>
