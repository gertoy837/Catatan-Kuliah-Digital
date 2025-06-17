<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner_id', 'invitation_code'];

    /**
     * Relasi: Sebuah Workspace dimiliki oleh seorang User (Owner).
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Relasi: Sebuah Workspace memiliki banyak Users (Anggota).
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_workspace')->withPivot('role')->withTimestamps();
    }

    /**
     * Relasi: Sebuah Workspace memiliki banyak Notes.
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}