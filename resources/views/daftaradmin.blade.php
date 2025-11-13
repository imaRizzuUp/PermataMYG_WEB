@extends('layouts.app')

@push('styles')
<style>
    /* Styling ini sudah bagus, tidak perlu diubah */
    [data-bs-theme="dark"] .table-light {
        --bs-table-bg: #1f2937;
        --bs-table-color: #f9fafb;
        --bs-table-border-color: #374151;
    }
</style>
@endpush

@section('konten')

{{-- Bagian notifikasi sukses ini sudah benar --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent border-bottom-0 p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0 fw-bold">Daftar Admin</h4>
            @can('create-admin')
                <a href="{{ route('form_register') }}" class="btn btn-primary fw-semibold">
                    <i class="bi bi-person-plus-fill me-2"></i>Tambah Admin
                </a>
            @endcan 
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- ======================================================= --}}
                    {{-- === BLOK PHP UNTUK SORTING SUDAH DIHAPUS SEMUA === --}}
                    {{-- === KITA LANGSUNG LOOP DATA DARI CONTROLLER === --}}
                    {{-- ======================================================= --}}
                    
                    @forelse ($admins as $admin)
                    <tr>
                        <td class="fw-medium">
                            {{-- Menggunakan nullsafe operator untuk keamanan data --}}
                            {{ $admin->anggota?->nama ?? 'Data Anggota Dihapus' }}
                        </td>
                        <td>
                            {{-- Menggunakan ucfirst() untuk membuat Jabatan terlihat lebih rapi (misal: "Admin", "Ketua") --}}
                            <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis">{{ ucfirst($admin->jabatan) }}</span>
                        </td>
                        <td class="text-muted">{{ $admin->email }}</td>

                        <td class="text-center">
                            
                            @can('delete-admin')
                               
                                @if (auth()->id() !== $admin->id)
                                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini? Ini tidak dapat diurungkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Admin">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                @endif
                            @endcan
                        </td>
                    </tr>
                    @empty
                        <tr>
                            
                            <td colspan="4">
                                <div class="text-center py-5">
                                    <i class="bi bi-person-x-fill fs-1 text-muted"></i>
                                    <h5 class="mt-3 fw-bold">Belum Ada Admin Terdaftar</h5>
                                    <p class="text-muted">Klik tombol "Tambah Admin" untuk mendaftarkan pengguna baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection