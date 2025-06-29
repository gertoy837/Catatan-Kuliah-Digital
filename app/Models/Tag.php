<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * Relasi: Sebuah Tag dimiliki oleh banyak Notes.
     */
    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'note_tag')->withTimestamps();
    }

    protected static function booted(): void
    {
        static::creating(function (Tag $tag) {
            // Membuat slug secara otomatis dari nama tag
            $tag->slug = Str::slug($tag->name);
        });
    }
}