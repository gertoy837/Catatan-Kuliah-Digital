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
    // public function index(): RedirectResponse
    // {
    //     return Redirect::route('catatan.index');
    // }

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
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('lampiran') && $request->file('lampiran')->isValid()) {
            $lampiranPath = null;
            if ($request->hasFile('lampiran')) {
                $lampiran = $request->file('lampiran');
                $fileName = time() . '_' . $lampiran->getClientOriginalName();
                $lampiran->move(public_path('uploads'), $fileName);
                $lampiranPath = $fileName;
            }
        }

        $note = Note::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'topic_id' => $validated['topic_id'],
            'user_id' => auth()->id(),
            'lampiran' => $lampiranPath,
        ]);

        return redirect()->route('catatan.show', $note)->with('success', 'Catatan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::findOrFail($id);
        return view('note.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $note = Note::findOrFail($id);
        return view('note.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $note = Note::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'topic_id' => 'required|exists:topics,id',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png|max:10240',
        ]);

        $note->title = $validated['title'];
        $note->body = $validated['body'];
        $note->topic_id = $validated['topic_id'];

        if ($request->hasFile('lampiran')) {
            // Hapus lampiran lama jika ada
            if ($note->lampiran && file_exists(public_path('uploads/' . $note->lampiran))) {
                unlink(public_path('uploads/' . $note->lampiran));
            }

            // Simpan lampiran baru
            $lampiran = $request->file('lampiran');
            $fileName = time() . '_' . $lampiran->getClientOriginalName();
            $lampiran->move(public_path('uploads'), $fileName);
            $note->lampiran = $fileName;
        }

        $note->save();

        return redirect()->route('catatan.show', $note)->with('success', 'Catatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Note::findOrFail($id);
        $topic = $note->topic;
        $subject = $topic->subject;

        // if ($note->attachment && Storage::exists($note->attachment)) {
        //     Storage::delete($note->attachment);
        // }

        $note->delete();

        return redirect()->route('catatan.detail', [$subject->id, $topic->id])
            ->with('success', 'Catatan berhasil dihapus.');
    }

    public function detail($id, $topic)
    {
        $subject = Subject::findOrFail($id);
        $topic = $subject->topics()->where('id', $topic)->firstOrFail();

        return view('note.detail', compact('subject', 'topic'));
    }
}
