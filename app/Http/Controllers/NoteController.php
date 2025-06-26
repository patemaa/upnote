<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        public function store(Request $request)
    {
        $note = Note::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'is_pinned' => $request->input('pinned', false),
                'category' => $request->input('category', 'uncategorized'),
            ]
        );

        return response()->json(['success' => true, 'note' => $note]);
    }

    public function index(Request $request)
    {
        $query = Note::where('user_id', auth()->id());

        if ($request->category) {
            $query->where('category', $request->category);
        }

        $notes = $query->orderByDesc('pinned')->orderByDesc('updated_at')->get();

        return view('center', compact('notes'));
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
}
