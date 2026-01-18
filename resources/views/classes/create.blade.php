@extends('layouts.app')

@section('content')

{{-- TITRE AVEC INDICATEUR --}}
<div class="mb-10">
    <div class="flex items-center gap-4 mb-3">
        <a href="{{ route('classes.index') }}" 
           class="p-2 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 text-gray-600 dark:text-gray-400 hover:text-orange-500 dark:hover:text-orange-400 transition-all duration-300 transform hover:-translate-x-1">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-plus-circle text-orange-500 mr-3"></i>
            Ajouter une nouvelle classe
        </h1>
    </div>
    <p class="text-gray-600 dark:text-gray-400 ml-12">
        Remplissez les informations ci-dessous pour créer une nouvelle classe
    </p>
</div>

{{-- CARTE FORMULAIRE AMÉLIORÉE --}}
<div class="max-w-2xl mx-auto">
    <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
        
        {{-- EN-TÊTE DE LA CARTE --}}
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Informations de la classe</h2>
                    <p class="text-orange-100 text-sm">Tous les champs sont obligatoires</p>
                </div>
            </div>
        </div>

        {{-- CORPS DU FORMULAIRE --}}
        <form action="{{ route('classes.store') }}" method="POST" class="p-8">
            @csrf

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
                        Saisissez le nom complet de la classe (ex: "Terminale A", "5ème B")
                    </p>
                </label>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-school text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <input
                        type="text"
                        name="nom"
                        placeholder="Ex : Terminale A, 5ème B, CP..."
                        value="{{ old('nom') }}"
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
                        Sélectionnez le niveau correspondant à cette classe
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
                        <option value="" disabled selected>Sélectionnez un niveau</option>
                        <option value="Primaire" {{ old('niveau') == 'Primaire' ? 'selected' : '' }}>Primaire</option>
                        <option value="Collège" {{ old('niveau') == 'Collège' ? 'selected' : '' }}>Collège</option>
                        <option value="Lycée" {{ old('niveau') == 'Lycée' ? 'selected' : '' }}>Lycée</option>
                        <option value="Supérieur" {{ old('niveau') == 'Supérieur' ? 'selected' : '' }}>Supérieur</option>
                        <option value="Débutant" {{ old('niveau') == 'Débutant' ? 'selected' : '' }}>Débutant</option>
                        <option value="Intermédiaire" {{ old('niveau') == 'Intermédiaire' ? 'selected' : '' }}>Intermédiaire</option>
                        <option value="Avancé" {{ old('niveau') == 'Avancé' ? 'selected' : '' }}>Avancé</option>
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
                        Ajoutez une description pour cette classe
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
                        La classe sera immédiatement disponible après création
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
                        class="px-8 py-3 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 
                               text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300
                               transform hover:-translate-y-0.5 flex items-center gap-3">
                        <i class="fas fa-save"></i>
                        Créer la classe
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- EXEMPLES DE CLASSES --}}
    <div class="mt-8 p-6 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-2xl border border-blue-200 dark:border-blue-800">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center">
                <i class="fas fa-lightbulb text-blue-600 dark:text-blue-400"></i>
            </div>
            <h3 class="font-bold text-gray-900 dark:text-white text-lg">Exemples de classes</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-gray-900 dark:text-white">Terminale A</span>
                    <span class="px-3 py-1 rounded-full bg-gradient-to-r from-purple-500 to-violet-600 text-white text-xs font-semibold">
                        Lycée
                    </span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Classe de terminale scientifique</p>
            </div>
            
            <div class="p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-gray-900 dark:text-white">5ème B</span>
                    <span class="px-3 py-1 rounded-full bg-gradient-to-r from-blue-500 to-cyan-600 text-white text-xs font-semibold">
                        Collège
                    </span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Classe de cinquième</p>
            </div>
        </div>
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