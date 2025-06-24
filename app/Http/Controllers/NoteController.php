<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Topic;
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
     * Menampilkan form untuk membuat catatan baru di dalam topik tertentu.
     */
    public function create(Request $request)
    {
        $topic = Topic::find($request->id);
        return view('note.create', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'topic_id' => 'required|exists:topics,id',
        ]);

        // dd($request);

        $note = Note::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'topic_id' => $validated['topic_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('catatan.show', $note)->with('success', 'Catatan berhasil disimpan.');
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


    public function detail($id, $topic)
    {
        $subject = Subject::findOrFail($id);
        $topic = $subject->topics()->where('id', $topic)->firstOrFail();

        return view('note.detail', compact('subject', 'topic'));
    }
}
