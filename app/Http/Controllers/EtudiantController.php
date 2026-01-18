<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Classe;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $query = Etudiant::with('classe');
        
        // Recherche
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                  ->orWhere('prenom', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        
        // Filtre par classe
        if ($request->has('classe_id') && $request->get('classe_id')) {
            $query->where('classe_id', $request->get('classe_id'));
        }
        
        $etudiants = $query->orderBy('nom')->orderBy('prenom')->paginate(15);
        
        // Statistiques
        $totalEtudiants = Etudiant::count();
        $etudiantsActifs = Etudiant::where('statut', 'actif')->count();
        $classesCount = Classe::count();
        $moyenneParClasse = $classesCount > 0 ? round($totalEtudiants / $classesCount, 1) : 0;
        
        return view('etudiants.index', [
            'etudiants' => $etudiants,
            'classes' => Classe::orderBy('nom')->get(),
            'totalEtudiants' => $totalEtudiants,
            'etudiantsActifs' => $etudiantsActifs,
            'classesCount' => $classesCount,
            'moyenneParClasse' => $moyenneParClasse,
        ]);
    }
    
   public function create()
{
    $classes = Classe::orderBy('nom')->get();
    return view('etudiants.create', compact('classes'));
}
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'date_naissance' => 'nullable|date',
            'classe_id' => 'nullable|exists:classes,id',
            'statut' => 'required|in:actif,inactif,diplome,abandon',
        ]);
        
           
    
    // Créer une notification
    Auth::user()->notify(new \Illuminate\Notifications\Notification([
        'title' => 'Nouvel étudiant inscrit',
        'message' => "{$etudiant->prenom} {$etudiant->nom} a été ajouté à la classe {$etudiant->classe->nom}",
        'type' => 'success',
        'icon' => 'fas fa-user-plus',
        'action_url' => route('etudiants.show', $etudiant->id),
        'action_text' => 'Voir l\'étudiant',
    ]));

        try {
            Etudiant::create($validated);
            return redirect()->route('etudiants.index')
                ->with('success', 'Étudiant créé avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
     
    }
    
    public function show(Etudiant $etudiant)
    {
        return view('etudiants.show', compact('etudiant'));
    }
    
    public function edit(Etudiant $etudiant)
    {
        $classes = Classe::orderBy('nom')->get();
        return view('etudiants.edit', compact('etudiant', 'classes'));
    }
    
    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,' . $etudiant->id,
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'date_naissance' => 'nullable|date',
            'classe_id' => 'nullable|exists:classes,id',
            'statut' => 'required|in:actif,inactif,diplome,abandon',
        ]);
        
        try {
            $etudiant->update($validated);
            return redirect()->route('etudiants.index')
                ->with('success', 'Étudiant mis à jour avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
    
    public function destroy(Etudiant $etudiant)
    {
        try {
            $etudiant->delete();
            return redirect()->route('etudiants.index')
                ->with('success', 'Étudiant supprimé avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
}