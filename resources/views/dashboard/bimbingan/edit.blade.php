<x-dashboard-layout title="Request Bimbingan">
    <x-slot name="header">
        Request Bimbingan
    </x-slot>

    <div class="card p-4">
        <form method="post" action="{{ route('dashboard.bimbingan.update', $bimbingan->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mb-3">
                <label class="form-label" for="judul-skripsi">Judul Skripsi <span
                        style="font-size:14px;color:red">*</span></label>
                <input type="text" class="form-control {{ $errors->get('judul-skripsi') ? 'border-danger' : '' }}"
                    id="judul-skripsi" name="judul-skripsi" placeholder="Judul Skripsi"
                    value="{{ old('judul-skripsi', $bimbingan->thesis_title) }}" autofocus required />
                <x-input-error class="mt-2" :messages="$errors->get('judul-skripsi')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="topik">Topik Bimbingan <span
                        style="font-size:14px;color:red">*</span></label>
                <input type="text" class="form-control {{ $errors->get('topik') ? 'border-danger' : '' }}"
                    id="topik" name="topik" placeholder="Topik Bimbingan" value="{{ old('topik', $bimbingan->topic) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('topik')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="jadwal">Tanggal Bimbingan <span
                        style="font-size:14px;color:red">*</span></label>
                <input type="datetime-local" class="form-control {{ $errors->get('jadwal') ? 'border-danger' : '' }}"
                    id="jadwal" placeholder="jadwal" name="jadwal" value="{{ old('jadwal', $bimbingan->schedule) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('jadwal')" />
            </div>
            <div class="mb-3">
                <label for="file-skripsi" class="form-label">File Skripsi</label>
                <input class="form-control" type="file" id="file-skripsi" name="file-skripsi"
                    accept=".pdf, .docx, .doc" value="{{ old('file-skripsi', $bimbingan->thesis_file) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('file-skripsi')" />
                <div id="form-help" class="form-text">
                    <small>PDF, DOCX, DOC (Max. 5 MB).</small>
                </div>
            </div>
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control {{ $errors->get('catatan') ? 'border-danger' : '' }}" id="catatan" name="catatan"
                    placeholder="Catatan Bimbingan" value="{{ old('catatan', $bimbingan->explanation) }}" rows="2"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('catatan')" />
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Edit Request Bimbingan</button>
                <a href="{{ route('dashboard.bimbingan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </div>
        </form>
    </div>

</x-dashboard-layout>
