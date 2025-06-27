<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
        public function store(Request $request)
    {
        $request->validate([
            'note_content' => 'required|string',
        ]);

        $note = new Note();
        $note->title = Str::limit(Str::words($request->note_content, 6), 200);
        $note->content = $request->note_content;
        $note->category = 'uncategorized';
        $note->is_pinned = false;
        $note->user_id = auth()->id(); // giriş yapmış kullanıcı için
        $note->save();

        return redirect()->back()->with('success', 'Not başarıyla kaydedildi.');
    }

    public function assignNotebook(Request $request, Note $note)
    {
        $request->validate([
            'notebook_id' => 'required|exists:notebooks,id',
        ]);

        $note->update(['notebook_id' => $request->notebook_id]);

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $notes = Note::where('user_id', auth()->id())
            ->orderByDesc('pinned')
            ->orderByDesc('updated_at')
            ->get();

        $note = $notes->first() ?? new Note();
        $notebooks = Notebook::withCount('notes')->get();

        return view('dashboard', compact('notes', 'note', 'notebooks'));
    }

    public function count()
    {
        $userId = auth()->id();

        return response()->json([
            'all' => Note::where('user_id', $userId)->count(),
            'uncategorized' => Note::where('user_id', $userId)->where('category', 'uncategorized')->count(),
            'todo' => Note::where('user_id', $userId)->where('category', 'todo')->count(),
            'unsynced' => Note::where('user_id', $userId)->where('category', 'unsynced')->count(),
        ]);
    }
    public function content(Note $note)
    {
        return response()->json(['content' => $note->content]);
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'note_content' => 'required|string',
        ]);

        $note->title = Str::limit(Str::words($request->note_content, 6), 200);
        $note->content = $request->note_content;
        $note->save();

        return redirect()->back()->with('success', 'Not başarıyla güncellendi.');
    }

}
