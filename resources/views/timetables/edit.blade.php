@extends('layouts.app')

@section('title', 'Modifier un horaire')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Modifier l'horaire</h2>

    <form action="{{ route('timetables.update', $timetable) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Classe --}}
            <div>
                <label for="classe_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Classe *
                </label>
                <select id="classe_id" name="classe_id" required
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Sélectionnez une classe</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}" {{ old('classe_id', $timetable->classe_id) == $classe->id ? 'selected' : '' }}>
                            {{ $classe->nom }}
                        </option>
                    @endforeach
                </select>
                @error('classe_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Matière --}}
            <div>
                <label for="matiere_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Matière *
                </label>
                <select id="matiere_id" name="matiere_id" required
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Sélectionnez une matière</option>
                    @foreach($matieres as $matiere)
                        <option value="{{ $matiere->id }}" {{ old('matiere_id', $timetable->matiere_id) == $matiere->id ? 'selected' : '' }}>
                            {{ $matiere->nom }}
                        </option>
                    @endforeach
                </select>
                @error('matiere_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Enseignant --}}
            <div>
                <label for="enseignant_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Enseignant *
                </label>
                <select id="enseignant_id" name="enseignant_id" required
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Sélectionnez un enseignant</option>
                    @foreach($enseignants as $enseignant)
                        <option value="{{ $enseignant->id }}" {{ old('enseignant_id', $timetable->enseignant_id) == $enseignant->id ? 'selected' : '' }}>
                            {{ $enseignant->nom_complet }}
                        </option>
                    @endforeach
                </select>
                @error('enseignant_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jour --}}
            <div>
                <label for="jour" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Jour *
                </label>
                <select id="jour" name="jour" required
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Sélectionnez un jour</option>
                    <option value="Lundi" {{ old('jour', $timetable->jour) == 'Lundi' ? 'selected' : '' }}>Lundi</option>
                    <option value="Mardi" {{ old('jour', $timetable->jour) == 'Mardi' ? 'selected' : '' }}>Mardi</option>
                    <option value="Mercredi" {{ old('jour', $timetable->jour) == 'Mercredi' ? 'selected' : '' }}>Mercredi</option>
                    <option value="Jeudi" {{ old('jour', $timetable->jour) == 'Jeudi' ? 'selected' : '' }}>Jeudi</option>
                    <option value="Vendredi" {{ old('jour', $timetable->jour) == 'Vendredi' ? 'selected' : '' }}>Vendredi</option>
                    <option value="Samedi" {{ old('jour', $timetable->jour) == 'Samedi' ? 'selected' : '' }}>Samedi</option>
                    <option value="Dimanche" {{ old('jour', $timetable->jour) == 'Dimanche' ? 'selected' : '' }}>Dimanche</option>
                </select>
                @error('jour')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Heure début --}}
            <div>
                <label for="heure_debut" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Heure de début *
                </label>
                <input type="time" id="heure_debut" name="heure_debut" 
                       value="{{ old('heure_debut', date('H:i', strtotime($timetable->heure_debut))) }}" required
                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                @error('heure_debut')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Heure fin --}}
            <div>
                <label for="heure_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Heure de fin *
                </label>
                <input type="time" id="heure_fin" name="heure_fin" 
                       value="{{ old('heure_fin', date('H:i', strtotime($timetable->heure_fin))) }}" required
                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                @error('heure_fin')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Salle --}}
            <div>
                <label for="salle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Salle
                </label>
                <input type="text" id="salle" name="salle" value="{{ old('salle', $timetable->salle) }}"
                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                       placeholder="Ex: B12, Amphi A">
                @error('salle')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Type *
                </label>
                <select id="type" name="type" required
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Sélectionnez un type</option>
                    <option value="Cours" {{ old('type', $timetable->type) == 'Cours' ? 'selected' : '' }}>Cours</option>
                    <option value="TD" {{ old('type', $timetable->type) == 'TD' ? 'selected' : '' }}>TD (Travaux Dirigés)</option>
                    <option value="TP" {{ old('type', $timetable->type) == 'TP' ? 'selected' : '' }}>TP (Travaux Pratiques)</option>
                    <option value="Examen" {{ old('type', $timetable->type) == 'Examen' ? 'selected' : '' }}>Examen</option>
                    <option value="Autre" {{ old('type', $timetable->type) == 'Autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description
                </label>
                <textarea id="description" name="description" rows="3"
                          class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                          placeholder="Description optionnelle...">{{ old('description', $timetable->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex justify-end space-x-4 mt-8">
            <a href="{{ route('timetables.index') }}" 
               class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                Annuler
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection