<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [NoteController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
});

Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
Route::post('/notes/{note}/assign-notebook', [NoteController::class, 'assignNotebook'])->name('notes.assignNotebook');

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
