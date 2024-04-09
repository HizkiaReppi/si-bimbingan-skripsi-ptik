<x-dashboard-layout title="Tambah Data Mahasiswa">
    <x-slot name="header">
        Tambah Data Mahasiswa
    </x-slot>

    <div class="card p-4">
        <form method="post" action="{{ route('dashboard.student.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="fullname">Nama Lengkap <span
                        style="font-size:14px;color:red">*</span></label>
                <input type="text" class="form-control {{ $errors->get('fullname') ? 'border-danger' : '' }}"
                    id="fullname" name="fullname" placeholder="Nama Lengkap" value="{{ old('fullname') }}" autofocus
                    required />
                <x-input-error class="mt-2" :messages="$errors->get('fullname')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="nim">NIM <span style="font-size:14px;color:red">*</span></label>
                <input type="number" class="form-control {{ $errors->get('nim') ? 'border-danger' : '' }}"
                    id="nim" name="nim" placeholder="NIM" value="{{ old('nim') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('nim')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email <span style="font-size:14px;color:red">*</span></label>
                <input type="email" class="form-control {{ $errors->get('email') ? 'border-danger' : '' }}"
                    id="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="angkatan">Angkatan <span
                        style="font-size:14px;color:red">*</span></label>
                <input type="number" class="form-control {{ $errors->get('angkatan') ? 'border-danger' : '' }}"
                    id="angkatan" name="angkatan" placeholder="Angkatan" value="{{ old('angkatan') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('angkatan')" />
            </div>
            <div class="mb-3">
                <label for="konsentrasi" class="form-label">Konsentrasi <span
                        style="font-size:14px;color:red">*</span></label>
                <select class="form-select {{ $errors->get('konsentrasi') ? 'border-danger' : '' }}" id="konsentrasi"
                    name="konsentrasi" aria-label="Konsentrasi">
                    <option selected value="choose">Pilih Konsentrasi</option>
                    @foreach ($concentrations as $concentration)
                        @if (old('konsentrasi') == $concentration)
                            <option value="{{ $concentration }}" selected>{{ strtoupper($concentration) }}</option>
                        @else
                            <option value="{{ $concentration }}">{{ strtoupper($concentration) }}</option>
                        @endif
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('konsentrasi')" />
            </div>
            <div class="mb-3">
                <label for="lecturer_id" class="form-label">Dosen Pembimbing <span
                        style="font-size:14px;color:red">*</span></label>
                <x-select :options="$lecturers" key="fullname" placeholders="Pilih Dosen Pembimbing" id="lecturer_id"
                    name="lecturer_id" required />
                <x-input-error class="mt-2" :messages="$errors->get('lecturer_id')" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="no-hp">Nomor HP</label>
                <input type="number" class="form-control {{ $errors->get('no-hp') ? 'border-danger' : '' }}"
                    id="no-hp" name="no-hp" placeholder="Nomor HP" value="{{ old('no-hp') }}" />
                <x-input-error class="mt-2" :messages="$errors->get('no-hp')" />
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control {{ $errors->get('alamat') ? 'border-danger' : '' }}" id="alamat" name="alamat"
                    placeholder="Alamat" value="{{ old('alamat') }}" rows="2"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <img class="img-preview img-thumbnail rounded" style="width: 300px; height: auto;">
                <input class="form-control" type="file" id="foto" name="foto" accept=".png, .jpg, .jpeg" />
                <x-input-error class="mt-2" :messages="$errors->get('foto')" />
                <div id="form-help" class="form-text">
                    <small>PNG, JPG atau JPEG (Max. 2 MB).</small>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
                <a href="{{ route('dashboard.student.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </div>
        </form>
    </div>

    <script>
        const previewImage = () => {
            const image = document.querySelector("#foto");
            const imagePreview = document.querySelector(".img-preview");

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = (oFREvent) => {
                imagePreview.src = oFREvent.target.result;
                image.classList.add("mt-2");
            };
        };

        document.querySelector("#foto").addEventListener("change", previewImage);
    </script>

</x-dashboard-layout>
