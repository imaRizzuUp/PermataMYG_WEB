@extends('layouts.app')

@section('konten')

<div class="row g-4">
    {{-- Kartu Total Ibadah Selesai --}}
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary-subtle text-primary-emphasis p-3 rounded-3 me-3">
                    <i class="bi bi-calendar-check fs-2"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Total Ibadah (Selesai)</p>
                    <h4 class="fw-bold mb-0">{{ $statistikData['totalIbadah'] }}</h4>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Kartu Ibadah Berhasil --}}
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="bg-success-subtle text-success-emphasis p-3 rounded-3 me-3">
                    <i class="bi bi-check2-circle fs-2"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Ibadah Berhasil</p>
                    <h4 class="fw-bold mb-0">{{ $statistikData['berhasil'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Kartu Ibadah Gagal --}}
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="bg-danger-subtle text-danger-emphasis p-3 rounded-3 me-3">
                    <i class="bi bi-x-circle fs-2"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Ibadah Gagal</p>
                    <h4 class="fw-bold mb-0">{{ $statistikData['gagal'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Kartu Rasio Keberhasilan --}}
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <div class="bg-info-subtle text-info-emphasis p-3 rounded-3 me-3">
                    <i class="bi bi-percent fs-2"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Rasio Keberhasilan</p>
                    <h4 class="fw-bold mb-0">{{ $statistikData['rasioBerhasil'] }}%</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart Statistik --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0 fw-bold">Grafik Status Ibadah</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Chart Donat --}}
                    <div class="col-lg-5 col-md-6">
                        <canvas id="donutChart"></canvas>
                    </div>
                    {{-- Progress Bar Rasio --}}
                    <div class="col-lg-7 col-md-6 d-flex flex-column justify-content-center">
                        <h6 class="fw-semibold">Rangkuman</h6>
                        <div class="progress mt-3 mb-2" role="progressbar" style="height: 25px;">
                            <div class="progress-bar bg-success" style="width: {{ $statistikData['rasioBerhasil'] }}%" 
                                 aria-valuenow="{{ $statistikData['rasioBerhasil'] }}" aria-valuemin="0" aria-valuemax="100">
                                Berhasil
                            </div>
                            <div class="progress-bar bg-danger" style="width: {{ 100 - $statistikData['rasioBerhasil'] }}%"
                                 aria-valuenow="{{ 100 - $statistikData['rasioBerhasil'] }}" aria-valuemin="0" aria-valuemax="100">
                                Gagal
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-muted small">
                            <span>{{ $statistikData['rasioBerhasil'] }}% Berhasil</span>
                            <span>{{ round(100 - $statistikData['rasioBerhasil'], 2) }}% Gagal</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
{{-- Library Chart.js untuk menggambar grafik --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('donutChart');

    // Ambil data dari PHP yang dikirim controller
    const berhasilCount = {{ $statistikData['berhasil'] }};
    const gagalCount = {{ $statistikData['gagal'] }};

    // Tentukan warna berdasarkan tema yang aktif
    const isDarkMode = document.documentElement.getAttribute('data-bs-theme') === 'dark';
    const chartColors = {
        berhasil: isDarkMode ? 'rgba(25, 135, 84, 0.7)' : 'rgba(25, 135, 84, 0.9)', // Warna Hijau
        gagal: isDarkMode ? 'rgba(220, 53, 69, 0.7)' : 'rgba(220, 53, 69, 0.9)',    // Warna Merah
        borderColor: isDarkMode ? '#374151' : '#e5e7eb' // Warna border
    };

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Berhasil', 'Gagal'],
            datasets: [{
                label: 'Jumlah Ibadah',
                data: [berhasilCount, gagalCount],
                backgroundColor: [
                    chartColors.berhasil,
                    chartColors.gagal,
                ],
                borderColor: chartColors.borderColor,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Distribusi Status Ibadah'
                }
            }
        }
    });
});
</script>
@endpush