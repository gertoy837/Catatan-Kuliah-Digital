<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request) {
        $request->validate([
        'note_id' => 'required|exists:notes,id',
        'body' => 'required|string|max:255',
    ]);

    $note = Note::findOrFail($request->note_id);

    $note->comments()->create([
        'user_id' => Auth::id(),
        'body' => $request->body,
    ]);

    return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
