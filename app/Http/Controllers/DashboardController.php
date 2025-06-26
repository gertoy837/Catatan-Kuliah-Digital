<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil hanya mata kuliah milik pengguna yang sedang login.
        // 2. Gunakan 'withCount' untuk efisiensi. Ini akan mengambil jumlah 'topics' dan 'notes'
        //    tanpa harus memuat seluruh data relasi, sehingga lebih cepat.
        // 3. Urutkan berdasarkan yang terbaru.
        // 4. Gunakan 'paginate' untuk membagi data ke beberapa halaman.
        $subjects = auth()->user()
                        ->subjects()
                        ->withCount(['topics', 'notes']) // Eager Load Counts
                        ->latest()
                        ->paginate(9); // Misal, 9 kartu per halaman (3x3 grid)

        // 5. Kirim data 'subjects' ke view 'subjects.index'.
        return view('dashboard', compact('subjects'));
    }
}
