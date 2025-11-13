@extends('layouts.app')
@push('styles')<style> [data-bs-theme="dark"] .table-light { --bs-table-bg: #1f2937; --bs-table-color: #f9fafb; --bs-table-border-color: #374151; } .modal-content { background-color: rgba(255, 255, 255, 0.75); } [data-bs-theme="dark"] .modal-content { background-color: rgba(31, 41, 55, 0.75); } </style>@endpush

@section('konten')
@if(session('success'))<div class="alert alert-success alert-dismissible fade show">...</div>@endif
<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent border-bottom-0 p-3">
        <div class="d-flex justify-content-between align-items-center"><h4 class="card-title mb-0 fw-bold">Anggota Terdaftar</h4><button type="button" class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#anggotaModal"><i class="bi bi-plus-circle-fill me-2"></i>Tambah Anggota</button></div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggotas as $anggota)
                    <tr>
                        <th class="text-center">{{ $loop->iteration }}</th>
                        <td class="fw-medium">{{ $anggota->nama }}</td>
                        <td class="text-muted">{{ $anggota->telepon ?? '-' }}</td>
                        <td class="text-muted">{{ $anggota->alamat ?? '-' }}</td>
                        
                        <td class="text-center">
                            
                            @can('delete-anggota')
                                {{-- PERBAIKAN LOGIKA: Bandingkan ID anggota di loop dengan anggota_id milik admin yang login --}}
                                @if (auth()->user()->anggota_id !== $anggota->id)
                                    <form action="{{ route('anggota_destroy', $anggota->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini? Ini tidak dapat diurungkan.');">
                                        @csrf
                                        @method('DELETE')
                                        {{-- PERBAIKAN KECIL: Ubah teks di tombol --}}
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Anggota">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                @endif
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4"><div class="text-center py-5">... Data Anggota Belum Tersedia ...</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="anggotaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title fw-bold">Tambah Anggota Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form action="{{ route('anggota.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3"><label for="nama" class="form-label">Nama Anggota</label><input type="text" name="nama" class="form-control" required></div>
                    <div class="mb-3"><label for="telepon" class="form-label">No. Telepon (Opsional)</label><input type="text" name="telepon" class="form-control"></div>
                    <div class="mb-3"><label for="alamat" class="form-label">Alamat (Opsional)</label><textarea name="alamat" class="form-control" rows="3"></textarea></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>
@endsection