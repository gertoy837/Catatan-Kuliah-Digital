<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request; // Gunakan Request bawaan Laravel

class TopicController extends Controller
{
    /**
     * Menyimpan topik baru yang berelasi dengan subject tertentu.
     */
    public function store(Request $request, Subject $subject)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $subject->topics()->create($validatedData);

        return redirect()->route('subjects.show', $subject)->with('success', 'Topik berhasil ditambahkan.');
    }
    
    /**
     * Menghapus sebuah topik.
     */
    public function destroy(Subject $subject, Topic $topic)
    {
        $topic->delete();
        return redirect()->route('subjects.show', $subject)->with('success', 'Topik berhasil dihapus.');
    }
}