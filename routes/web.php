<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AspirasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $aspirasi = \App\Models\Aspiration::with('category')
        ->latest()
        ->take(6)
        ->get();
    return view('landing.index', compact('aspirasi'));
});

// Grup Middleware Auth Login Required :D
Route::middleware(['auth', 'verified'])->group(function () {

    // --- FITUR SISWA ---
    Route::prefix('students')->name('aspirasi.')->group(function () {
        // Halaman Riwayat & Form
        Route::get('/dashboard', [AspirasiController::class, 'index'])->name('index');
        // Simpan Aspirasi
        Route::post('/store', [AspirasiController::class, 'store'])->name('store');
        // Update Aspirasi
        Route::put('/update/{id}', [AspirasiController::class, 'update'])->name('update');
        // Hapus Aspirasi
        Route::delete('/delete/{id}', [AspirasiController::class, 'destroy'])->name('destroy');
    });

    // --- FITUR ADMIN ---
    Route::prefix('admin')->name('admin.')->group(function () {
        //aspirasi yang masuk
        Route::get('/dashboard', [AspirasiController::class, 'adminIndex'])->name('dashboard');
        // Update status + response
        Route::patch('/aspirasi/{id}/status', [AspirasiController::class, 'updateStatus'])->name('updateStatus');
    });

    // Profile Updatee
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

});

require __DIR__.'/auth.php';