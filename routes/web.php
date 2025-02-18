<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemakaianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/petugas', [AdminController::class, 'index'])->name('petugas.index');
    Route::get('/petugas/create', [AdminController::class, 'create'])->name('petugas.create');
    Route::post('/petugas', [AdminController::class, 'createPetugas'])->name('petugas.store');
    Route::get('/petugas/{user}/edit', [AdminController::class, 'edit'])->name('petugas.edit');
    Route::put('/petugas/{user}', [AdminController::class, 'update'])->name('petugas.update');
    Route::delete('/petugas/{user}', [AdminController::class, 'destroy'])->name('petugas.destroy');
});
Route::resource('tarif', TarifController::class);
Route::resource('pelanggan', PelangganController::class);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pemakaian', [PemakaianController::class, 'index'])->name('pemakaian.index');
    Route::get('/pemakaian/create', [PemakaianController::class, 'create'])->name('pemakaian.create');
    Route::post('/pemakaian', [PemakaianController::class, 'store'])->name('pemakaian.store');
    Route::get('/pemakaian/{id}/edit', [PemakaianController::class, 'edit'])->name('pemakaian.edit');
    Route::put('/pemakaian/{id}', [PemakaianController::class, 'update'])->name('pemakaian.update');
    Route::delete('/pemakaian/{id}', [PemakaianController::class, 'destroy'])->name('pemakaian.destroy');
    Route::patch('/pemakaian/{id}/status', [PemakaianController::class, 'updateStatus'])->name('pemakaian.updateStatus');
});

require __DIR__.'/auth.php';
