<x-dashboard-layout title="Bimbingan">
    <x-slot name="header">
        Bimbingan
    </x-slot>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Bimbingan Dengan Dosen Pembimbing {{ auth()?->user()?->student?->secondSupervisorFullname }}</h5>
            <div>
                @if ($guidances)
                <a href="{{ route('dashboard.bimbingan-2.print') }}" class="btn btn-secondary me-2">
                    <i class="fa fa-print me-2"></i>
                    Cetak Kartu Bimbingan
                </a>
                @endif
                <a href="{{ route('dashboard.bimbingan-2.create') }}" class="btn btn-primary me-4">Request Bimbingan</a>
            </div>
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
                                            href="{{ route('dashboard.bimbingan-2.show', $guidance->id) }}">
                                            <i class="bx bxs-user-detail me-1"></i> Detail
                                        </a>
                                        @if ($guidance->status_request == 'pending')
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.bimbingan-2.edit', $guidance->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.bimbingan-2.destroy', $guidance->id) }}"
                                                data-confirm-delete="true">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a>
                                        @endif
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
