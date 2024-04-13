<x-dashboard-layout title="Profil Saya">
    <x-slot name="header">
        Profil Saya
    </x-slot>

    @if ($user->role == 'admin')
        @include('profile.partials.update-profile-information-form-admin')
    @elseif($user->user->role == 'student')
        @include('profile.partials.update-profile-information-form-student')
    @elseif($user->user->role == 'lecturer' || $user->role == 'HoD')
        @include('profile.partials.update-profile-information-form-lecturer')
    @endif

    <div class="card">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
            <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                    <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                    <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
            </div>
            <button data-bs-toggle="modal" data-bs-target="#deleteAccountModal"
                class="btn btn-danger deactivate-account">Delete Account</button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteAccountModalLabel">
                        Apakah anda yakin ingin menghapus akun anda?
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    <div class="modal-body">
                        @csrf
                        @method('delete')
                        <p style="text-align: justify">
                            Saat akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
                        </p>

                        <div class="mt-6">
                            <label for="password" class="form-label">Password</label>

                            <input id="password" name="password" type="password" class="form-control"
                                placeholder="Password" autofocus required/>

                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Delete Account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
