<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/store', [NoteController::class, 'store'])->name('notes.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use Illuminate\Http\Request;

Route::get('/editor', function () {
    return view('editor');
});

Route::post('/save-content', function (Request $request) {
    $request->validate([
        'content' => 'required|string',
    ]);
    // $request->content içinde HTML içeriği var, kaydedebilirsin
    // Örneğin Model::create(['content' => $request->content]);

    return redirect('/editor')->with('success', 'İçerik başarıyla kaydedildi!');
})->name('save-content');

use Illuminate\Support\Facades\Cache;

Route::get('/editor', function () {
    $note = Cache::get('note_content', '');
    return view('editor', ['noteContent' => $note]);
});

Route::post('/auto-save', function (Request $request) {
    $request->validate([
        'content' => 'nullable|string',
    ]);

    Cache::put('note_content', $request->input('content'), now()->addDays(7));

    return response()->json(['status' => 'success']);
})->name('auto-save');


require __DIR__.'/auth.php';
