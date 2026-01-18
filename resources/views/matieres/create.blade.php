@extends('layouts.app')

@section('content')

{{-- TITRE AVEC INDICATEUR --}}
<div class="mb-10">
    <div class="flex items-center gap-4 mb-3">
        <a href="{{ route('matieres.index') }}" 
           class="p-2 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 text-gray-600 dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 transition-all duration-300 transform hover:-translate-x-1">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-plus-circle text-blue-500 mr-3"></i>
            Ajouter une nouvelle matière
        </h1>
    </div>
    <p class="text-gray-600 dark:text-gray-400 ml-12">
        Remplissez les informations ci-dessous pour créer une nouvelle matière
    </p>
</div>

{{-- CARTE FORMULAIRE AMÉLIORÉE --}}
<div class="max-w-2xl mx-auto">
    <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
        
        {{-- EN-TÊTE DE LA CARTE --}}
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fas fa-book text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Informations de la matière</h2>
                    <p class="text-blue-100 text-sm">Tous les champs sont obligatoires</p>
                </div>
            </div>
        </div>

        {{-- CORPS DU FORMULAIRE --}}
        <form action="{{ route('matieres.store') }}" method="POST" class="p-8">
            @csrf

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
                        Saisissez le nom complet de la matière (ex: "Mathématiques", "Français")
                    </p>
                </label>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-book text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <input
                        type="text"
                        name="nom"
                        placeholder="Ex : Mathématiques, Français, Physique-Chimie..."
                        value="{{ old('nom') }}"
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
                        Saisissez un code court pour identifier la matière (ex: "MATH", "FR")
                    </p>
                </label>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-code text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <input
                        type="text"
                        name="code"
                        placeholder="Ex : MATH, FR, PC..."
                        value="{{ old('code') }}"
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
                        Ajoutez une description pour cette matière
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
                    >{{ old('description') }}</textarea>
                </div>
            </div>

            {{-- BOUTONS D'ACTION --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-8 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                        <i class="fas fa-lightbulb text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <p class="text-sm">
                        La matière sera immédiatement disponible après création
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
                        class="px-8 py-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 
                               text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300
                               transform hover:-translate-y-0.5 flex items-center gap-3">
                        <i class="fas fa-save"></i>
                        Créer la matière
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- EXEMPLES DE MATIÈRES --}}
    <div class="mt-8 p-6 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-2xl border border-blue-200 dark:border-blue-800">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center">
                <i class="fas fa-lightbulb text-blue-600 dark:text-blue-400"></i>
            </div>
            <h3 class="font-bold text-gray-900 dark:text-white text-lg">Exemples de matières</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-gray-900 dark:text-white">Mathématiques</span>
                    <span class="px-3 py-1 rounded-full bg-gradient-to-r from-blue-500 to-cyan-600 text-white text-xs font-semibold">
                        MATH
                    </span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Algèbre, géométrie, analyse</p>
            </div>
            
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-gray-900 dark:text-white">Français</span>
                    <span class="px-3 py-1 rounded-full bg-gradient-to-r from-purple-500 to-violet-600 text-white text-xs font-semibold">
                        FR
                    </span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Grammaire, littérature, expression</p>
            </div>
        </div>
    </div>
</div>

@endsection