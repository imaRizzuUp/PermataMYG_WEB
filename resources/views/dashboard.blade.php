@extends('layouts.app')

@section('konten')

{{-- SALAM PEMBUKA --}}
<div class="mb-4">
    <h3 class="fw-bold">Selamat Datang, {{ auth()->user()->anggota->nama }}!</h3>
    <p class="text-muted">Ini adalah ringkasan aktivitas di aplikasi Anda.</p>
</div>

{{-- KARTU STATISTIK UTAMA --}}
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary-subtle text-primary-emphasis p-3 rounded-3 me-3">
                    <i class="bi bi-people-fill fs-2"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Total Admin</p>
                    <h4 class="fw-bold mb-0">{{ $jumlahAdmin }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="bg-info-subtle text-info-emphasis p-3 rounded-3 me-3">
                    <i class="bi bi-newspaper fs-2"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Total Berita</p>
                    <h4 class="fw-bold mb-0">{{ $jumlahBerita }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="bg-success-subtle text-success-emphasis p-3 rounded-3 me-3">
                    <i class="bi bi-calendar2-check-fill fs-2"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Total Jadwal</p>
                    <h4 class="fw-bold mb-0">{{ $jumlahJadwalTotal }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="bg-warning-subtle text-warning-emphasis p-3 rounded-3 me-3">
                    <i class="bi bi-hourglass-split fs-2"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Jadwal Menunggu</p>
                    <h4 class="fw-bold mb-0">{{ $jumlahJadwalMenunggu }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- DUA KOLOM UTAMA: JADWAL & BERITA --}}
<div class="row g-4">
    {{-- KOLOM KIRI: JADWAL IBADAH MENDATANG --}}
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold">Jadwal Ibadah Berikutnya</h5>
                <a href="{{ route('jadwal-ibadah.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
            </div>
            <div class="card-body">
                @forelse ($jadwalBerikutnya as $jadwal)
                    <div class="d-flex align-items-center {{ !$loop->last ? 'mb-3 pb-3 border-bottom' : '' }}">
                        <div class="bg-primary-subtle text-primary-emphasis rounded-3 text-center me-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                            <div class="fs-5 fw-bold lh-1 pt-1">{{ \Carbon\Carbon::parse($jadwal->tanggal_ibadah)->format('d') }}</div>
                            <div class="small text-uppercase">{{ \Carbon\Carbon::parse($jadwal->tanggal_ibadah)->format('M') }}</div>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-0 text-truncate">{{ $jadwal->nama_ibadah }}</h6>
                            <small class="text-muted d-block text-truncate"><i class="bi bi-geo-alt-fill me-1"></i>{{ $jadwal->lokasi_ibadah }}</small>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="bi bi-calendar-x fs-2 text-muted"></i>
                        <p class="mt-2 text-muted">Tidak ada jadwal mendatang.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- KOLOM KANAN: BERITA TERBARU --}}
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold">Berita Terbaru</h5>
                <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <tbody>
                            @forelse ($beritaTerbaru as $berita)
                                <tr>
                                    <td>
                                        <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://via.placeholder.com/150x90' }}" 
                                             alt="Gambar" 
                                             style="width: 70px; height: 45px; object-fit: cover; border-radius: 0.5rem;">
                                    </td>
                                    <td class="fw-medium">
                                        <a href="{{ route('berita.index') }}" class="text-decoration-none text-body">{{ $berita->judul }}</a>
                                    </td>
                                    <td class="text-muted text-end">
                                        {{ $berita->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="text-center py-5">
                                            <i class="bi bi-newspaper fs-2 text-muted"></i>
                                            <p class="mt-2 text-muted">Belum ada berita yang dipublikasikan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection