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
    
    /* Style untuk filter dengan slider animasi */
    .filter-nav-container { position: relative; display: inline-flex; background-color: var(--hover-bg); border-radius: 0.85rem; padding: 5px; box-shadow: var(--shadow); }
    .filter-nav-btn { border: none; background: transparent; color: var(--text-secondary); font-weight: 500; padding: 8px 20px; cursor: pointer; position: relative; z-index: 1; transition: color 0.3s ease; }
    .filter-nav-btn.active { color: #fff; }
    [data-bs-theme="dark"] .filter-nav-btn.active { color: var(--bs-body-color); }
    .filter-slider { position: absolute; top: 5px; left: 5px; height: calc(100% - 10px); background-color: var(--primary-color); border-radius: 0.75rem; z-index: 0; transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); }
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
<!-- ========= BAGIAN FILTER BARU UNTUK BERITA ========= -->
<!-- ============================================== -->
<div class="d-flex justify-content-center mb-4">
    <div class="filter-nav-container">
        <div class="filter-slider"></div>
        <button type="button" class="filter-nav-btn active" data-filter="all">Semua</button>
        <button type="button" class="filter-nav-btn" data-filter="terbaru">Berita Terbaru</button>
        <button type="button" class="filter-nav-btn" data-filter="terlama">Berita Terlama</button>
    </div>
</div>

{{-- CARD UTAMA DENGAN DESAIN MODERN --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent border-bottom-0 p-3">
        <div class="d-flex justify-content-between align-items-center"><h4 class="card-title mb-0 fw-bold">Manajemen Berita</h4><button type="button" class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#beritaModal"><i class="bi bi-plus-circle-fill me-2"></i>Buat Berita</button></div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th style="width: 15%;">Gambar</th>
                        <th>Judul Berita</th>
                        <th>Tanggal Publikasi</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                {{-- ID ditambahkan ke tbody untuk diakses oleh JS --}}
                <tbody id="berita-table-body"> 
                    @forelse($beritas as $berita)
                        {{-- Atribut data-timestamp ditambahkan ke <tr> untuk pengurutan --}}
                        <tr data-timestamp="{{ $berita->created_at->timestamp }}">
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://via.placeholder.com/150x90' }}" 
                                     alt="Gambar {{ $berita->judul }}" 
                                     style="width: 100px; height: 60px; object-fit: cover; border-radius: 0.5rem;">
                            </td>
                            <td class="fw-medium">{{ $berita->judul }}</td>
                            <td class="text-muted">{{ $berita->created_at->isoFormat('D MMMM YYYY') }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-warning edit-btn"
                                        data-bs-toggle="modal" data-bs-target="#beritaModal"
                                        data-bs-placement="top" title="Edit Berita"
                                        data-id="{{ $berita->id }}" 
                                        data-judul="{{ $berita->judul }}" 
                                        data-isi="{{ $berita->isi }}"
                                        data-gambar="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : '' }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Berita">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"><div class="text-center py-5"><i class="bi bi-newspaper fs-1 text-muted"></i><h5 class="mt-3 fw-bold">Belum Ada Berita</h5><p class="text-muted">Klik tombol "Buat Berita" untuk menambahkan berita pertama.</p></div></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Create & Edit (Tidak ada perubahan) -->
<div class="modal fade" id="beritaModal" tabindex="-1" aria-labelledby="beritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title fw-bold" id="beritaModalLabel">Buat Berita Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <form id="beritaForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div id="method-field"></div>
                <div class="modal-body">
                    <div class="mb-3"><label for="judul" class="form-label">Judul Berita</label><input type="text" class="form-control" id="judul" name="judul" required></div>
                    <div class="mb-3"><label for="gambar" class="form-label" id="gambarLabel">Gambar Sampul</label><input class="form-control" type="file" id="gambar" name="gambar" accept="image/*"><div class="form-text" id="gambarHelperText"></div><div id="gambar-preview-container" class="mt-2" style="display: none;"><img id="gambar-preview" src="" alt="Gambar saat ini" style="max-height: 100px; border-radius: 0.5rem;"></div></div>
                    <div class="mb-3"><label for="isi" class="form-label">Isi Berita</label><textarea class="form-control" id="isi" name="isi" rows="8" required></textarea></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button><button type="submit" class="btn btn-primary fw-semibold" id="submitButton">Publikasikan</button></div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- LOGIKA MODAL (Sama seperti sebelumnya, disesuaikan dengan route-mu) ---
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    const beritaModal = document.getElementById('beritaModal');
    // ... (sisa deklarasi variabel modal)
    
    // ... (kode event listener untuk modal show.bs.modal, tidak berubah) ...
    // Pastikan action form di sini sudah benar sesuai route-mu:
    // create: beritaForm.action = `{{ route('storeberita') }}`;
    // edit: beritaForm.action = `{{ url('berita') }}/${id}`;


    // --- LOGIKA FILTER BERITA BARU, 100% VIA JAVASCRIPT ---
    const filterButtons = document.querySelectorAll('.filter-nav-btn');
    const slider = document.querySelector('.filter-slider');
    const tableBody = document.getElementById('berita-table-body');
    const allTableRows = Array.from(tableBody.querySelectorAll('tr'));

    function moveSlider(targetButton) {
        if (!targetButton) return;
        const targetRect = targetButton.getBoundingClientRect();
        const containerRect = targetButton.parentElement.getBoundingClientRect();
        slider.style.width = `${targetRect.width}px`;
        slider.style.transform = `translateX(${targetRect.left - containerRect.left}px)`;
    }

    const initialActiveButton = document.querySelector('.filter-nav-btn.active');
    if (initialActiveButton) {
        moveSlider(initialActiveButton);
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            moveSlider(this);
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');
            
            // Logika pengurutan
            let sortedRows = [...allTableRows]; // Buat salinan array
            if (filterValue === 'terbaru') {
                // Urutkan dari timestamp terbesar ke terkecil
                sortedRows.sort((a, b) => b.dataset.timestamp - a.dataset.timestamp);
            } else if (filterValue === 'terlama') {
                // Urutkan dari timestamp terkecil ke terbesar
                sortedRows.sort((a, b) => a.dataset.timestamp - b.dataset.timestamp);
            } else {
                // 'all' kembali ke urutan asli dari PHP (biasanya terbaru)
                // jadi kita tidak perlu mengurutkan lagi, cukup pakai allTableRows
                sortedRows = allTableRows;
            }

            // Hapus semua baris dari tabel
            tableBody.innerHTML = '';
            // Masukkan kembali baris yang sudah diurutkan
            sortedRows.forEach(row => tableBody.appendChild(row));
        });
    });

    window.addEventListener('resize', () => {
        const currentActiveButton = document.querySelector('.filter-nav-btn.active');
        if (currentActiveButton) {
            moveSlider(currentActiveButton);
        }
    });

    // --- Sisa Script Modal (Event Listener) ---
    // Pastikan kode ini tetap ada di bawah logika filter
    const modalTitle = document.getElementById('beritaModalLabel');
    const beritaForm = document.getElementById('beritaForm');
    const methodField = document.getElementById('method-field');
    const submitButton = document.getElementById('submitButton');
    const gambarLabel = document.getElementById('gambarLabel');
    const gambarHelperText = document.getElementById('gambarHelperText');
    const gambarPreviewContainer = document.getElementById('gambar-preview-container');
    const gambarPreview = document.getElementById('gambar-preview');

    @if ($errors->any())
        new bootstrap.Modal(beritaModal).show();
    @endif

    beritaModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        beritaForm.reset();
        methodField.innerHTML = '';
        gambarPreviewContainer.style.display = 'none';
        const id = button.getAttribute('data-id');
        if (id) {
            modalTitle.textContent = 'Edit Berita';
            beritaForm.action = `{{ url('berita') }}/${id}`;
            methodField.innerHTML = `@method('PUT')`;
            submitButton.textContent = 'Simpan Perubahan';
            document.getElementById('judul').value = button.dataset.judul;
            document.getElementById('isi').value = button.dataset.isi;
            gambarLabel.textContent = 'Ganti Gambar Sampul (Opsional)';
            gambarHelperText.textContent = 'Kosongkan jika tidak ingin mengubah gambar.';
            const currentImage = button.dataset.gambar;
            if (currentImage) {
                gambarPreviewContainer.style.display = 'block';
                gambarPreview.src = currentImage;
            }
        } else {
            modalTitle.textContent = 'Buat Berita Baru';
            beritaForm.action = `{{ route('storeberita') }}`;
            submitButton.textContent = 'Publikasikan';
            gambarLabel.textContent = 'Gambar Sampul (Opsional)';
            gambarHelperText.textContent = '';
        }
    });
});
</script>
@endpush