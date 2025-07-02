<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware('auth')->group(function () {
    Route::get('/catatan', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/catatan/tags/{tag:name}', [NoteController::class, 'index'])->name('catatan.tag');
    Route::get('/catatan/create/{id}', [NoteController::class, 'create'])->name('catatan.create');
    Route::post('/catatan/store', [NoteController::class, 'store'])->name('catatan.store');
    Route::get('/catatan/show/{id}', [NoteController::class, 'show'])->name('catatan.show');
    Route::get('/catatan/edit/{id}', [NoteController::class, 'edit'])->name('catatan.edit');
    Route::put('/catatan/update/{id}', [NoteController::class, 'update'])->name('catatan.update');
    Route::delete('/catatan/destroy/{id}', [NoteController::class, 'destroy'])->name('catatan.destroy');
    
    Route::get('/catatan/detail/{id}/{topic}', [NoteController::class, 'detail'])->name('catatan.detail');

    Route::resource('subjects', SubjectController::class);
    
    Route::post('/subjects/{subject}/topics', [TopicController::class, 'store'])->name('topics.store');
    Route::delete('/subjects/{subject}/topics/{topic}', [TopicController::class, 'destroy'])->name('topics.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

    // // ==========================================================
    // // ROUTE UNTUK NOTES (CATATAN)
    // // ==========================================================
    // // Rute untuk menampilkan form pembuatan catatan (dimulai dari halaman topik).
    // Route::get('/topics/{topic}/notes/create', [NoteController::class, 'create'])->name('notes.create');
    // // Rute untuk menyimpan catatan baru.
    // Route::post('/topics/{topic}/notes', [NoteController::class, 'store'])->name('notes.store');
});

Route::post('/attachments', function (Request $request) {
    $request->validate([
        'attachment' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    $path = $request->file('attachment')->store('attachments', 'public');

    return [
        'url' => Storage::url($path),
    ];
});

Route::get('/ruang_kerja', function () {
    return view('workspace');
})->middleware(['auth', 'verified'])->name('workspace');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
