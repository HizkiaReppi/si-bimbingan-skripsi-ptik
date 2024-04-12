<x-dashboard-layout title="Manajemen Mahasiswa">
    <x-slot name="header">
        Manajemen Mahasiswa
    </x-slot>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Daftar Mahasiswa</h5>
            <a href="{{ route('dashboard.student.create') }}" class="btn btn-primary me-4">Tambah Mahasiswa</a>
        </div>
        <div class="table-responsive text-nowrap px-4 pb-4">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Angkatan</th>
                        <th class="text-center">Dosen Pembimbing 1</th>
                        <th class="text-center">Dosen Pembimbing 2</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($students as $student)
                        <tr>
                            <td class="fw-medium">{{ $student->fullname }}</td>
                            <td class="text-center">{{ $student->formattedNIM }}</td>
                            <td class="text-center">{{ $student->batch }}</td>
                            <td class="text-start">{{ $student->firstSupervisorFullname }}</td>
                            <td class="text-start">{{ $student->secondSupervisorFullname }}</td>
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
                                        <a class="dropdown-item"
                                            href="{{ route('dashboard.student.edit', $student->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('dashboard.student.destroy', $student->id) }}"
                                            data-confirm-delete="true">
                                            <i class="bx bx-trash me-1"></i> Delete
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
