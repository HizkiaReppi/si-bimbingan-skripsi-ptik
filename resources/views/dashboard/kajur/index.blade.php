<x-dashboard-layout title="Manajemen Ketua Jurusan">
    <x-slot name="header">
        Manajemen Ketua Jurusan
    </x-slot>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Ketua Jurusan</h5>
            <a href="{{ route('dashboard.kajur.create') }}" class="btn btn-primary me-4">
                {{ $kajur ? 'Ganti' : 'Tambah'}} Ketua Jurusan
            </a>
        </div>
        <div class="table-responsive text-nowrap px-4 pb-4">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIDN</th>
                        <th class="text-center">NIP</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        @if ($kajur)
                            <td class="fw-medium">{{ $kajur->fullname }}</td>
                            <td class="text-center">{{ $kajur->nidn }}</td>
                            <td class="text-center">{{ $kajur->formattedNIP }}</td>
                            <td class="d-flex justify-content-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('dashboard.kajur.show', $kajur->id) }}">
                                            <i class="bx bxs-user-detail me-1"></i> Detail
                                        </a>
                                        <a class="dropdown-item" href="{{ route('dashboard.kajur.edit', $kajur->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('dashboard.kajur.destroy', $kajur->id) }}"
                                            data-confirm-delete="true">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        @else
                            <td colspan="4" class="text-center">Belum Ada Data Ketua Jurusan</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
