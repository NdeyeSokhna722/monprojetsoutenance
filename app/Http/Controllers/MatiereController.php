<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index(Request $request)
    {
        $query = Matiere::query();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $matieres = $query->latest()->paginate(10);
        
        return view('matieres.index', compact('matieres'));
    }
    
    public function create()
    {
        return view('matieres.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'nullable|string|max:20',
            'description' => 'nullable|string',
        ]);
        
        Matiere::create($request->all());
        
        return redirect()->route('matieres.index')
            ->with('success', 'Matière créée avec succès.');
    }
    
    
    public function edit(Matiere $matiere)
    {
        return view('matieres.edit', compact('matiere'));
    }
    
    public function update(Request $request, Matiere $matiere)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'nullable|string|max:20',
            'description' => 'nullable|string',
        ]);
        
        $matiere->update($request->all());
        
        return redirect()->route('matieres.index')
            ->with('success', 'Matière mise à jour avec succès.');
    }
    
    public function destroy(Matiere $matiere)
    {
        $matiere->delete();
        
        return redirect()->route('matieres.index')
            ->with('success', 'Matière supprimée avec succès.');
    }
}