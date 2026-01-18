<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\Matiere;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
   public function index(Request $request)
{
    $query = Enseignant::with('matiere');

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nom', 'like', '%'.$search.'%')
              ->orWhere('prenom', 'like', '%'.$search.'%')
              ->orWhere('email', 'like', '%'.$search.'%')
              ->orWhere('specialite', 'like', '%'.$search.'%');
        });
    }

    // Paginer les résultats avec 10 éléments par page
    $enseignants = $query->paginate(10);

    return view('enseignants.index', compact('enseignants'));
}

public function show(Enseignant $enseignant)
{
    // Charger la relation matière pour éviter les requêtes supplémentaires
    $enseignant->load('matiere');
    
    // Si l'enseignant a des classes, vous pouvez aussi les charger
    // $enseignant->load('classes');

    return view('enseignants.show', compact('enseignant'));
}
    public function create()
    {
        $matieres = Matiere::all();
        return view('enseignants.create', compact('matieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:enseignants,email',
            'telephone' => 'nullable|string|max:50',
            'specialite' => 'nullable|string|max:255',
            'matiere_id' => 'required|exists:matieres,id',
        ]);

        if ($request->hasFile('photo')) {
    $photoPath = $request->file('photo')->store('enseignants', 'public');
} else {
    $photoPath = null;
}

Enseignant::create([
    'nom' => $request->nom,
    'prenom' => $request->prenom,
    'email' => $request->email,
    'telephone' => $request->telephone,
    'specialite' => $request->specialite,
    'matiere_id' => $request->matiere_id,
    'photo' => $photoPath,
]);


        return redirect()->route('enseignants.index')
            ->with('success', 'Enseignant ajouté avec succès.');
    }

    public function edit(Enseignant $enseignant)
    {
        $matieres = Matiere::all();
        return view('enseignants.edit', compact('enseignant', 'matieres'));
    }

    public function update(Request $request, Enseignant $enseignant)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => "required|email|unique:enseignants,email,{$enseignant->id}",
            'telephone' => 'nullable|string|max:50',
            'specialite' => 'nullable|string|max:255',
            'matiere_id' => 'required|exists:matieres,id',
        ]);

        $enseignant->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'specialite' => $request->specialite,
            'matiere_id' => $request->matiere_id,
        ]);

        return redirect()->route('enseignants.index')
            ->with('success', 'Enseignant mis à jour avec succès.');
    }

    public function destroy(Enseignant $enseignant)
    {
        $enseignant->delete();

        return redirect()->route('enseignants.index')
            ->with('success', 'Enseignant supprimé.');
    }
}
