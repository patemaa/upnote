<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Note;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');

    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
    Route::patch('/notes/{note}/update', [NoteController::class, 'update'])->name('notes.update');
    Route::get('/notes/counts', [NoteController::class, 'count'])->name('notes.count');

    Route::get('/dashboard', [NoteController::class, 'index'])->name('dashboard');
    Route::patch('/notes/{note}/update', [NoteController::class, 'update'])->name('notes.update');
    Route::post('/notes/{note}/assign-notebook', [NoteController::class, 'assignNotebook'])->name('notes.assignNotebook');
    Route::get('/create', [NoteController::class, 'create'])->name('create');
    Route::post('/notes/reorder', function(Request $request) {
        $order = $request->input('order', []);

        foreach ($order as $index => $id) {
            Note::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['status' => 'success']);
    })->middleware('auth');

    Route::get('/notes/{note}/content', [NoteController::class, 'content']);

    Route::post('/notes/{note}/restore/{version}', [NoteController::class, 'restoreVersion'])->name('notes.restoreVersion');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
