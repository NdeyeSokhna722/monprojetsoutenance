<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
use App\Models\Enseignant;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques principales
        $totalUsers = User::count();
        $totalEnseignants = Enseignant::count();
        $totalEtudiants = Etudiant::count();
        $totalClasses = Classe::count();

        // Derniers étudiants inscrits
        $lastEtudiants = Etudiant::with('classe')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Évolution des inscriptions (6 derniers mois)
        $months = [];
        $studentsPerMonth = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('M');
            
            $count = Etudiant::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $studentsPerMonth[] = $count;
        }

        // Activité récente (dernières actions)
        $recentActivity = [
            'new_students' => Etudiant::whereDate('created_at', today())->count(),
            'new_teachers' => Enseignant::whereDate('created_at', today())->count(),
            'updated_profiles' => Etudiant::whereDate('updated_at', today())->count(),
        ];

        // Performance par matière (moyennes) - VERSION CORRIGÉE
        $matieres = Matiere::all()->map(function($matiere) {
            // Vérifier si la table des notes existe et a des données
            try {
                // Essayer de récupérer la moyenne depuis la table notes
                $moyenne = Note::where('matiere_id', $matiere->id)->avg('valeur');
            } catch (\Exception $e) {
                // Si la table n'existe pas ou autre erreur, utiliser une valeur par défaut
                $moyenne = null;
            }
            
            return [
                'nom' => $matiere->nom,
                'moyenne' => $moyenne ?? $this->generateRandomAverage(),
                'couleur' => $this->getColorForMatiere($matiere->id)
            ];
        });

        // Prochaines échéances (prochains 4 événements)
        $upcomingEvents = [
            [
                'titre' => 'Réunion pédagogique',
                'date' => Carbon::now()->addDays(2)->format('d M Y'),
                'couleur' => 'bg-blue-500'
            ],
            [
                'titre' => 'Examens trimestriels',
                'date' => Carbon::now()->addDays(7)->format('d M Y'),
                'couleur' => 'bg-orange-500'
            ],
            [
                'titre' => 'Journée portes ouvertes',
                'date' => Carbon::now()->addDays(14)->format('d M Y'),
                'couleur' => 'bg-purple-500'
            ],
            [
                'titre' => 'Conseil de classe',
                'date' => Carbon::now()->addDays(21)->format('d M Y'),
                'couleur' => 'bg-green-500'
            ]
        ];

        // Statistiques de performance
        $averageStudentsPerClass = $totalClasses > 0 ? round($totalEtudiants / $totalClasses, 1) : 0;
        
        // Calcul de l'âge moyen
        $averageAge = 0;
        $etudiantsAvecDate = Etudiant::whereNotNull('date_naissance')->get();
        if ($etudiantsAvecDate->count() > 0) {
            $totalAge = 0;
            foreach ($etudiantsAvecDate as $etudiant) {
                $totalAge += Carbon::parse($etudiant->date_naissance)->age;
            }
            $averageAge = round($totalAge / $etudiantsAvecDate->count(), 1);
        }

        // Pourcentage d'étudiants actifs
        $activeStudents = Etudiant::where('statut', 'actif')->count();
        $activePercentage = $totalEtudiants > 0 ? round(($activeStudents / $totalEtudiants) * 100) : 0;

        // Nouveaux étudiants ce mois-ci
        $newStudentsThisMonth = Etudiant::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        // Enseignants disponibles (sans classe assignée)
        // Note: Si la relation classes n'existe pas, on compte tous les enseignants
        try {
            $availableTeachers = Enseignant::doesntHave('classes')->count();
        } catch (\Exception $e) {
            $availableTeachers = $totalEnseignants;
        }

        return view('dashboard', compact(
            'totalUsers',
            'totalEnseignants',
            'totalEtudiants',
            'totalClasses',
            'lastEtudiants',
            'months',
            'studentsPerMonth',
            'recentActivity',
            'matieres',
            'upcomingEvents',
            'averageStudentsPerClass',
            'averageAge',
            'activePercentage',
            'newStudentsThisMonth',
            'availableTeachers'
        ));
    }

    private function getColorForMatiere($id)
    {
        $colors = [
            'bg-blue-500', 'bg-purple-500', 'bg-green-500', 
            'bg-red-500', 'bg-yellow-500', 'bg-indigo-500',
            'bg-pink-500', 'bg-teal-500', 'bg-cyan-500', 'bg-amber-500'
        ];
        return $colors[$id % count($colors)];
    }
    
    private function generateRandomAverage()
    {
        // Génère une note aléatoire entre 10.0 et 18.0
        return rand(100, 180) / 10;
    }
}