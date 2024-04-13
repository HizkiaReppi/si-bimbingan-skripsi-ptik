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
                        <th class="text-center">Bimbingan Ke</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($guidances as $studentId => $guidanceList)
                        @foreach ($guidanceList as $guidance)
                            <tr>
                                <td class="fw-medium text-nowrap">{{ $guidance->student->formattedNIM }}</td>
                                <td>{{ $guidance->student->fullname }}</td>
                                <td class="text-center">{{ $guidance->topic }}</td>
                                <td class="text-center">{{ $guidance->schedule }}</td>
                                <td class="text-center">{{ $guidance->guidance_number }}</td>
                                @if ($guidance->status_request == 'pending')
                                    <td class="text-center text-info">Diajukan</td>
                                @elseif ($guidance->status_request == 'approved')
                                    <td class="text-center text-success">Disetujui</td>
                                @endif
                                <td class="text-center">
                                    <a class="dropdown-item"
                                        href="{{ route('dashboard.atur-jadwal-bimbingan.show', $guidance->id) }}">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
