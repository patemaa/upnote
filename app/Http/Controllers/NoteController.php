<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Notebook;
use App\Models\NoteVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', auth()->id())
            ->orderByDesc('pinned')
            ->orderByDesc('updated_at')
            ->get();

        $starredNotes = Note::where('user_id', auth()->id())
            ->where('is_favorite', true)
            ->orderByDesc('updated_at')
            ->get();
        $lastNote = Note::where('user_id', auth()->id())->latest()->first();

        $note = $activeNote ?? ($notes->first() ?? new Note());
        $notebooks = Notebook::withCount('notes')->get();

        return view('dashboard', compact('notes', 'note', 'notebooks', 'starredNotes', 'lastNote'));
    }

    public function create()
    {
        return view('dashboard', [
            'note' => new Note(),
            'notes' => Note::where('user_id', auth()->id())->latest()->get(),
            'notebooks' => Notebook::where('user_id', auth()->id())->get(),
        ]);
    }

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

        return redirect()->route('dashboard', ['note_id' => $note->id]);
    }
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'note_content' => 'required|string',
        ]);

        NoteVersion::create([
            'note_id' => $note->id,
            'content' => $note->content,
            'saved_at' => now(),
        ]);

        $note->update([
            'title' => Str::limit(Str::words($request->note_content, 6), 200),
            'content' => $request->note_content,
        ]);

        return redirect()->route('dashboard', ['note_id' => $note->id]);
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
    public function restoreVersion(Note $note, NoteVersion $version)
    {
        $note->update([
            'content' => $version->content,
            'title' => Str::limit(Str::words($version->content, 6), 200),
        ]);

        return redirect()->back()->with('success', 'Versiyon geri yüklendi.');
    }

    public function toggleFavorite(Note $note)
    {
        $note->is_favorite = !$note->is_favorite;
        $note->save();

        return response()->json([
            'success' => true,
            'is_favorite' => $note->is_favorite,
        ]);
    }

    public function show(Note $note)
    {
        $notes = Note::where('user_id', auth()->id())
            ->orderByDesc('pinned')
            ->orderByDesc('updated_at')
            ->get();

        $starredNotes = Note::where('user_id', auth()->id())
            ->where('is_favorite', true)
            ->orderByDesc('updated_at')
            ->get();

        $notebooks = Notebook::withCount('notes')->get();


        return view('dashboard', compact('notes', 'note', 'notebooks', 'starredNotes'));
    }
    public function assignNotebook(Request $request, Note $note)
    {
        $request->validate([
            'notebook_id' => 'required|exists:notebooks,id',
        ]);

        $note->update(['notebook_id' => $request->notebook_id]);

        return response()->json(['success' => true]);
    }
}
