@extends('layouts.app')

@push('styles')
<style>
    /* Perbaikan untuk header tabel di mode malam */
    [data-bs-theme="dark"] .table-light {
        --bs-table-bg: #1f2937;
        --bs-table-color: #f9fafb;
        --bs-table-border-color: #374151;
    }

    /* CSS untuk efek modal transparan (kaca) */
    .modal-content {
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .modal-header, .modal-footer {
        border-color: rgba(0, 0, 0, 0.1);
    }
    [data-bs-theme="dark"] .modal-content {
        background-color: rgba(31, 41, 55, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    [data-bs-theme="dark"] .modal-header,
    [data-bs-theme="dark"] .modal-footer {
        border-color: rgba(255, 255, 255, 0.1);
    }

    /* ============================================== */
    /* === STYLE UNTUK FILTER DENGAN SLIDER ANIMASI === */
    /* ============================================== */
    .filter-nav-container {
        position: relative;
        display: inline-flex;
        background-color: var(--hover-bg);
        border-radius: 0.85rem;
        padding: 5px;
        box-shadow: var(--shadow);
    }
    .filter-nav-btn {
        border: none;
        background: transparent;
        color: var(--text-secondary);
        font-weight: 500;
        padding: 8px 20px;
        cursor: pointer;
        position: relative;
        z-index: 1;
        transition: color 0.3s ease;
    }
    .filter-nav-btn.active {
        color: #fff;
    }
    [data-bs-theme="dark"] .filter-nav-btn.active {
        color: var(--bs-body-color);
    }
    .filter-slider {
        position: absolute;
        top: 5px;
        left: 5px;
        height: calc(100% - 10px);
        background-color: var(--primary-color);
        border-radius: 0.75rem;
        z-index: 0;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
</style>
@endpush


@section('konten')

{{-- Bagian untuk menampilkan pesan sukses atau error --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert"><h5 class="alert-heading fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i>Terjadi Kesalahan!</h5><ul class="mb-0 ps-4">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
@endif


<!-- ============================================== -->
<!-- ========= BAGIAN FILTER BARU SESUAI CONTOH ========= -->
<!-- ============================================== -->
<div class="d-flex justify-content-center mb-4">
    <div class="filter-nav-container">
        <div class="filter-slider"></div>
        <button type="button" class="filter-nav-btn active" data-filter="all">Semua</button>
        <button type="button" class="filter-nav-btn" data-filter="menunggu">Menunggu</button>
        <button type="button" class="filter-nav-btn" data-filter="berhasil">Berhasil</button>
        <button type="button" class="filter-nav-btn" data-filter="gagal">Gagal</button>
    </div>
</div>

{{-- CARD UTAMA DENGAN DESAIN BARU --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent border-bottom-0 p-3">
        <div class="d-flex justify-content-between align-items-center"><h4 class="card-title mb-0 fw-bold">Manajemen Jadwal Ibadah</h4><button type="button" class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#jadwalModal"><i class="bi bi-plus-circle-fill me-2"></i>Tambah Jadwal</button></div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th>Nama Ibadah</th><th>Lokasi</th><th>Tanggal</th>
                        <th class="text-center">Status</th><th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwalIbadahs as $jadwal) 
                        <tr data-status="{{ $jadwal->status }}">
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <td class="fw-medium">{{ $jadwal->nama_ibadah }}</td>
                            <td class="text-muted">{{ $jadwal->lokasi_ibadah }}</td>
                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_ibadah)->isoFormat('dddd, D MMMM YYYY') }}</td>
                            <td class="text-center">
                                @if ($jadwal->status == 'berhasil')<span class="badge rounded-pill bg-success-subtle text-success-emphasis">{{ ucfirst($jadwal->status) }}</span>
                                @elseif ($jadwal->status == 'gagal')<span class="badge rounded-pill bg-danger-subtle text-danger-emphasis">{{ ucfirst($jadwal->status) }}</span>
                                @else<span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">{{ ucfirst($jadwal->status) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-warning edit-btn" data-bs-toggle="modal" data-bs-target="#jadwalModal" data-bs-placement="top" title="Edit Jadwal"
                                        data-id="{{ $jadwal->id }}" data-nama="{{ $jadwal->nama_ibadah }}" data-lokasi="{{ $jadwal->lokasi_ibadah }}" data-tanggal="{{ $jadwal->tanggal_ibadah }}" data-status="{{ $jadwal->status }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('jadwal-ibadah.destroy', $jadwal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Kamu yakin mau hapus jadwal ini? Tidak bisa dikembalikan lho.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Jadwal"><i class="bi bi-trash3-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"><div class="text-center py-5"><i class="bi bi-calendar-x fs-1 text-muted"></i><h5 class="mt-3 fw-bold">Data Jadwal Belum Tersedia</h5><p class="text-muted">Silakan tambahkan jadwal ibadah baru untuk menampilkannya di sini.</p></div></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Create & Edit (Tidak ada perubahan di sini) -->
<div class="modal fade" id="jadwalModal" tabindex="-1" aria-labelledby="jadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title fw-bold" id="jadwalModalLabel">Tambah Jadwal Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <form id="jadwalForm" method="POST" action="">
                @csrf
                <div id="method-field"></div>
                <div class="modal-body">
                    <div class="mb-3"><label for="nama_ibadah" class="form-label">Nama Ibadah</label><input type="text" class="form-control" id="nama_ibadah" name="nama_ibadah" required placeholder="Contoh: Ibadah Minggu Pagi"></div>
                    <div class="mb-3"><label for="lokasi_ibadah" class="form-label">Lokasi Ibadah</label><input type="text" class="form-control" id="lokasi_ibadah" name="lokasi_ibadah" required placeholder="Contoh: Gedung Gereja"></div>
                    <div class="mb-3"><label for="tanggal_ibadah" class="form-label">Tanggal Ibadah</label><input type="date" class="form-control" id="tanggal_ibadah" name="tanggal_ibadah" required></div>
                    <div class="mb-3" id="status-group">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="menunggu">Menunggu</option><option value="berhasil">Berhasil</option><option value="gagal">Gagal</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary fw-semibold">Simpan Data</button></div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- LOGIKA MODAL (Sama seperti sebelumnya) ---
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    const jadwalModal = document.getElementById('jadwalModal');
    const modalTitle = document.getElementById('jadwalModalLabel');
    const jadwalForm = document.getElementById('jadwalForm');
    const methodField = document.getElementById('method-field');
    const statusGroup = document.getElementById('status-group');

    @if ($errors->any()) new bootstrap.Modal(jadwalModal).show(); @endif

    jadwalModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        jadwalForm.reset(); methodField.innerHTML = '';
        const id = button.getAttribute('data-id');
        if (id) {
            modalTitle.textContent = 'Edit Jadwal Ibadah';
            jadwalForm.action = `{{ url('jadwal-ibadah') }}/${id}`;
            methodField.innerHTML = `@method('PUT')`;
            statusGroup.style.display = 'block';
            document.getElementById('nama_ibadah').value = button.dataset.nama;
            document.getElementById('lokasi_ibadah').value = button.dataset.lokasi;
            document.getElementById('tanggal_ibadah').value = button.dataset.tanggal;
            document.getElementById('status').value = button.dataset.status;
        } else {
            modalTitle.textContent = 'Tambah Jadwal Baru';
            jadwalForm.action = `{{ route('jadwal-ibadah.store') }}`;
            statusGroup.style.display = 'none';
        }
    });

    // --- LOGIKA FILTER BARU, 100% VIA JAVASCRIPT ---
    const filterButtons = document.querySelectorAll('.filter-nav-btn');
    const slider = document.querySelector('.filter-slider');
    const allTableRows = document.querySelectorAll('.table tbody tr');

    function moveSlider(targetButton) {
        if (!targetButton) return;
        const targetRect = targetButton.getBoundingClientRect();
        const containerRect = targetButton.parentElement.getBoundingClientRect();
        slider.style.width = `${targetRect.width}px`;
        slider.style.transform = `translateX(${targetRect.left - containerRect.left}px)`;
    }

    // Pindahkan slider ke tombol aktif saat halaman dimuat
    const initialActiveButton = document.querySelector('.filter-nav-btn.active');
    if (initialActiveButton) {
        moveSlider(initialActiveButton);
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Pindahkan slider & atur kelas 'active'
            moveSlider(this);
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            // Logika untuk menampilkan/menyembunyikan baris tabel
            allTableRows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (filterValue === 'all' || rowStatus === filterValue) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        });
    });

    // Sesuaikan posisi slider saat ukuran jendela berubah
    window.addEventListener('resize', () => {
        const currentActiveButton = document.querySelector('.filter-nav-btn.active');
        if (currentActiveButton) {
            moveSlider(currentActiveButton);
        }
    });
});
</script>
@endpush