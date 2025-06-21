<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): RedirectResponse
    {
        return Redirect::route('catatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create-note', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'content' => 'required|string',
    ]);

    $note = Note::create([
        // 'title' => 'Catatan Baru', // atau ambil dari input tambahan jika tersedia
        // 'body' => $request->content,
        // 'user_id' => auth()->id(),
    ]);

    return redirect()->route('catatan.edit', $note->id)->with('success', 'Catatan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::findOrFail($id);
        return view('note.index', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
