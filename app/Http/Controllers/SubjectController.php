<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request; // Gunakan Request bawaan Laravel

class SubjectController extends Controller
{
    /**
     * Menampilkan daftar semua mata kuliah milik pengguna yang sedang login.
     */
    public function index()
    {
        $subjects = auth()->user()->subjects()->latest()->paginate(10);
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Menampilkan form untuk membuat mata kuliah baru.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Menyimpan mata kuliah baru ke database.
     */
    public function store(Request $request)
    {
        // --- Validasi langsung di dalam controller ---
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        auth()->user()->subjects()->create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu mata kuliah beserta semua topiknya.
     */
    public function show(Subject $subject)
    {
        $subject->load('topics.notes');
        return view('subjects.show', compact('subject'));
    }

    /**
     * Menampilkan form untuk mengedit mata kuliah.
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Mengupdate data mata kuliah di database.
     */
    public function update(Request $request, Subject $subject)
    {
        // --- Validasi langsung di dalam controller ---
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subject->update($validatedData);

        return redirect()->route('subjects.show', $subject)->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    /**
     * Menghapus mata kuliah dari database.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('dashboard')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
