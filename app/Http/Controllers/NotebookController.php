<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notebook;

class NotebookController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $notebook = Notebook::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        // Eğer AJAX çağrısı ise JSON döndür
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'notebook' => $notebook]);
        }

        return redirect()->back()->with('success', 'Notebook oluşturuldu.');
    }

}
