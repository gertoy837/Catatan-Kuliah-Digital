<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'subject_id'];

    /**
     * Relasi: Sebuah Topic termasuk dalam satu Subject.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Relasi: Sebuah Topic memiliki banyak Notes.
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}