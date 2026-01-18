<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'specialite',
        'matiere_id',
        'photo',
    ];

    protected $appends = ['nom_complet'];

    /**
     * Relation avec la matière
     */
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    /**
     * Accesseur pour le nom complet
     */
    public function getNomCompletAttribute()
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    /**
     * Accesseur pour le nom avec spécialité
     */
    public function getNomAvecSpecialiteAttribute()
    {
        $nomComplet = $this->nom_complet;
        
        if ($this->specialite) {
            $nomComplet .= ' (' . $this->specialite . ')';
        }
        
        if ($this->matiere) {
            $nomComplet .= ' - ' . $this->matiere->nom;
        }
        
        return $nomComplet;
    }

    /**
     * Scope pour les enseignants actifs
     */
    public function scopeActifs($query)
    {
        return $query->where('statut', 'actif')->orWhereNull('statut');
    }

    /**
     * Récupérer les enseignants par spécialité
     */
    public function scopeParSpecialite($query, $specialite)
    {
        return $query->where('specialite', $specialite);
    }

    /**
     * Vérifier si l'enseignant a une photo
     */
    public function hasPhoto()
    {
        return !empty($this->photo) && file_exists(public_path('storage/' . $this->photo));
    }

    /**
     * Récupérer l'URL de la photo
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->hasPhoto()) {
            return asset('storage/' . $this->photo);
        }
        
        // Photo par défaut basée sur l'initiale
        $initiales = strtoupper(substr($this->prenom, 0, 1) . substr($this->nom, 0, 1));
        return 'https://ui-avatars.com/api/?name=' . urlencode($initiales) . '&color=7F9CF5&background=EBF4FF';
    }
}