<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/catatan/{id}', [NoteController::class, 'show'])->middleware(['auth', 'verified'])->name('catatan.show');
Route::get('/catatan/create', [NoteController::class, 'create'])->middleware(['auth', 'verified'])->name('catatan.create',);
Route::post('/catatan/add', [NoteController::class, 'store'])->middleware(['auth', 'verified'])->name('catatan.store');
Route::get('/catatan/{id}/edit', [NoteController::class, 'edit'])->middleware(['auth', 'verified'])->name('catatan.edit');
Route::put('/catatan/{id}/update', [NoteController::class, 'update'])->middleware(['auth', 'verified'])->name('catatan.update');
Route::delete('/catatan/{id}/delete', [NoteController::class, 'destroy'])->middleware(['auth', 'verified'])->name('catatan.delete');


Route::get('/ruang_kerja', function () {
    return view('workspace');
})->middleware(['auth', 'verified'])->name('workspace');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
