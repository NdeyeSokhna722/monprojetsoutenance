<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'enseignant_id',
    ];

    /**
     * Un cours appartient à un enseignant
     */
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    /**
     * Un cours peut avoir plusieurs notes
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Relation avec les étudiants via les notes
     */
    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'notes', 'cours_id', 'etudiant_id');
    }
}
