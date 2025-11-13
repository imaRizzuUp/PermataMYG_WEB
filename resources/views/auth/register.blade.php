@extends('layouts.app')

{{-- Bagian @push('styles') tidak perlu diubah, bisa dibiarkan atau dihapus jika tidak ada styling lain --}}

@section('konten')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0 fw-bold">Buat Akun Admin Baru</h5></div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form id="registerForm" method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- ======================================================= -->
                    <!-- ========= BAGIAN NAMA YANG DIUBAH MENJADI DROPDOWN ========= -->
                    <!-- ======================================================= -->
                    <div class="mb-3">
                        <label for="anggota_id" class="form-label">Pilih Anggota</label>
                        <select id="anggota_id" name="anggota_id" class="form-select" required>
                            <option value="" disabled selected>-- Pilih dari daftar anggota --</option>
                            @foreach ($anggotas as $anggota)
                                <option value="{{ $anggota->id }}">{{ $anggota->nama }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">
                            Pilih nama anggota yang akan dibuatkan akun admin.
                        </div>
                    </div>
                    <!-- ======================================================= -->

                    <!-- Input nama dan hasil pencarian yang lama sudah dihapus -->

                    <div class="mb-3">
                        <label for="email_prefix" class="form-label">Email</label>
                        <div class="input-group">
                            <input id="email_prefix" type="text" class="form-control" placeholder="username" required>
                            <span class="input-group-text">@permatamyg.com</span>
                        </div>
                        <div class="form-text">
                            Cukup ketik username. <code>@permatamyg.com</code> akan ditambahkan otomatis.
                        </div>
                        <input id="email" type="hidden" name="email">
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select name="jabatan" class="form-select" required>
                            <option value="admin">Admin</option>
                            <option value="ketua">Ketua</option>
                            <option value="wakil ketua">Wakil Ketua</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="wakil sekretaris">Wakil Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                            <option value="wakil bendahara">Wakil Bendahara</option>
                            <option value="pimpinan bidang">Pimpinan Bidang</option>
                            <option value="kakak pembimbing">Kakak Pembimbing</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Daftarkan Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // KODE JAVASCRIPT UNTUK PENCARIAN NAMA SUDAH DIHAPUS KARENA TIDAK DIPERLUKAN LAGI

    // =======================================================
    // ========= LOGIKA UNTUK EMAIL (TETAP SAMA) =========
    // =======================================================
    const registerForm = document.getElementById('registerForm');
    const emailPrefixInput = document.getElementById('email_prefix');
    const fullEmailInput = document.getElementById('email');

    function updateFullEmail() {
        let prefix = emailPrefixInput.value;
        if (prefix.includes('@')) {
            prefix = prefix.split('@')[0];
            emailPrefixInput.value = prefix;
        }
        fullEmailInput.value = `${prefix.trim()}@permatamyg.com`;
    }

    emailPrefixInput.addEventListener('input', updateFullEmail);

    registerForm.addEventListener('submit', function() {
        updateFullEmail();
    });
});
</script>
@endpush