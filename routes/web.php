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

    Route::resource('kategoris', KategoriController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
