<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tag $tag = null)
    {
        $query = Note::where('user_id', auth()->id())->latest();

        if ($tag) {
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tags.id', $tag->id);
            });
        }

        $notes = $query->with('tags')->paginate(10);

        return view('note.index', compact('notes', 'tag'));
    }

    public function create(Request $request)
    {
        $topic = Topic::find($request->id);
        return view('note.create', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'topic_id' => 'required|exists:topics,id',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png|max:10240',
            'tags' => 'nullable|string'
        ]);

        $lampiranPath = null;
        if ($request->hasFile('lampiran') && $request->file('lampiran')->isValid()) {
            $lampiran = $request->file('lampiran');
            $fileName = time() . '_' . $lampiran->getClientOriginalName();
            $lampiran->move(public_path('uploads'), $fileName);
            $lampiranPath = $fileName;
        }

        $note = Note::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'topic_id' => $validated['topic_id'],
            'user_id' => auth()->id(),
            'lampiran' => $lampiranPath,
        ]);

        if (!empty($validated['tags'])) {
            $tagNames = array_filter(array_map('trim', explode(',', $validated['tags'])));
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => strtolower($tagName)]);
                $tagIds[] = $tag->id;
            }
            $note->tags()->sync($tagIds);
        }

        return redirect()->route('catatan.show', $note->id)->with('success', 'Catatan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::with(['comments.user'])->findOrFail($id);
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
            'tags' => 'nullable|string',
        ]);

        $note->title = $validated['title'];
        $note->body = $validated['body'];
        $note->topic_id = $validated['topic_id'];

        if ($request->hasFile('lampiran')) {
            if ($note->lampiran && file_exists(public_path('uploads/' . $note->lampiran))) {
                unlink(public_path('uploads/' . $note->lampiran));
            }

            $lampiran = $request->file('lampiran');
            $fileName = time() . '_' . $lampiran->getClientOriginalName();
            $lampiran->move(public_path('uploads'), $fileName);
            $note->lampiran = $fileName;
        }

        $note->save();

        $tagIds = [];
        if (!empty($validated['tags'])) {
            $tagNames = array_filter(array_map('trim', explode(',', $validated['tags'])));
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => strtolower($tagName)]);
                $tagIds[] = $tag->id;
            }
        }
        $note->tags()->sync($tagIds);

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

        $note->delete();

        return redirect()->route('catatan.detail', [$subject->id, $topic->id])
            ->with('success', 'Catatan berhasil dihapus.');
    }

    public function detail(Request $request, $subject_id, $topic_id)
    {
        $subject = Subject::findOrFail($subject_id);
        $topic = $subject->topics()->findOrFail($topic_id);
        $activeTag = null;

        $notesQuery = $topic->notes();

        if ($request->has('tag') && $request->input('tag') != '') {
            $tagName = $request->input('tag');
            $activeTag = Tag::where('name', $tagName)->first();

            if ($activeTag) {
                $notesQuery->whereHas('tags', function ($query) use ($tagName) {
                    $query->where('name', 'LIKE', $tagName);
                });
            }
        }

        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $notesQuery->where('title', 'LIKE', "%{$searchTerm}%");
        }

        $notes = $notesQuery->with('tags')->latest()->paginate(5)->withQueryString();

        return view('note.detail', compact('subject', 'topic', 'notes', 'activeTag'));
    }

}
