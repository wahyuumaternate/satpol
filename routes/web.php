<?php

use App\Http\Controllers\Frontend\FrontendPengaduanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrganizationProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/migrate-fresh', function () {
    try {
        $output = '';
        Artisan::call('migrate:fresh', [
            '--seed' => true,
            '--force' => true, // Tambahkan force untuk menjalankan di production
        ], $output);

        return 'Migrate fresh berhasil dijalankan! <br><pre>' . Artisan::output() . '</pre>';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
Route::prefix('backend')->name('backend.')->middleware(['auth'])->group(function () {
    // Resource route untuk pengaduan (hanya yang diperlukan)
    Route::resource('pengaduan', PengaduanController::class)->only(['index', 'show']);

    // Route tambahan untuk fungsi admin
    Route::post('pengaduan/{id}/tanggapan', [PengaduanController::class, 'tanggapan'])->name('pengaduan.tanggapan');
    Route::patch('pengaduan/{id}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.status');
    Route::get('pengaduan-stats', [PengaduanController::class, 'getDashboardStats'])->name('pengaduan.stats');
    Route::get('pengaduan-export', [PengaduanController::class, 'export'])->name('pengaduan.export');
});
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('organization-profile')->group(function () {
        Route::get('/', [OrganizationProfileController::class, 'adminIndex'])->name('backend.organization-profile.admin.index');
        Route::get('/{id}/edit', [OrganizationProfileController::class, 'edit'])->name('backend.organization-profile.edit');
        Route::put('/{id}', [OrganizationProfileController::class, 'update'])->name('backend.organization-profile.update');
        Route::get('/{id}/show', [OrganizationProfileController::class, 'show'])->name('backend.organization-profile.show');
    });

    // Route Kategori - Individual
    Route::prefix('kategori')->name('backend.kategori.')->group(function () {
        // GET routes
        Route::get('/', [KategoriController::class, 'index'])->name('index');

        // POST routes
        Route::post('/', [KategoriController::class, 'store'])->name('store');

        // PUT/PATCH routes
        Route::put('/{id}', [KategoriController::class, 'update'])->name('update');
        Route::patch('/{id}', [KategoriController::class, 'update'])->name('update');

        // DELETE routes
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('destroy');

        // Custom routes
        Route::patch('/{id}/toggle-status', [KategoriController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/bulk-delete', [KategoriController::class, 'bulkDelete'])->name('bulk-delete');
        Route::patch('/bulk-status', [KategoriController::class, 'bulkStatus'])->name('bulk-status');
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Frontend Routes untuk Pengaduan
|--------------------------------------------------------------------------
*/

// Route publik (tidak perlu login)
// Form pengaduan
Route::get('/pengaduan/form', [FrontendPengaduanController::class, 'form'])
    ->name('pengaduan.form');

// API untuk mendapatkan kelurahan berdasarkan kecamatan
Route::post('/pengaduan/get-kelurahan', [FrontendPengaduanController::class, 'getKelurahan'])
    ->name('pengaduan.get-kelurahan');

// Halaman cek status
Route::get('/pengaduan/cek-status', [FrontendPengaduanController::class, 'cekStatus'])
    ->name('pengaduan.cek-status');

// Lihat riwayat pengaduan
Route::get('/pengaduan/history', [FrontendPengaduanController::class, 'history'])
    ->name('pengaduan.history');

// Rute untuk Masyarakat (perlu login dan role masyarakat)
Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    // Simpan pengaduan baru
    Route::post('/pengaduan/store', [FrontendPengaduanController::class, 'store'])
        ->name('pengaduan.store');

    // Daftar pengaduan milik user sendiri
    Route::get('/pengaduan/list', [FrontendPengaduanController::class, 'list'])
        ->name('pengaduan.list');

    // Detail pengaduan milik sendiri
    Route::get('/pengaduan/{id}', [FrontendPengaduanController::class, 'detail'])
        ->middleware('own.complaint')
        ->name('pengaduan.detail');

    // Proses pengecekan status
    Route::post('/pengaduan/proses-status', [FrontendPengaduanController::class, 'prosesStatus'])
        ->name('pengaduan.proses-status');
});
require __DIR__ . '/auth.php';
