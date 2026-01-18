<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emploi;
use App\Models\Cours;

class EmploiController extends Controller
{
    // Afficher la liste des créneaux
    public function index()
    {
        $emplois = Emploi::with('cours')->get();
        return view('emplois.index', compact('emplois'));
    }

    // Formulaire pour ajouter un créneau
    public function create()
    {
        $cours = Cours::all();
        return view('emplois.create', compact('cours'));
    }

    // Enregistrer un créneau
    public function store(Request $request)
    {
        $request->validate([
            'jour' => 'required|string',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'cours_id' => 'nullable|exists:cours,id',
        ]);

        Emploi::create($request->only('jour','heure_debut','heure_fin','cours_id'));

        return redirect()->route('emplois.index')->with('success', 'Créneau ajouté avec succès.');
    }

    // Formulaire pour modifier un créneau
    public function edit($id)
    {
        $emploi = Emploi::findOrFail($id);
        $cours = Cours::all();
        return view('emplois.edit', compact('emploi', 'cours'));
    }

    // Mettre à jour un créneau
    public function update(Request $request, $id)
    {
        $request->validate([
            'jour' => 'required|string',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'cours_id' => 'nullable|exists:cours,id',
        ]);

        $emploi = Emploi::findOrFail($id);
        $emploi->update($request->only('jour','heure_debut','heure_fin','cours_id'));

        return redirect()->route('emplois.index')->with('success', 'Créneau modifié avec succès.');
    }

    // Supprimer un créneau
    public function destroy($id)
    {
        $emploi = Emploi::findOrFail($id);
        $emploi->delete();

        return redirect()->route('emplois.index')->with('success', 'Créneau supprimé avec succès.');
    }
}
