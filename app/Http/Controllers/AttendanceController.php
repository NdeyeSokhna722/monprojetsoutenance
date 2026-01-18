<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        // Récupérer tous les étudiants avec leur classe, paginés
        $etudiants = Etudiant::with('classe')
            ->orderBy('nom')
            ->orderBy('prenom')
            ->paginate(20); // Pagination avec 20 étudiants par page

        return view('attendances.index', compact('etudiants'));
    }

    public function store(Request $request)
    {
        // Valider les données
        $validated = $request->validate([
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent',
            'notes' => 'sometimes|array',
            'date' => 'required|date',
        ]);
        
        // Enregistrer chaque présence
        foreach ($request->attendance as $studentId => $status) {
            $note = $request->notes[$studentId] ?? null;
            
            Attendance::updateOrCreate(
                [
                    'etudiant_id' => $studentId,
                    'date' => $request->date,
                ],
                [
                    'status' => $status,
                    'note' => $note,
                    'user_id' => Auth::id(), // Si vous suivez qui a enregistré
                ]
            );
        }
        
        return redirect()->route('attendances.index')
            ->with('success', 'Présences enregistrées avec succès !');
    }
}