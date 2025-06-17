<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'body', 
        'user_id', 
        'topic_id', 
        'workspace_id',
        'shareable_token'
    ];

    /**
     * Relasi: Sebuah Note dibuat oleh seorang User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Sebuah Note termasuk dalam satu Topic (jika catatan pribadi).
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Relasi: Sebuah Note termasuk dalam satu Workspace (jika catatan kolaboratif).
     */
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }
    
    /**
     * Relasi: Sebuah Note memiliki banyak Tags.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'note_tag')->withTimestamps();
    }

    /**
     * Relasi Polimorfik: Sebuah Note bisa memiliki banyak Comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}