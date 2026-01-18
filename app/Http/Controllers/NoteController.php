<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use App\Models\Cours;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    // Affiche toutes les notes
    public function index()
    {
        $notes = Note::with(['etudiant', 'cours'])->get();
        return view('notes.index', compact('notes'));
    }

    // Formulaire d'ajout d'une note
    public function create()
    {
        $etudiants = Etudiant::all();
        $cours = Cours::all();

        return view('notes.create', compact('etudiants', 'cours'));
    }

    // Enregistrer une nouvelle note
    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'cours_id' => 'required|exists:cours,id',
            'valeur' => 'required|numeric|min:0|max:20',
        ]);

        Note::create([
            'etudiant_id' => $request->etudiant_id,
            'cours_id' => $request->cours_id,
            'valeur' => $request->valeur,
        ]);

        return redirect()->route('notes.index')->with('success', 'Note ajoutée avec succès.');
    }
}
