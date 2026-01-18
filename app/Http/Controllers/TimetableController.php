<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Enseignant;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $timetables = Timetable::with(['classe', 'matiere', 'enseignant'])
        ->orderByRaw("FIELD(jour, 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche')")
        ->orderBy('heure_debut')
        ->get();
    
    // AJOUTEZ CETTE LIGNE :
    $classes = Classe::orderBy('nom')->get();
    
    return view('timetables.index', compact('timetables', 'classes'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all();
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();
        
        // Liste des salles prédéfinies (remplacez par vos propres salles)
        $salles = [
            'B101', 'B102', 'B103', 'B104', 'B105',
            'B201', 'B202', 'B203', 'B204', 'B205',
            'Amphi A', 'Amphi B', 'Amphi C',
            'Labo Informatique 1', 'Labo Informatique 2',
            'Labo Physique', 'Labo Chimie',
            'Salle de Réunion', 'Bibliothèque'
        ];
        
        return view('timetables.create', compact('classes', 'matieres', 'enseignants', 'salles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'matiere_id' => 'required|exists:matieres,id',
            'enseignant_id' => 'required|exists:enseignants,id',
            'jour' => 'required|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Samedi,Dimanche',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'salle' => 'nullable|string|max:100',
            'type' => 'required|in:Cours,TD,TP,Examen,Autre',
        ]);

        Timetable::create($request->all());

        return redirect()->route('timetables.index')
            ->with('success', 'Emploi du temps ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Timetable $timetable)
    {
        return view('timetables.show', compact('timetable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timetable $timetable)
    {
        $classes = Classe::all();
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();
        
        // Liste des salles prédéfinies
        $salles = [
            'B101', 'B102', 'B103', 'B104', 'B105',
            'B201', 'B202', 'B203', 'B204', 'B205',
            'Amphi A', 'Amphi B', 'Amphi C',
            'Labo Informatique 1', 'Labo Informatique 2',
            'Labo Physique', 'Labo Chimie',
            'Salle de Réunion', 'Bibliothèque'
        ];
        
        return view('timetables.edit', compact('timetable', 'classes', 'matieres', 'enseignants', 'salles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timetable $timetable)
    {
        $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'matiere_id' => 'required|exists:matieres,id',
            'enseignant_id' => 'required|exists:enseignants,id',
            'jour' => 'required|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Samedi,Dimanche',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'salle' => 'nullable|string|max:100',
            'type' => 'required|in:Cours,TD,TP,Examen,Autre',
        ]);

        $timetable->update($request->all());

        return redirect()->route('timetables.index')
            ->with('success', 'Emploi du temps mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timetable $timetable)
    {
        $timetable->delete();

        return redirect()->route('timetables.index')
            ->with('success', 'Emploi du temps supprimé avec succès.');
    }

    /**
     * Afficher l'emploi du temps par classe
     */
    public function byClass(Classe $classe)
    {
        $timetables = Timetable::where('classe_id', $classe->id)
            ->with(['matiere', 'enseignant'])
            ->orderByRaw("FIELD(jour, 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche')")
            ->orderBy('heure_debut')
            ->get();
            
        return view('timetables.by-class', compact('timetables', 'classe'));
    }

    /**
     * Afficher l'emploi du temps par enseignant
     */
    public function byTeacher(Enseignant $enseignant)
    {
        $timetables = Timetable::where('enseignant_id', $enseignant->id)
            ->with(['classe', 'matiere'])
            ->orderByRaw("FIELD(jour, 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche')")
            ->orderBy('heure_debut')
            ->get();
            
        return view('timetables.by-teacher', compact('timetables', 'enseignant'));
    }
}