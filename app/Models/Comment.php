<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'post_id', 'commentable_id', 'commentable_type'];

    /**
     * Relasi: Sebuah Comment dibuat oleh seorang User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Relasi Polimorfik: Mendapatkan model induk yang dikomentari (bisa Note, Task, dll).
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }
}