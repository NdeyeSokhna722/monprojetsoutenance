<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [
        'etudiant_id',
        'date',
        'status',
        'note',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Relation avec l'étudiant
     */
    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }

    /**
     * Relation avec l'utilisateur (enseignant/admin)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour les présences d'aujourd'hui
     */
    public function scopeToday($query)
    {
        return $query->whereDate('date', now()->toDateString());
    }

    /**
     * Scope pour une date spécifique
     */
    public function scopeForDate($query, $date)
    {
        return $query->whereDate('date', $date);
    }
}