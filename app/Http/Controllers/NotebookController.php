<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;
class NotebookController extends Controller
{
    public function index()
    {
        $notebooks = Notebook::withCount('notes')->get();
        return view('notebooks.index', compact('notebooks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Notebook::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Notebook created!');
    }

    public function show($id)
    {
        $notebook = Notebook::with('notes')->findOrFail($id);
        return view('notebooks.show', compact('notebook'));
    }
}
