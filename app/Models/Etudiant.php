<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = [
         'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'date_naissance',
        'lieu_naissance', // Ajouté
        'classe_id',
        'statut',
        'genre', // Ajouté (optionnel)
    ];
    
    protected $casts = [
        'date_naissance' => 'date',
    ];
    
   public function notes()
    {
        return $this->hasMany(Note::class);
    }
    
    // Relation avec la classe
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    
    // Calcul de la moyenne
    public function getMoyenneAttribute()
    {
        return $this->notes()->avg('valeur') ?? 0;
    }
    
    // Nom complet
    public function getFullNameAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
    
    // Âge
    public function getAgeAttribute()
    {
        return $this->date_naissance ? now()->diffInYears($this->date_naissance) : null;
    }
}
