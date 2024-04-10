<x-dashboard-layout title="Aktivitas Bimbingan">
    <x-slot name="header">
        Aktivitas Bimbingan
    </x-slot>

    <div class="card p-4">
        <div class="row">
            <div class="mb-2 col-md-6">
                <label for="judul-skripsi" class="form-label">Nama Mahasiswa</label>
                <p class="border p-2 rounded">{{ $aktivitas_bimbingan->student->fullname }}</p>
            </div>
            <div class="mb-2 col-md-6">
                <label for="judul-skripsi" class="form-label">NIM</label>
                <p class="border p-2 rounded">{{ $aktivitas_bimbingan->student->nim }}</p>
            </div>
            <div class="mb-2 col-md-6">
                <label for="judul-skripsi" class="form-label">Angkatan</label>
                <p class="border p-2 rounded">{{ $aktivitas_bimbingan->student->batch }}</p>
            </div>
            <div class="mb-2 col-md-6">
                <label for="judul-skripsi" class="form-label">Konsentrasi</label>
                <p class="border p-2 rounded">{{ $aktivitas_bimbingan->student->concentration }}</p>
            </div>
            <hr>
            <div class="mb-2">
                <label for="judul-skripsi" class="form-label">Judul Skripsi</label>
                <p class="border p-2 rounded text-justify">{{ $aktivitas_bimbingan->thesis_title }}</p>
            </div>
            <div class="mb-2">
                <label for="topik" class="form-label">Topik Yang Dibicarakan</label>
                <p class="border p-2 rounded text-justify">{{ $aktivitas_bimbingan->topic }}</p>
            </div>
            <div class="mb-2">
                <label for="catatan" class="form-label">Catatan Dari Mahasiswa</label>
                <p class="border p-2 rounded text-justify">
                    {{ $aktivitas_bimbingan->explanation ? $aktivitas_bimbingan->explanation : '-' }}</p>
            </div>
            <form action="{{ route('dashboard.aktivitas-bimbingan.update', $aktivitas_bimbingan->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="catatan-hasil-review" class="form-label">Catatan Hasil Review</label>
                    <textarea class="form-control {{ $errors->get('catatan-hasil-review') ? 'border-danger' : '' }}"
                        id="catatan-hasil-review" name="catatan-hasil-review" placeholder="Catatan Hasil Review"
                        value="{{ old('catatan-hasil-review') }}" rows="2"></textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('catatan-hasil-review')" />
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Jadwal Bimbingan <span
                                style="font-size:14px;color:red">*</span></label>
                        <input type="datetime-local"
                            class="form-control {{ $errors->get('jadwal') ? 'border-danger' : '' }}" id="jadwal"
                            placeholder="jadwal" name="jadwal"
                            value="{{ old('jadwal', $aktivitas_bimbingan->schedule) }}" required />
                        <x-input-error class="mt-2" :messages="$errors->get('jadwal')" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Status Request <span
                                style="font-size:14px;color:red">*</span></label>
                        <select class="form-select {{ $errors->get('status') ? 'border-danger' : '' }} text-capitalize"
                            name="status" id="status" required>
                            @foreach ($statuses as $key => $value)
                                @if (old('status', $aktivitas_bimbingan->status) == $key)
                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="thesis_file" class="form-label">File Skripsi</label>
                        <a href="{{ asset('storage/file/skripsi/' . $aktivitas_bimbingan->thesis_file) }}"
                            download="" class="d-block btn btn-secondary">Download File</a>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="thesis_file_review" class="form-label">File Skripsi Setelah Direview</label>
                        <input class="form-control" type="file" id="thesis_file_review" name="thesis_file_review"
                            accept=".pdf, .docx, .doc" />
                        <x-input-error class="mt-2" :messages="$errors->get('thesis_file_review')" />
                        <div id="form-help" class="form-text">
                            <small>PDF, DOCX, DOC (Max. 5 MB).</small>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Tanggapi Request Bimbingan</button>
                    <a href="{{ route('dashboard.aktivitas-bimbingan.index') }}"
                        class="btn btn-outline-secondary ms-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</x-dashboard-layout>
