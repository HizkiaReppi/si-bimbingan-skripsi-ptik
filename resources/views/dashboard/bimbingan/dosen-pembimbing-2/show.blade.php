<x-dashboard-layout title="Bimbingan">
    <x-slot name="header">
        Bimbingan
    </x-slot>

    <div class="card mb-4">
        <h5 class="card-header">Detail Bimbingan</h5>
        <div class="card-body">
            <div class="row">
                <div class="mb-3">
                    <label for="judul-skripsi" class="form-label">Judul Skripsi</label>
                    <p class="border p-2 rounded text-justify">{{ $bimbingan->thesis->title }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="schedule" class="form-label">Jadwal Bimbingan</label>
                    <p class="border p-2 rounded text-justify">{{ $bimbingan->schedule }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="status" class="form-label">Status Request</label>
                    <p class="border p-2 rounded text-justify text-capitalize">
                        @if ($bimbingan->status_request == 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-info text-dark">Diajukan</span>
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <label for="topik" class="form-label">Topik Yang Dibicarakan</label>
                    <p class="border p-2 rounded text-justify">{{ $bimbingan->topic }}</p>
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Dari Mahasiswa</label>
                    <p class="border p-2 rounded text-justify">
                        {{ $bimbingan->explanation ? $bimbingan->explanation : '-' }}</p>
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Dari Dosen</label>
                    <p class="border p-2 rounded text-justify">
                        {{ $bimbingan->lecturer_notes ? $bimbingan->lecturer_notes : '-' }}</p>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="thesis_file" class="form-label">File Skripsi</label>
                    <a href="{{ asset('storage/file/skripsi/' . $bimbingan->thesis_file) }}" download=""
                        class="d-block btn btn-primary">Download File</a>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="thesis_file_review" class="form-label">File Skripsi Setelah Direview</label>
                    @if ($bimbingan->thesis_file_review)
                        <a href="{{ asset('storage/file/skripsi/' . $bimbingan->thesis_file_review) }}" download=""
                            class="d-block btn btn-secondary" @disabled(true)>Download File</a>
                    @else
                        <button class="d-block btn btn-secondary" style="width: 100%" type="button">Download
                            File</button>
                    @endif
                </div>
            </div>
        </div>
        <hr style="margin-top: -10px">
        <div class="d-flex mb-4 ms-3 mt-3">
            @if ($bimbingan->status_request == 'pending')
                <a href="{{ route('dashboard.bimbingan-2.edit', $bimbingan->id) }}" class="btn btn-primary ms-2">Edit
                    Data</a>
                <a href="{{ route('dashboard.bimbingan-2.destroy', $bimbingan->id) }}" class="btn btn-danger ms-2"
                    data-confirm-delete="true">Hapus Data</a>
            @endif
            <a href="{{ route('dashboard.bimbingan-2.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
        </div>
    </div>
</x-dashboard-layout>
