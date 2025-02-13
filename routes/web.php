<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TarifController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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


require __DIR__.'/auth.php';
