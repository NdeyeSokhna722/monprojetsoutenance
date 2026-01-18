@extends('layouts.app')

@section('content')

{{-- TITRE --}}
<div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-bold text-blue-800">
        Ajouter un élève
    </h1>
    <a href="{{ route('etudiants.index') }}"
       class="text-gray-600 hover:text-blue-600 transition flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
    </a>
</div>

{{-- CARTE --}}
<div class="bg-white rounded-xl shadow-lg p-8 max-w-3xl mx-auto border border-gray-200">

    <form action="{{ route('etudiants.store') }}" method="POST"
          class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf

        {{-- Messages d'erreur généraux --}}
        @if($errors->any())
            <div class="md:col-span-2 mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            Veuillez corriger les erreurs ci-dessous.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        {{-- NOM --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Nom *</label>
            <input type="text" name="nom" value="{{ old('nom') }}" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                          @error('nom') border-red-500 @enderror">
            @error('nom')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- PRENOM --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Prénom *</label>
            <input type="text" name="prenom" value="{{ old('prenom') }}" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                          @error('prenom') border-red-500 @enderror">
            @error('prenom')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div class="md:col-span-2">
            <label class="block text-gray-700 font-medium mb-2">Email *</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                          @error('email') border-red-500 @enderror"
                   placeholder="exemple@email.com">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

               {{-- TELEPHONE --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Téléphone</label>
            <input type="tel" name="telephone" value="{{ old('telephone') }}"
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                          @error('telephone') border-red-500 @enderror"
                   placeholder="+221 33 821 45 67"
                   pattern="^\+221 [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}$"
                   title="Format: +221 33 821 45 67 (9 chiffres après le +221)">
            @error('telephone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- DATE NAISSANCE --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Date de naissance</label>
            <input type="date" name="date_naissance" value="{{ old('date_naissance') }}"
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                          @error('date_naissance') border-red-500 @enderror">
            @error('date_naissance')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- ADRESSE --}}
        <div class="md:col-span-2">
            <label class="block text-gray-700 font-medium mb-2">Adresse</label>
            <textarea name="adresse" rows="2"
                      class="w-full px-4 py-3 rounded-lg border border-gray-300 
                             focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                             @error('adresse') border-red-500 @enderror"
                      placeholder="Adresse complète...">{{ old('adresse') }}</textarea>
            @error('adresse')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- CLASSE --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Classe</label>
            <select name="classe_id"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                           @error('classe_id') border-red-500 @enderror">
                <option value="">— Sélectionnez une classe —</option>
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                        {{ $classe->nom }} ({{ $classe->niveau ?? 'Niveau' }})
                    </option>
                @endforeach
            </select>
            @error('classe_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- STATUT --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Statut *</label>
            <select name="statut" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                           @error('statut') border-red-500 @enderror">
                <option value="">— Sélectionnez un statut —</option>
                <option value="actif" {{ old('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ old('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                <option value="diplome" {{ old('statut') == 'diplome' ? 'selected' : '' }}>Diplômé</option>
                <option value="abandon" {{ old('statut') == 'abandon' ? 'selected' : '' }}>Abandon</option>
            </select>
            @error('statut')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Informations complémentaires --}}
        <div class="md:col-span-2">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Informations complémentaires</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- LIEU DE NAISSANCE --}}
                    <div>
                        <label class="block text-gray-700 mb-2">Lieu de naissance</label>
                        <input type="text" name="lieu_naissance" value="{{ old('lieu_naissance') }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Ville, Pays">
                        @error('lieu_naissance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- GENRE --}}
                    <div>
                        <label class="block text-gray-700 mb-2">Genre</label>
                        <select name="genre" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">— Non spécifié —</option>
                            <option value="M" {{ old('genre') == 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ old('genre') == 'F' ? 'selected' : '' }}>Féminin</option>
                            <option value="autre" {{ old('genre') == 'autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('genre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="md:col-span-2 pt-6 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 
                               text-white px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition 
                               flex items-center justify-center gap-2 font-semibold">
                    <i class="fas fa-user-plus"></i>
                    Enregistrer l'étudiant
                </button>

                <a href="{{ route('etudiants.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-800 
                          px-6 py-3 rounded-lg shadow hover:shadow-lg transition 
                          flex items-center justify-center gap-2 font-semibold">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>
            </div>
            
            <p class="text-sm text-gray-500 mt-4">
                <i class="fas fa-info-circle mr-1"></i>
                Les champs marqués d'un * sont obligatoires.
            </p>
        </div>

    </form>
</div>

{{-- JAVASCRIPT pour la date de naissance --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Limiter la date de naissance à aujourd'hui
        const dateInput = document.querySelector('input[name="date_naissance"]');
        const today = new Date().toISOString().split('T')[0];
        
        if (dateInput) {
            dateInput.max = today;
            
            // Calculer l'âge minimum (5 ans) et maximum (30 ans)
            const maxDate = new Date();
            maxDate.setFullYear(maxDate.getFullYear() - 5);
            
            const minDate = new Date();
            minDate.setFullYear(minDate.getFullYear() - 30);
            
            // dateInput.min = minDate.toISOString().split('T')[0];
            // dateInput.max = maxDate.toISOString().split('T')[0];
        }
        
               // Formater le téléphone
        const phoneInput = document.querySelector('input[name="telephone"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                // Récupérer la valeur sans les espaces et le +221
                let value = e.target.value.replace(/\D/g, '');
                
                // Si on a un nombre de chiffres, on formatte avec +221 et des espaces tous les 2 chiffres
                if (value.length > 0) {
                    // On s'assure de ne pas dépasser 9 chiffres (pour le Sénégal)
                    value = value.substring(0, 9);
                    
                    // On construit le format +221 xx xx xx xx
                    let parts = [];
                    for (let i = 0; i < value.length; i += 2) {
                        parts.push(value.substring(i, i+2));
                    }
                    
                    let formatted = '+221 ' + parts.join(' ');
                    e.target.value = formatted;
                } else {
                    e.target.value = '';
                }
            });
        }
</script>
@endpush

@endsection