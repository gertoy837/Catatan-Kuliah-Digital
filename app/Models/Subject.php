<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id'];

    /**
     * Relasi: Sebuah Subject dimiliki oleh seorang User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Sebuah Subject memiliki banyak Topics.
     */
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * Relasi: Sebuah Subject memiliki banyak Notes melalui Topics.
     */
    public function notes(): HasManyThrough
    {
        return $this->hasManyThrough(Note::class, Topic::class);
    }
}