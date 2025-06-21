<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class DashboardController extends Controller
{
    public function index()
    {
        $note = Note::all();
        return view('catatan', compact('note'));
    }
}
