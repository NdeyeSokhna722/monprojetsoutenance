@extends('layouts.app')

@section('title', 'Emploi du temps - ' . $classe->nom)

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    <i class="fas fa-calendar-alt mr-2"></i>Emploi du temps - {{ $classe->nom }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Niveau : {{ $classe->niveau ?? 'Non spécifié' }}
                </p>
            </div>
            <div>
                <a href="{{ route('timetables.index') }}" 
                   class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium py-2 px-4 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
                <a href="{{ route('timetables.create') }}" 
                   class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded-lg transition ml-2">
                    <i class="fas fa-plus mr-2"></i>Ajouter
                </a>
            </div>
        </div>
    </div>

    @if($timetables->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-calendar-times text-4xl text-gray-400 mb-4"></i>
            <p class="text-gray-600 dark:text-gray-400 text-lg">Aucun emploi du temps pour cette classe.</p>
            <a href="{{ route('timetables.create') }}" class="text-orange-600 hover:text-orange-700 mt-4 inline-block">
                Ajouter le premier horaire →
            </a>
        </div>
    @else
        {{-- Tableau des horaires groupés par jour --}}
        @php
            $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
            $timetablesParJour = $timetables->groupBy('jour');
        @endphp

        <div class="space-y-6">
            @foreach($jours as $jour)
                @if($timetablesParJour->has($jour))
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                        <div class="bg-gray-100 dark:bg-gray-700 px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="font-semibold text-lg text-gray-900 dark:text-white">{{ $jour }}</h3>
                        </div>
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($timetablesParJour[$jour] as $timetable)
                                <div class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="flex items-center">
                                                <span class="font-medium text-gray-900 dark:text-white">
                                                    {{ date('H:i', strtotime($timetable->heure_debut)) }} - {{ date('H:i', strtotime($timetable->heure_fin)) }}
                                                </span>
                                                <span class="ml-4 px-2 py-1 text-xs rounded-full 
                                                    @if($timetable->type == 'Cours') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                    @elseif($timetable->type == 'TD') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @elseif($timetable->type == 'TP') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                    @elseif($timetable->type == 'Examen') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                                    @endif">
                                                    {{ $timetable->type }}
                                                </span>
                                            </div>
                                            <div class="mt-2">
                                                <p class="text-gray-900 dark:text-white font-medium">
                                                    {{ $timetable->matiere->nom ?? 'N/A' }}
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    Enseignant : {{ $timetable->enseignant->nom_complet ?? 'N/A' }}
                                                    @if($timetable->salle)
                                                        • Salle : {{ $timetable->salle }}
                                                    @endif
                                                </p>
                                                @if($timetable->description)
                                                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">
                                                        {{ $timetable->description }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('timetables.edit', $timetable) }}" 
                                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                               title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('timetables.destroy', $timetable) }}" 
                                                  method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet horaire ?')"
                                                        title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Statistiques --}}
        <div class="mt-8 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
            <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Statistiques</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center p-3 bg-white dark:bg-gray-700 rounded">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $timetables->count() }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Horaire(s)</p>
                </div>
                <div class="text-center p-3 bg-white dark:bg-gray-700 rounded">
                    @php
                        $coursCount = $timetables->where('type', 'Cours')->count();
                    @endphp
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $coursCount }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Cours</p>
                </div>
                <div class="text-center p-3 bg-white dark:bg-gray-700 rounded">
                    @php
                        $tdtpCount = $timetables->whereIn('type', ['TD', 'TP'])->count();
                    @endphp
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $tdtpCount }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">TD/TP</p>
                </div>
                <div class="text-center p-3 bg-white dark:bg-gray-700 rounded">
                    @php
                        $enseignantsUniques = $timetables->pluck('enseignant_id')->unique()->count();
                    @endphp
                    <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $enseignantsUniques }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Enseignants</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection