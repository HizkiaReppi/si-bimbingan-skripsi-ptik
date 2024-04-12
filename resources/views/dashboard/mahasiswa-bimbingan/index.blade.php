<x-dashboard-layout title="Daftar Mahasiswa Bimbingan">
    <x-slot name="header">
        Daftar Mahasiswa Bimbingan
    </x-slot>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Daftar Mahasiswa Bimbingan</h5>
        </div>
        <div class="table-responsive text-wrap px-4 pb-4">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama Lengkap</th>
                        <th class="text-center">Angkatan</th>
                        <th class="text-center">Konsentrasi</th>
                        <th class="text-center">Judul Skripsi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($students as $student)
                        <tr>
                            <td class="text-center fw-medium">{{ $student->formattedNIM }}</td>
                            <td class="text-nowrap">{{ $student->fullname }}</td>
                            <td class="text-center">{{ $student->batch }}</td>
                            <td class="text-center">{{ $student->concentration }}</td>
                            <td class="text-justify">{{ $student->thesisTitle }}</td>
                            <td class="text-center">
                                <a class="dropdown-item"
                                    href="{{ route('dashboard.mahasiswa-bimbingan.show', $student->id) }}">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
