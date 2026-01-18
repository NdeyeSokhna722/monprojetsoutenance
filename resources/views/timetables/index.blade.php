@extends('layouts.app')

@section('title', 'Emploi du temps')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Gestion des emplois du temps</h2>
        <a href="{{ route('timetables.create') }}" 
           class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Ajouter un horaire
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3">Classe</th>
                    <th class="px-6 py-3">Matière</th>
                    <th class="px-6 py-3">Enseignant</th>
                    <th class="px-6 py-3">Jour</th>
                    <th class="px-6 py-3">Horaire</th>
                    <th class="px-6 py-3">Salle</th>
                    <th class="px-6 py-3">Type</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($timetables as $timetable)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $timetable->classe->nom ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">{{ $timetable->matiere->nom ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $timetable->enseignant->nom_complet ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $timetable->jour }}</td>
                        <td class="px-6 py-4">{{ date('H:i', strtotime($timetable->heure_debut)) }} - {{ date('H:i', strtotime($timetable->heure_fin)) }}</td>
                        <td class="px-6 py-4">{{ $timetable->salle ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($timetable->type == 'Cours') bg-blue-100 text-blue-800
                                @elseif($timetable->type == 'TD') bg-green-100 text-green-800
                                @elseif($timetable->type == 'TP') bg-yellow-100 text-yellow-800
                                @elseif($timetable->type == 'Examen') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ $timetable->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('timetables.edit', $timetable) }}" 
                                   class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('timetables.destroy', $timetable) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet horaire ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Aucun emploi du temps n'a été ajouté.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

   <div class="mt-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Filtrer par :</h3>
    <div class="flex flex-wrap gap-3 items-center">
        
        {{-- Tous les horaires --}}
        <a href="{{ route('timetables.index') }}" 
           class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition flex items-center">
            <i class="fas fa-list mr-2"></i>Tous les horaires
        </a>
        
        {{-- Menu déroulant Classes --}}
        <div class="relative">
            <button id="classeDropdownButton" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition flex items-center">
                <i class="fas fa-school mr-2"></i>Par classe
                <i class="fas fa-chevron-down ml-2"></i>
            </button>
            
            <div id="classeDropdown" 
                 class="hidden absolute z-50 mt-2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700">
                <div class="p-2 max-h-60 overflow-y-auto">
                    @foreach($classes as $classe)
                        <a href="{{ route('timetables.byClass', $classe) }}" 
                           class="flex items-center px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                            <i class="fas fa-chalkboard mr-3 text-gray-500"></i>
                            <div>
                                <div class="font-medium">{{ $classe->nom }}</div>
                                @if($classe->niveau)
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $classe->niveau }}</div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Gestion du menu déroulant
    document.getElementById('classeDropdownButton').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('classeDropdown').classList.toggle('hidden');
    });
    
    // Fermer le menu en cliquant ailleurs
    document.addEventListener('click', function() {
        document.getElementById('classeDropdown').classList.add('hidden');
    });
</script>
@endsection