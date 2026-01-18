<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // Champs pouvant être remplis via formulaire
    protected $fillable = [
        'etudiant_id',
        'cours_id',
        'valeur',
    ];

    /**
     * Une note appartient à un étudiant
     */
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    /**
     * Une note appartient à un cours
     */
    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
}
