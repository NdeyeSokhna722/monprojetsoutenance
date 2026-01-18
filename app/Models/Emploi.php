<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    use HasFactory;

    protected $fillable = [
        'jour',
        'heure_debut',
        'heure_fin',
        'cours_id',
    ];

    /**
     * Un créneau appartient à un cours
     */
    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
}
