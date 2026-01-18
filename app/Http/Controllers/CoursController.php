<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Enseignant;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    /**
     * Afficher la liste des cours.
     */
    public function index()
    {
        $cours = Cours::with('enseignant')->get();
        return view('cours.index', compact('cours'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $enseignants = Enseignant::all();
        return view('cours.create', compact('enseignants'));
    }

    /**
     * Enregistrer un cours.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'enseignant_id' => 'required|exists:enseignants,id',
        ]);

        Cours::create($request->all());

        return redirect()->route('cours.index')->with('success', 'Cours ajouté avec succès.');
    }

    /**
     * Formulaire d'édition.
     */
    public function edit(Cours $cour)
    {
        $enseignants = Enseignant::all();
        return view('cours.edit', ['cours' => $cour, 'enseignants' => $enseignants]);
    }

    /**
     * Mettre à jour un cours.
     */
    public function update(Request $request, Cours $cour)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'enseignant_id' => 'required|exists:enseignants,id',
        ]);

        $cour->update($request->all());

        return redirect()->route('cours.index')->with('success', 'Cours modifié avec succès.');
    }

    /**
     * Supprimer un cours.
     */
    public function destroy(Cours $cour)
    {
        $cour->delete();
        return redirect()->route('cours.index')->with('success', 'Cours supprimé avec succès.');
    }
}
