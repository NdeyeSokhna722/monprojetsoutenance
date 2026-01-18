<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'color',
        'user_id',
        'created_by',
        'is_public',
        'type'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'is_public' => 'boolean',
        'deleted_at' => 'datetime'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Relation avec l'utilisateur créateur
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation avec l'utilisateur créateur (created_by)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope pour les événements publics
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope pour les événements de l'utilisateur
     */
    public function scopeForUser($query, $userId = null)
    {
        $userId = $userId ?? auth()->id();
        return $query->where(function($q) use ($userId) {
            $q->where('user_id', $userId)
              ->orWhere('created_by', $userId);
        });
    }

    /**
     * Scope pour les événements à venir
     */
    public function scopeUpcoming($query, $days = 7)
    {
        return $query->where('start', '>=', now())
                     ->where('start', '<=', now()->addDays($days))
                     ->orderBy('start');
    }

    /**
     * Scope pour les événements d'aujourd'hui
     */
    public function scopeToday($query)
    {
        return $query->whereDate('start', now()->toDateString());
    }

    /**
     * Scope pour les événements de cette semaine
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('start', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }
}