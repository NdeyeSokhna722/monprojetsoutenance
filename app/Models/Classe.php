<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = ['nom', 'niveau', 'annee_scolaire'];
    
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
    
    public function getEffectifAttribute()
    {
        return $this->etudiants()->count();
    }
}