<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendrierController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $weekStart = now()->startOfWeek()->toDateString();
        $weekEnd = now()->endOfWeek()->toDateString();

        // Événements d'aujourd'hui
        $todayEvents = Event::whereDate('start', $today)
            ->where(function($query) {
                $query->where('user_id', Auth::id())
                      ->orWhere('created_by', Auth::id())
                      ->orWhere('is_public', true);
            })->count();

        // Événements de la semaine
        $weekEvents = Event::whereBetween('start', [$weekStart, $weekEnd])
            ->where(function($query) {
                $query->where('user_id', Auth::id())
                      ->orWhere('created_by', Auth::id())
                      ->orWhere('is_public', true);
            })->count();

        // Mes événements
        $myEvents = Event::where(function($query) {
            $query->where('user_id', Auth::id())
                  ->orWhere('created_by', Auth::id());
        })->count();

        // Événements de type examen
        $examEvents = Event::where('type', 'examen')
            ->where(function($query) {
                $query->where('user_id', Auth::id())
                      ->orWhere('created_by', Auth::id())
                      ->orWhere('is_public', true);
            })->count();

        // Événements à venir (à partir de maintenant)
        $upcomingEvents = Event::where('start', '>=', now())
            ->where('start', '<=', now()->addDays(7))
            ->where(function($query) {
                $query->where('user_id', Auth::id())
                      ->orWhere('created_by', Auth::id())
                      ->orWhere('is_public', true);
            })
            ->orderBy('start')
            ->take(10)
            ->get();

        return view('calendrier.index', compact(
            'todayEvents',
            'weekEvents',
            'myEvents',
            'examEvents',
            'upcomingEvents'
        ));
    }

    public function getEventsByMonth(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        $events = Event::whereYear('start', $year)
            ->whereMonth('start', $month)
            ->where(function($query) {
                $query->where('user_id', auth()->id())
                      ->orWhere('created_by', auth()->id())
                      ->orWhere('is_public', true);
            })
            ->orderBy('start')
            ->get();

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'required|string|in:cours,examen,réunion,événement,vacances,autre',
            'color' => 'nullable|string',
        ]);

        // Utiliser les bons noms de colonnes pour la base de données
        $eventData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start' => $validated['start_date'],  // ICI: start au lieu de start_date
            'end' => $validated['end_date'] ?? null,  // ICI: end au lieu de end_date
            'type' => $validated['type'],
            'color' => $validated['color'] ?? '#3b82f6',
            'user_id' => auth()->id(),
            'created_by' => auth()->id(),
            'is_public' => $request->has('is_public')
        ];
        
        $event = Event::create($eventData);
        
        return response()->json([
            'success' => true,
            'message' => 'Événement créé avec succès',
            'event' => $event
        ]);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        // Vérifier les permissions
        if ($event->user_id != auth()->id() && $event->created_by != auth()->id() && !$event->is_public) {
            return response()->json([
                'success' => false,
                'message' => 'Non autorisé'
            ], 403);
        }

        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        // Vérifier les permissions
        if ($event->user_id != auth()->id() && $event->created_by != auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Non autorisé'
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'required|string|in:cours,examen,réunion,événement,vacances,autre',
            'color' => 'nullable|string',
        ]);

        // Utiliser les bons noms de colonnes
        $eventData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start' => $validated['start_date'],  // ICI: start au lieu de start_date
            'end' => $validated['end_date'] ?? null,  // ICI: end au lieu de end_date
            'type' => $validated['type'],
            'color' => $validated['color'] ?? '#3b82f6',
            'is_public' => $request->has('is_public')
        ];

        $event->update($eventData);
        
        return response()->json([
            'success' => true,
            'message' => 'Événement modifié avec succès',
            'event' => $event
        ]);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        // Vérifier les permissions
        if ($event->user_id != auth()->id() && $event->created_by != auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Non autorisé'
            ], 403);
        }

        $event->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Événement supprimé avec succès'
        ]);
    }

    public function getStats()
    {
        $today = now()->toDateString();
        $weekStart = now()->startOfWeek()->toDateString();
        $weekEnd = now()->endOfWeek()->toDateString();

        $stats = [
            'today' => Event::whereDate('start', $today)
                ->where(function($query) {
                    $query->where('user_id', auth()->id())
                          ->orWhere('created_by', auth()->id())
                          ->orWhere('is_public', true);
                })->count(),
            'week' => Event::whereBetween('start', [$weekStart, $weekEnd])
                ->where(function($query) {
                    $query->where('user_id', auth()->id())
                          ->orWhere('created_by', auth()->id())
                          ->orWhere('is_public', true);
                })->count(),
            'myEvents' => Event::where(function($query) {
                $query->where('user_id', auth()->id())
                      ->orWhere('created_by', auth()->id());
            })->count(),
            'exams' => Event::where('type', 'examen')
                ->where(function($query) {
                    $query->where('user_id', auth()->id())
                          ->orWhere('created_by', auth()->id())
                          ->orWhere('is_public', true);
                })->count()
        ];

        return response()->json($stats);
    }
}