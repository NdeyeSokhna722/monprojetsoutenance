@extends('layouts.app')

@section('content')

{{-- EN-TÊTE AVEC CHEMIN DE NAVIGATION --}}
<div class="mb-10">
    <div class="flex items-center gap-3 mb-4 text-sm text-gray-500 dark:text-gray-400">
        <a href="{{ route('classes.index') }}" class="hover:text-orange-500 dark:hover:text-orange-400 transition-colors">
            <i class="fas fa-home"></i> Accueil
        </a>
        <i class="fas fa-chevron-right"></i>
        <a href="{{ route('classes.index') }}" class="hover:text-orange-500 dark:hover:text-orange-400 transition-colors">
            Classes
        </a>
        <i class="fas fa-chevron-right"></i>
        <span class="text-orange-500 dark:text-orange-400 font-medium">Modifier</span>
    </div>

    <div class="flex items-center gap-4">
        <a href="{{ route('classes.index') }}" 
           class="p-3 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 text-gray-600 dark:text-gray-400 hover:text-orange-500 dark:hover:text-orange-400 transition-all duration-300 transform hover:-translate-x-1 hover:shadow-md">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500/20 to-orange-600/20 dark:from-orange-500/30 dark:to-orange-600/30 flex items-center justify-center">
                    <i class="fas fa-edit text-orange-600 dark:text-orange-500"></i>
                </div>
                Modifier la classe
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">
                Mettez à jour les informations de la classe <span class="font-semibold text-orange-600 dark:text-orange-400">{{ $classe->nom }}</span>
            </p>
        </div>
    </div>
</div>

{{-- CARTE FORMULAIRE --}}
<div class="max-w-2xl mx-auto">
    <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
        
        {{-- BANDEAU D'ÉDITION --}}
        <div class="bg-gradient-to-r from-blue-500 to-cyan-600 p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                        <i class="fas fa-pencil-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Édition de la classe</h2>
                        <p class="text-blue-100 text-sm">
                            ID: {{ $classe->id }} 
                            @if($classe->created_at)
                                • Créée le {{ $classe->created_at->format('d/m/Y') }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm">
                    <span class="text-white font-semibold text-sm">ÉDITION</span>
                </div>
            </div>
        </div>

        {{-- CORPS DU FORMULAIRE --}}
        <form action="{{ route('classes.update', $classe->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            {{-- NOM DE LA CLASSE --}}
            <div class="mb-8">
                <label class="block mb-3">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-100 to-orange-200 dark:from-orange-900/30 dark:to-orange-800/30 flex items-center justify-center">
                            <i class="fas fa-font text-orange-600 dark:text-orange-400 text-sm"></i>
                        </div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300 text-lg">
                            Nom de la classe
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Modifiez le nom de la classe si nécessaire
                    </p>
                </label>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-school text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <input
                        type="text"
                        name="nom"
                        value="{{ old('nom', $classe->nom) }}"
                        placeholder="Ex : Terminale A, 5ème B, CP..."
                        required
                        class="w-full pl-12 pr-4 py-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white
                               focus:outline-none focus:ring-3 focus:ring-orange-500/30 focus:border-orange-500
                               transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-500
                               @error('nom') border-red-500 dark:border-red-500 focus:ring-red-500/30 focus:border-red-500 @enderror"
                    >
                </div>
                @error('nom')
                    <div class="mt-2 flex items-center gap-2 text-red-600 dark:text-red-400">
                        <i class="fas fa-exclamation-circle"></i>
                        <span class="text-sm">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- NIVEAU --}}
            <div class="mb-10">
                <label class="block mb-3">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center">
                            <i class="fas fa-layer-group text-blue-600 dark:text-blue-400 text-sm"></i>
                        </div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300 text-lg">
                            Niveau scolaire
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Mettez à jour le niveau de la classe
                    </p>
                </label>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-graduation-cap text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <select
                        name="niveau"
                        required
                        class="w-full pl-12 pr-4 py-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white
                               focus:outline-none focus:ring-3 focus:ring-orange-500/30 focus:border-orange-500
                               transition-all duration-300 appearance-none cursor-pointer
                               @error('niveau') border-red-500 dark:border-red-500 focus:ring-red-500/30 focus:border-red-500 @enderror"
                    >
                        <option value="" disabled>Choisissez un niveau</option>
                        <option value="Primaire" {{ old('niveau', $classe->niveau) == 'Primaire' ? 'selected' : '' }}>Primaire</option>
                        <option value="Collège" {{ old('niveau', $classe->niveau) == 'Collège' ? 'selected' : '' }}>Collège</option>
                        <option value="Lycée" {{ old('niveau', $classe->niveau) == 'Lycée' ? 'selected' : '' }}>Lycée</option>
                        <option value="Supérieur" {{ old('niveau', $classe->niveau) == 'Supérieur' ? 'selected' : '' }}>Supérieur</option>
                        <option value="Débutant" {{ old('niveau', $classe->niveau) == 'Débutant' ? 'selected' : '' }}>Débutant</option>
                        <option value="Intermédiaire" {{ old('niveau', $classe->niveau) == 'Intermédiaire' ? 'selected' : '' }}>Intermédiaire</option>
                        <option value="Avancé" {{ old('niveau', $classe->niveau) == 'Avancé' ? 'selected' : '' }}>Avancé</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400 dark:text-gray-500"></i>
                    </div>
                </div>
                @error('niveau')
                    <div class="mt-2 flex items-center gap-2 text-red-600 dark:text-red-400">
                        <i class="fas fa-exclamation-circle"></i>
                        <span class="text-sm">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- DESCRIPTION (OPTIONNELLE) --}}
            <div class="mb-10">
                <label class="block mb-3">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900/30 dark:to-green-800/30 flex items-center justify-center">
                            <i class="fas fa-align-left text-green-600 dark:text-green-400 text-sm"></i>
                        </div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300 text-lg">
                            Description (optionnelle)
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Ajoutez ou modifiez la description de la classe
                    </p>
                </label>

                <div class="relative">
                    <div class="absolute top-4 left-4 pointer-events-none">
                        <i class="fas fa-info-circle text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <textarea
                        name="description"
                        rows="3"
                        placeholder="Description de la classe, informations complémentaires..."
                        class="w-full pl-12 pr-4 py-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white
                               focus:outline-none focus:ring-3 focus:ring-orange-500/30 focus:border-orange-500
                               transition-all duration-300 resize-none placeholder-gray-400 dark:placeholder-gray-500"
                    >{{ old('description', $classe->description ?? '') }}</textarea>
                </div>
            </div>

            {{-- INFORMATIONS DE CRÉATION --}}
            @if($classe->created_at || $classe->updated_at)
            <div class="p-4 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800/50 dark:to-gray-900/50 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($classe->created_at)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center">
                            <i class="fas fa-calendar-plus text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Créée le</p>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ $classe->created_at->format('d/m/Y') }}
                                @if($classe->created_at->format('H:i') !== '00:00')
                                    à {{ $classe->created_at->format('H:i') }}
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    @if($classe->updated_at)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900/30 dark:to-green-800/30 flex items-center justify-center">
                            <i class="fas fa-calendar-check text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Dernière modification</p>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ $classe->updated_at->format('d/m/Y') }}
                                @if($classe->updated_at->format('H:i') !== '00:00')
                                    à {{ $classe->updated_at->format('H:i') }}
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- BOUTONS D'ACTION --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-8 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-100 to-orange-200 dark:from-orange-900/30 dark:to-orange-800/30 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <p class="text-sm">
                        Les modifications seront appliquées immédiatement
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('classes.index') }}"
                       class="px-6 py-3 rounded-xl border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 
                              hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-300 font-semibold
                              flex items-center gap-3">
                        <i class="fas fa-times"></i>
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="px-8 py-3 rounded-xl bg-gradient-to-r from-blue-500 to-cyan-600 hover:from-blue-600 hover:to-cyan-700 
                               text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300
                               transform hover:-translate-y-0.5 flex items-center gap-3">
                        <i class="fas fa-save"></i>
                        Mettre à jour
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- AVERTISSEMENT --}}
    <div class="mt-8 p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 rounded-2xl border border-yellow-200 dark:border-yellow-800">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-100 to-yellow-200 dark:from-yellow-900/30 dark:to-yellow-800/30 flex items-center justify-center">
                <i class="fas fa-exclamation-circle text-yellow-600 dark:text-yellow-400"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-900 dark:text-white text-lg">Avertissement</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Les modifications peuvent affecter les données associées</p>
            </div>
        </div>
        
        <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
            <li class="flex items-center gap-2">
                <i class="fas fa-check-circle text-green-500 text-xs"></i>
                <span>Vérifiez que les informations sont correctes avant de sauvegarder</span>
            </li>
            <li class="flex items-center gap-2">
                <i class="fas fa-check-circle text-green-500 text-xs"></i>
                <span>Les changements sont instantanés et irréversibles</span>
            </li>
        </ul>
    </div>
</div>

{{-- STYLES POUR LE SELECT --}}
<style>
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .dark select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    }
</style>

@endsection