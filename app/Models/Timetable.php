<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timetable extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'classe_id',
        'matiere_id',
        'enseignant_id',
        'jour',
        'heure_debut',
        'heure_fin',
        'salle',
        'description',
        'type',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Les valeurs par défaut des attributs du modèle.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'type' => 'Cours',
        'salle' => null,
        'description' => null,
    ];

    /**
     * Relation avec la classe.
     */
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    /**
     * Relation avec la matière.
     */
    public function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class);
    }

    /**
     * Relation avec l'enseignant.
     */
    public function enseignant(): BelongsTo
    {
        return $this->belongsTo(Enseignant::class);
    }

    /**
     * Accesseur pour la durée du cours.
     */
    public function getDureeAttribute(): string
    {
        $debut = \Carbon\Carbon::parse($this->heure_debut);
        $fin = \Carbon\Carbon::parse($this->heure_fin);
        $duree = $debut->diff($fin);
        
        $heures = $duree->h;
        $minutes = str_pad($duree->i, 2, '0', STR_PAD_LEFT);
        
        return $heures > 0 ? "{$heures}h{$minutes}" : "{$minutes}min";
    }

    /**
     * Accesseur pour l'horaire formaté.
     */
    public function getHoraireAttribute(): string
    {
        $debut = date('H:i', strtotime($this->heure_debut));
        $fin = date('H:i', strtotime($this->heure_fin));
        
        return "{$debut} - {$fin}";
    }

    /**
     * Accesseur pour le jour complet.
     */
    public function getJourCompletAttribute(): string
    {
        return $this->jour;
    }

    /**
     * Accesseur pour le nom de la classe.
     */
    public function getNomClasseAttribute(): string
    {
        return $this->classe ? $this->classe->nom : 'N/A';
    }

    /**
     * Accesseur pour le nom de la matière.
     */
    public function getNomMatiereAttribute(): string
    {
        return $this->matiere ? $this->matiere->nom : 'N/A';
    }

    /**
     * Accesseur pour le nom complet de l'enseignant.
     */
    public function getNomEnseignantAttribute(): string
    {
        return $this->enseignant ? $this->enseignant->nom_complet : 'N/A';
    }

    /**
     * Scope pour filtrer par classe.
     */
    public function scopeParClasse($query, $classeId)
    {
        return $query->where('classe_id', $classeId);
    }

    /**
     * Scope pour filtrer par enseignant.
     */
    public function scopeParEnseignant($query, $enseignantId)
    {
        return $query->where('enseignant_id', $enseignantId);
    }

    /**
     * Scope pour filtrer par jour.
     */
    public function scopeParJour($query, $jour)
    {
        return $query->where('jour', $jour);
    }

    /**
     * Scope pour les horaires d'aujourd'hui.
     */
    public function scopeAujourdhui($query)
    {
        $jours = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $jourActuel = $jours[date('w')];
        
        return $query->where('jour', $jourActuel);
    }

    /**
     * Scope pour ordonner par jour et heure.
     */
    public function scopeOrdonnerParHoraire($query)
    {
        // Ordre des jours
        $ordreJours = [
            'Lundi' => 1,
            'Mardi' => 2,
            'Mercredi' => 3,
            'Jeudi' => 4,
            'Vendredi' => 5,
            'Samedi' => 6,
            'Dimanche' => 7
        ];
        
        return $query->orderByRaw('FIELD(jour, ?, ?, ?, ?, ?, ?, ?)', array_keys($ordreJours))
                     ->orderBy('heure_debut');
    }

    /**
     * Vérifie si l'horaire est en conflit avec un autre.
     */
    public function estEnConflit($jour, $heureDebut, $heureFin, $salle = null, $exclureId = null): bool
    {
        $query = self::where('jour', $jour)
            ->where(function ($q) use ($heureDebut, $heureFin) {
                $q->where(function ($q2) use ($heureDebut, $heureFin) {
                    // L'horaire commence pendant un autre horaire
                    $q2->where('heure_debut', '<=', $heureDebut)
                       ->where('heure_fin', '>', $heureDebut);
                })->orWhere(function ($q2) use ($heureDebut, $heureFin) {
                    // L'horaire se termine pendant un autre horaire
                    $q2->where('heure_debut', '<', $heureFin)
                       ->where('heure_fin', '>=', $heureFin);
                })->orWhere(function ($q2) use ($heureDebut, $heureFin) {
                    // L'horaire englobe un autre horaire
                    $q2->where('heure_debut', '>=', $heureDebut)
                       ->where('heure_fin', '<=', $heureFin);
                });
            });

        // Vérifier aussi par salle si spécifiée
        if ($salle) {
            $query->orWhere('salle', $salle);
        }

        // Exclure l'ID actuel pour la mise à jour
        if ($exclureId) {
            $query->where('id', '!=', $exclureId);
        }

        return $query->exists();
    }

    /**
     * Récupérer les horaires par classe pour affichage.
     */
    public static function getParClasse($classeId)
    {
        return self::with(['matiere', 'enseignant'])
            ->parClasse($classeId)
            ->ordonnerParHoraire()
            ->get()
            ->groupBy('jour');
    }

    /**
     * Récupérer les horaires par enseignant pour affichage.
     */
    public static function getParEnseignant($enseignantId)
    {
        return self::with(['classe', 'matiere'])
            ->parEnseignant($enseignantId)
            ->ordonnerParHoraire()
            ->get()
            ->groupBy('jour');
    }

    /**
     * Formatage pour l'affichage dans un calendrier.
     */
    public function toCalendarEvent(): array
    {
        $couleurs = [
            'Cours' => '#3b82f6',  // bleu
            'TD' => '#10b981',     // vert
            'TP' => '#f59e0b',     // jaune/orange
            'Examen' => '#ef4444', // rouge
            'Autre' => '#6b7280',  // gris
        ];

        return [
            'id' => $this->id,
            'title' => $this->matiere->nom . ' - ' . $this->classe->nom,
            'start' => $this->jour . 'T' . $this->heure_debut,
            'end' => $this->jour . 'T' . $this->heure_fin,
            'backgroundColor' => $couleurs[$this->type] ?? $couleurs['Autre'],
            'borderColor' => $couleurs[$this->type] ?? $couleurs['Autre'],
            'extendedProps' => [
                'salle' => $this->salle,
                'enseignant' => $this->enseignant->nom_complet,
                'type' => $this->type,
            ],
        ];
    }
}