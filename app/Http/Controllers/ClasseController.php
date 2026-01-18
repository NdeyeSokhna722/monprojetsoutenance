<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::withCount('etudiants')->orderBy('nom')->paginate(15);
        return view('classes.index', compact('classes'));
    }
    
    public function create()
    {
        return view('classes.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'niveau' => 'required|string|max:50',
            'annee_scolaire' => 'required|string|max:9',
        ]);
        
        try {
            Classe::create($validated);
            return redirect()->route('classes.index')
                ->with('success', 'Classe créée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
    
    public function show(Classe $classe)
    {
        $etudiants = $classe->etudiants()->paginate(15);
        return view('classes.show', compact('classe', 'etudiants'));
    }
    
    public function edit(Classe $class)
{
    return view('classes.edit', ['classe' => $class]);
}
    
    public function update(Request $request, Classe $classe)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'niveau' => 'required|string|max:50',
            'annee_scolaire' => 'required|string|max:9',
        ]);
        
        try {
            $classe->update($validated);
            return redirect()->route('classes.index')
                ->with('success', 'Classe mise à jour avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
    
    public function destroy(Classe $classe)
    {
        try {
            // Vérifier si la classe a des étudiants
            if ($classe->etudiants()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'Impossible de supprimer une classe contenant des étudiants.');
            }
            
            $classe->delete();
            return redirect()->route('classes.index')
                ->with('success', 'Classe supprimée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
}