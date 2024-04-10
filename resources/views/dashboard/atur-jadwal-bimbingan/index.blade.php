<x-dashboard-layout title="Atur Jadwal Bimbingan">
    <x-slot name="header">
        Atur Jadwal Bimbingan
    </x-slot>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Atur Jadwal Bimbingan</h5>
        </div>
        <div class="table-responsive text-wrap px-4 pb-4">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Topik Bimbingan</th>
                        <th class="text-center">Jadwal Yang Diajukan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($guidances as $guidance)
                        @if ($guidance != null)
                            @foreach ($guidance as $g)
                                <tr>
                                    <td class="fw-medium">{{ $g->student->nim }}</td>
                                    <td>{{ $g->student->fullname }}</td>
                                    <td class="text-center">{{ $g->topic }}</td>
                                    <td class="text-center">{{ $g->schedule }}</td>
                                    @if ($g->status == 'pending')
                                        <td class="text-center text-info">Diajukan</td>
                                    @elseif ($g->status == 'approved')
                                        <td class="text-center text-success">Disetujui</td>
                                    @elseif ($g->status == 'rejected')
                                        <td class="text-center text-danger">Ditolak</td>
                                    @endif
                                    <td class="text-center">
                                        <a class="dropdown-item"
                                            href="{{ route('dashboard.atur-jadwal-bimbingan.show', $g->id) }}">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">Belum Ada Mahasiswa Yang Mengajukan Bimbingan</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
