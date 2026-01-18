<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preinscription extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'genre',
        'date_naissance',
        'lieu_naissance',
        'niveau_demande',
        'parent_nom',
        'parent_prenom',
        'email',
        'telephone',
        'relation',
        'profession',
        'adresse',
        'message',
        'newsletter',
        'statut',
        'numero_dossier',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'newsletter' => 'boolean',
    ];
}