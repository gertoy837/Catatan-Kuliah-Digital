<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman utama (dashboard) dengan daftar mata kuliah.
     * Sekarang mendukung fungsionalitas pencarian.
     */
    public function index(Request $request)
    {
        $query = Subject::query();

        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }

        $subjects = $query->withCount(['topics', 'notes'])
                        ->latest()
                        ->paginate(9)
                        ->withQueryString(); // Ini akan otomatis menambahkan parameter pencarian ke link pagination

        return view('dashboard', compact('subjects'));
    }
}
