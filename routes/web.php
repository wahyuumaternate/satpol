<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrganizationProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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

require __DIR__ . '/auth.php';
