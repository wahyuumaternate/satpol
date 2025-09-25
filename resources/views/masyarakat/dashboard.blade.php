@extends('masyarakat.layouts.main')

@section('title', 'Dashboard Masyarakat')

@section('content')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

<!-- Welcome Card with Visual Enhancement -->
<div class="row">
    <div class="col-12">
        <div class="card info-card revenue-card overflow-hidden">

            <div class="card-body pb-0">
                <div class="d-flex align-items-center p-3">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                        <h5 class="mb-0">Selamat Datang, {{ Auth::user()->name }}!</h5>
                        <span class="text-muted small pt-2">Kelola pengaduan ketertiban Anda dan pantau perkembangannya
                            secara real-time</span>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light p-3">
                <div class="text-center">
                    <span class="badge bg-primary-light text-primary p-2"><i class="bi bi-info-circle me-1"></i> CEKATAN
                        - Cepat, Efektif, Kolaboratif, Akuntabel, Transparan, Andal, Nyaman</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards with Enhanced Visual -->
<div class="row">
    <div class="col-xxl-4 col-md-4">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title border-bottom pb-3">Total Pengaduan</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="text-primary fw-bold mb-0">{{ $stats['total'] }}</h6>
                        <span class="text-success small pt-1 fw-bold">
                            <i class="bi bi-arrow-up-short"></i> Pengaduan
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-md-4">
        <div class="card info-card revenue-card">
            <div class="card-body">
                <h5 class="card-title border-bottom pb-3">Pengaduan Selesai</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success">
                        <i class="bi bi-check-circle-fill text-white"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="text-success fw-bold mb-0">{{ $stats['selesai'] }}</h6>
                        <span class="text-success small pt-1 fw-bold">
                            @if ($stats['total'] > 0)
                                <i class="bi bi-arrow-up-short"></i>
                                {{ number_format(($stats['selesai'] / $stats['total']) * 100, 0) }}% Selesai
                            @else
                                0% Selesai
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-md-4">
        <div class="card info-card customers-card">
            <div class="card-body">
                <h5 class="card-title border-bottom pb-3">Waktu Respons</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="ps-3">
                        <h6 class="text-info fw-bold mb-0">{{ number_format($avgResponseTime ?? 0, 1) }} Jam</h6>
                        <span class="text-info small pt-1 fw-bold">
                            <i class="bi bi-arrow-down-short"></i> Rata-rata respon
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Cards with Modern Design -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title border-bottom pb-3"><i class="bi bi-filter-square me-2"></i>Status Pengaduan</h5>
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="card border-start border-warning border-4 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <span class="badge bg-warning-light rounded-pill p-2 px-3">
                                        <i class="bi bi-clock-history text-warning fs-5 me-1"></i> Menunggu
                                    </span>
                                </div>
                                <h5 class="display-6 fw-bold text-warning mb-0">{{ $stats['menunggu'] }}</h5>
                                <p class="card-text text-muted mt-2">Pengaduan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-start border-primary border-4 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <span class="badge bg-primary-light rounded-pill p-2 px-3">
                                        <i class="bi bi-gear-fill text-primary fs-5 me-1"></i> Diproses
                                    </span>
                                </div>
                                <h5 class="display-6 fw-bold text-primary mb-0">{{ $stats['proses'] }}</h5>
                                <p class="card-text text-muted mt-2">Pengaduan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-start border-success border-4 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <span class="badge bg-success-light rounded-pill p-2 px-3">
                                        <i class="bi bi-check-circle-fill text-success fs-5 me-1"></i> Selesai
                                    </span>
                                </div>
                                <h5 class="display-6 fw-bold text-success mb-0">{{ $stats['selesai'] }}</h5>
                                <p class="card-text text-muted mt-2">Pengaduan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-start border-danger border-4 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <span class="badge bg-danger-light rounded-pill p-2 px-3">
                                        <i class="bi bi-x-circle-fill text-danger fs-5 me-1"></i> Ditolak
                                    </span>
                                </div>
                                <h5 class="display-6 fw-bold text-danger mb-0">{{ $stats['ditolak'] }}</h5>
                                <p class="card-text text-muted mt-2">Pengaduan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add a custom style block -->
<style>
    /* Add NiceAdmin light colors for enhanced visuals */
    .bg-primary-light {
        background-color: rgba(65, 84, 241, 0.15) !important;
    }

    .bg-success-light {
        background-color: rgba(46, 202, 106, 0.15) !important;
    }

    .bg-warning-light {
        background-color: rgba(255, 119, 29, 0.15) !important;
    }

    .bg-danger-light {
        background-color: rgba(255, 0, 0, 0.15) !important;
    }

    /* Enhance card hover effects */
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1) !important;
    }

    /* Enhance news items */
    .news .post-item {
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
        margin-bottom: 15px;
    }

    .news .post-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .news .post-item img {
        width: 80px;
        float: left;
        border-radius: 5px;
    }

    .news .post-item h4 {
        font-size: 15px;
        margin-left: 95px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .news .post-item h4 a {
        color: #012970;
        transition: 0.3s;
        text-decoration: none;
    }

    .news .post-item h4 a:hover {
        color: #4154f1;
    }

    .news .post-item p {
        font-size: 14px;
        color: #777777;
        margin-left: 95px;
    }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate numbers
        const animateNumbers = () => {
            const elements = document.querySelectorAll('.card .fw-bold');
            elements.forEach(el => {
                const target = parseInt(el.textContent.replace(/,/g, ''));
                let count = 0;
                const duration = 1000;
                const increment = target / (duration / 30);
                const timer = setInterval(() => {
                    count += increment;
                    if (count >= target) {
                        el.textContent = target;
                        clearInterval(timer);
                    } else {
                        el.textContent = Math.ceil(count);
                    }
                }, 30);
            });
        };
        animateNumbers();

        // Monthly Chart with enhanced styling
        const monthlyCtx = document.getElementById('monthlyChart');
        if (monthlyCtx) {
            const monthlyData = @json($monthlyStats);

            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: monthlyData.map(item => item.month),
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: monthlyData.map(item => item.count),
                        borderColor: '#4154f1',
                        backgroundColor: 'rgba(65, 84, 241, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#4154f1',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleColor: 'white',
                            bodyColor: 'white',
                            cornerRadius: 8,
                            displayColors: false,
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                color: '#6c757d',
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#6c757d',
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear'
                        }
                    }
                }
            });
        }

        // Category Chart with enhanced styling
        const categoryCtx = document.getElementById('categoryChart');
        if (categoryCtx) {
            const categoryData = @json($kategoriStats);

            if (Object.keys(categoryData).length > 0) {
                new Chart(categoryCtx, {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(categoryData),
                        datasets: [{
                            data: Object.values(categoryData),
                            backgroundColor: [
                                '#4154f1', // primary
                                '#2eca6a', // success
                                '#ff771d', // warning
                                '#ff0000', // danger
                                '#b9b9b9', // gray
                                '#6f42c1', // purple
                                '#20c997' // teal
                            ],
                            borderWidth: 0,
                            hoverOffset: 10,
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    color: '#6c757d',
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                titleColor: 'white',
                                bodyColor: 'white',
                                cornerRadius: 8,
                                padding: 12,
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b,
                                            0);
                                        const percentage = Math.round((context.parsed * 100) /
                                            total);
                                        return context.label + ': ' + context.parsed + ' (' +
                                            percentage + '%)';
                                    }
                                }
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true,
                            duration: 2000
                        }
                    }
                });
            }
        }
    });
</script>
@endpush
