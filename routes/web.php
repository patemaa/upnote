<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Note;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $notes = Note::where('user_id', auth()->id())
        ->orderByDesc('is_pinned')
        ->orderByDesc('updated_at')
        ->get();

    return view('dashboard', compact('notes'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/dashboard', function () {
        $notes = \App\Models\Note::where('user_id', auth()->id())->get();
        return view('dashboard', compact('notes'));
    })->name('dashboard');
});


Route::get('/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/store', [NoteController::class, 'store'])->name('notes.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/counts', [NoteController::class, 'count'])->name('notes.count');
});

require __DIR__.'/auth.php';
