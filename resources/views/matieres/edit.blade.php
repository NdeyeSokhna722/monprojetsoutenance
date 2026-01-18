@extends('layouts.app')

@section('content')

{{-- EN-TÊTE AVEC CHEMIN DE NAVIGATION --}}
<div class="mb-10">
    <div class="flex items-center gap-3 mb-4 text-sm text-gray-500 dark:text-gray-400">
        <a href="{{ route('matieres.index') }}" class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors">
            <i class="fas fa-home"></i> Accueil
        </a>
        <i class="fas fa-chevron-right"></i>
        <a href="{{ route('matieres.index') }}" class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors">
            Matières
        </a>
        <i class="fas fa-chevron-right"></i>
        <span class="text-blue-500 dark:text-blue-400 font-medium">Modifier</span>
    </div>

    <div class="flex items-center gap-4">
        <a href="{{ route('matieres.index') }}" 
           class="p-3 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 text-gray-600 dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 transition-all duration-300 transform hover:-translate-x-1 hover:shadow-md">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/20 to-blue-600/20 dark:from-blue-500/30 dark:to-blue-600/30 flex items-center justify-center">
                    <i class="fas fa-edit text-blue-600 dark:text-blue-500"></i>
                </div>
                Modifier la matière
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">
                Mettez à jour les informations de la matière 
                @if(isset($matiere) && $matiere->nom)
                    <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $matiere->nom }}</span>
                @endif
            </p>
        </div>
    </div>
</div>

{{-- CARTE FORMULAIRE --}}
<div class="max-w-2xl mx-auto">
    <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
        
        {{-- BANDEAU D'ÉDITION --}}
        <div class="bg-gradient-to-r from-yellow-500 to-orange-600 p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                        <i class="fas fa-pencil-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Édition de la matière</h2>
                        <p class="text-yellow-100 text-sm">
                            @if(isset($matiere) && $matiere->id)
                                ID: {{ $matiere->id }} 
                                @if($matiere->created_at)
                                    • Créée le {{ $matiere->created_at->format('d/m/Y') }}
                                @endif
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
        @if(isset($matiere) && $matiere->id)
        <form action="{{ route('matieres.update', $matiere->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            {{-- NOM DE LA MATIÈRE --}}
            <div class="mb-8">
                <label class="block mb-3">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center">
                            <i class="fas fa-font text-blue-600 dark:text-blue-400 text-sm"></i>
                        </div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300 text-lg">
                            Nom de la matière
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Modifiez le nom de la matière si nécessaire
                    </p>
                </label>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-book text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <input
                        type="text"
                        name="nom"
                        value="{{ old('nom', $matiere->nom) }}"
                        placeholder="Ex : Mathématiques, Français, Physique-Chimie..."
                        required
                        class="w-full pl-12 pr-4 py-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white
                               focus:outline-none focus:ring-3 focus:ring-blue-500/30 focus:border-blue-500
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

            {{-- CODE --}}
            <div class="mb-8">
                <label class="block mb-3">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-900/30 dark:to-purple-800/30 flex items-center justify-center">
                            <i class="fas fa-hashtag text-purple-600 dark:text-purple-400 text-sm"></i>
                        </div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300 text-lg">
                            Code de la matière
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Modifiez le code court de la matière
                    </p>
                </label>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-code text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <input
                        type="text"
                        name="code"
                        value="{{ old('code', $matiere->code) }}"
                        placeholder="Ex : MATH, FR, PC..."
                        class="w-full pl-12 pr-4 py-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white
                               focus:outline-none focus:ring-3 focus:ring-blue-500/30 focus:border-blue-500
                               transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-500 uppercase
                               @error('code') border-red-500 dark:border-red-500 focus:ring-red-500/30 focus:border-red-500 @enderror"
                    >
                </div>
                @error('code')
                    <div class="mt-2 flex items-center gap-2 text-red-600 dark:text-red-400">
                        <i class="fas fa-exclamation-circle"></i>
                        <span class="text-sm">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
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
                        Ajoutez ou modifiez la description de la matière
                    </p>
                </label>

                <div class="relative">
                    <div class="absolute top-4 left-4 pointer-events-none">
                        <i class="fas fa-info-circle text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <textarea
                        name="description"
                        rows="3"
                        placeholder="Description de la matière, objectifs, programme..."
                        class="w-full pl-12 pr-4 py-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white
                               focus:outline-none focus:ring-3 focus:ring-blue-500/30 focus:border-blue-500
                               transition-all duration-300 resize-none placeholder-gray-400 dark:placeholder-gray-500"
                    >{{ old('description', $matiere->description ?? '') }}</textarea>
                </div>
            </div>

            {{-- INFORMATIONS DE CRÉATION --}}
            @if($matiere->created_at || $matiere->updated_at)
            <div class="p-4 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800/50 dark:to-gray-900/50 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($matiere->created_at)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center">
                            <i class="fas fa-calendar-plus text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Créée le</p>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ $matiere->created_at->format('d/m/Y') }}
                                @if($matiere->created_at->format('H:i') !== '00:00')
                                    à {{ $matiere->created_at->format('H:i') }}
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    @if($matiere->updated_at)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900/30 dark:to-green-800/30 flex items-center justify-center">
                            <i class="fas fa-calendar-check text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Dernière modification</p>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ $matiere->updated_at->format('d/m/Y') }}
                                @if($matiere->updated_at->format('H:i') !== '00:00')
                                    à {{ $matiere->updated_at->format('H:i') }}
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
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-100 to-yellow-200 dark:from-yellow-900/30 dark:to-yellow-800/30 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <p class="text-sm">
                        Les modifications seront appliquées immédiatement
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('matieres.index') }}"
                       class="px-6 py-3 rounded-xl border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 
                              hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-300 font-semibold
                              flex items-center gap-3">
                        <i class="fas fa-times"></i>
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="px-8 py-3 rounded-xl bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 
                               text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300
                               transform hover:-translate-y-0.5 flex items-center gap-3">
                        <i class="fas fa-save"></i>
                        Mettre à jour
                    </button>
                </div>
            </div>
        </form>
        @else
        <div class="p-8 text-center">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-red-100 to-red-200 dark:from-red-900/30 dark:to-red-800/30 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Matière non trouvée</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">La matière que vous essayez de modifier n'existe pas ou a été supprimée.</p>
            <a href="{{ route('matieres.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold transition-all duration-300">
                <i class="fas fa-arrow-left"></i>
                Retour à la liste
            </a>
        </div>
        @endif
    </div>
</div>

@endsection