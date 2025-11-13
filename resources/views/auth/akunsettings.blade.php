@extends('layouts.app')

@section('konten')

<div class="row gy-4">
    {{-- Update Profil --}}
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0 fw-bold">Informasi Profil</h5></div>
            <div class="card-body">
                <p class="text-muted">Perbarui informasi profil dan alamat email akun Anda.</p>
                <form method="post" action="{{ route('account.updateProfile') }}" class="mt-4">
                    @csrf @method('put')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input id="nama" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $user->nama) }}" required autofocus>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        @if (session('status') === 'profile-updated')<p class="text-success fw-medium mb-0">Tersimpan.</p>@endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Update Password --}}
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0 fw-bold">Perbarui Password</h5></div>
            <div class="card-body">
                <p class="text-muted">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
                <form method="post" action="{{ route('account.updatePassword') }}" class="mt-4">
                    @csrf @method('put')
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input id="current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" required>
                        @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input id="password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" required>
                         @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        @if (session('status') === 'password-updated')<p class="text-success fw-medium mb-0">Tersimpan.</p>@endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Hapus Akun --}}
    <div class="col-12">
        <div class="card border-danger">
            <div class="card-header bg-danger-subtle text-danger-emphasis"><h5 class="card-title mb-0 fw-bold">Hapus Akun</h5></div>
            <div class="card-body">
                <p class="text-muted">Setelah akun Anda dihapus, semua datanya akan dihapus permanen.</p>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">Hapus Akun</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Akun -->
<div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{ route('account.destroy') }}">
                @csrf @method('delete')
                <div class="modal-header"><h5 class="modal-title fw-bold">Yakin ingin menghapus akun Anda?</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <p class="text-muted">Setelah akun dihapus, semua data akan hilang permanen. Masukkan password Anda untuk konfirmasi.</p>
                    <div class="mt-3">
                        <label for="password-delete" class="form-label">Password</label>
                        <input id="password-delete" name="password" type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Password" required>
                        @error('password', 'userDeletion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger">Hapus Akun</button></div>
            </form>
        </div>
    </div>
</div>
@endsection