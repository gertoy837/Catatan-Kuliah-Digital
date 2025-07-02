<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show($id)
    {
        // Ambil post beserta relasi komentar dan user komentar
        $post = Post::with(['comments.user'])->findOrFail($id);

        return view('posts.show', compact('post'));
    }
}
