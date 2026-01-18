<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Enseignant;
use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $totalEtudiants = Etudiant::count();
        $totalEnseignants = Enseignant::count();
        $totalClasses = Classe::count();
        $totalUsers = User::count();

        // Répartition par classe (pour un graphique)
        $classes = Classe::withCount('etudiants')->get();

        // Répartition par rôle
        $roles = User::select('role', \DB::raw('count(*) as total'))
                     ->groupBy('role')
                     ->get();

        return view('rapports.index', compact(
            'totalEtudiants',
            'totalEnseignants',
            'totalClasses',
            'totalUsers',
            'classes',
            'roles'
        ));
    }
}
