@extends('layouts.app')

@section('content')

{{-- TITRE --}}
<div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-bold text-blue-800">
        Modifier l'étudiant : {{ $etudiant->prenom }} {{ $etudiant->nom }}
    </h1>
    <a href="{{ route('etudiants.index') }}"
       class="text-gray-600 hover:text-blue-600 transition flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
    </a>
</div>

{{-- CARTE --}}
<div class="bg-white rounded-xl shadow-lg p-8 max-w-3xl mx-auto border border-gray-200">

    <form action="{{ route('etudiants.update', $etudiant) }}" method="POST"
          class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        @method('PUT')

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

        {{-- Messages de succès --}}
        @if(session('success'))
            <div class="md:col-span-2 mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        {{-- NOM --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Nom *</label>
            <input type="text" name="nom" value="{{ old('nom', $etudiant->nom) }}" required
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
            <input type="text" name="prenom" value="{{ old('prenom', $etudiant->prenom) }}" required
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
            <input type="email" name="email" value="{{ old('email', $etudiant->email) }}" required
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
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <span class="text-gray-500">+221</span>
                </div>
                <input type="tel" name="telephone" 
                       value="{{ old('telephone', $etudiant->telephone ? preg_replace('/^\+221\s*/', '', $etudiant->telephone) : '') }}"
                       class="w-full pl-16 px-4 py-3 rounded-lg border border-gray-300 
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                              @error('telephone') border-red-500 @enderror"
                       placeholder="77 123 45 67"
                       maxlength="15">
            </div>
            <p class="mt-1 text-sm text-gray-500">
                Entrez le numéro sans l'indicatif pays
            </p>
            @error('telephone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- DATE NAISSANCE --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Date de naissance</label>
            <input type="date" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance ? $etudiant->date_naissance->format('Y-m-d') : '') }}"
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
                      placeholder="Adresse complète...">{{ old('adresse', $etudiant->adresse) }}</textarea>
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
                    <option value="{{ $classe->id }}" {{ old('classe_id', $etudiant->classe_id) == $classe->id ? 'selected' : '' }}>
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
                <option value="actif" {{ old('statut', $etudiant->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ old('statut', $etudiant->statut) == 'inactif' ? 'selected' : '' }}>Inactif</option>
                <option value="diplome" {{ old('statut', $etudiant->statut) == 'diplome' ? 'selected' : '' }}>Diplômé</option>
                <option value="abandon" {{ old('statut', $etudiant->statut) == 'abandon' ? 'selected' : '' }}>Abandon</option>
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
                        <input type="text" name="lieu_naissance" value="{{ old('lieu_naissance', $etudiant->lieu_naissance) }}"
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
                            <option value="M" {{ old('genre', $etudiant->genre) == 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ old('genre', $etudiant->genre) == 'F' ? 'selected' : '' }}>Féminin</option>
                            <option value="autre" {{ old('genre', $etudiant->genre) == 'autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('genre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Informations de l'étudiant --}}
        <div class="md:col-span-2">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Informations de l'étudiant</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">ID</p>
                        <p class="font-medium">{{ $etudiant->id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Date d'inscription</p>
                        <p class="font-medium">{{ $etudiant->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Dernière mise à jour</p>
                        <p class="font-medium">{{ $etudiant->updated_at->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Âge</p>
                        <p class="font-medium">
                            @if($etudiant->date_naissance)
                                {{ now()->diffInYears($etudiant->date_naissance) }} ans
                            @else
                                —
                            @endif
                        </p>
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
                    <i class="fas fa-save"></i>
                    Mettre à jour
                </button>

                <a href="{{ route('etudiants.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-800 
                          px-6 py-3 rounded-lg shadow hover:shadow-lg transition 
                          flex items-center justify-center gap-2 font-semibold">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>

                {{-- Bouton pour réinitialiser le formulaire --}}
                <button type="button" onclick="resetForm()"
                        class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 
                               px-6 py-3 rounded-lg shadow hover:shadow-lg transition 
                               flex items-center justify-center gap-2 font-semibold">
                    <i class="fas fa-undo"></i>
                    Réinitialiser
                </button>
            </div>
            
            <p class="text-sm text-gray-500 mt-4">
                <i class="fas fa-info-circle mr-1"></i>
                Les champs marqués d'un * sont obligatoires.
            </p>
        </div>

    </form>
</div>

{{-- JAVASCRIPT --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Limiter la date de naissance à aujourd'hui
        const dateInput = document.querySelector('input[name="date_naissance"]');
        const today = new Date().toISOString().split('T')[0];
        
        if (dateInput) {
            dateInput.max = today;
        }
        
        // Formater le téléphone sans duplication du +221
        const phoneInput = document.querySelector('input[name="telephone"]');
        if (phoneInput) {
            // Formatage lors de la perte de focus
            phoneInput.addEventListener('blur', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Enlever tout sauf les chiffres
                
                if (value.length === 0) return;
                
                // Formater uniquement si c'est un numéro sénégalais (9 chiffres)
                if (value.length === 9) {
                    // Format: XX XXX XX XX
                    const formatted = value.replace(/(\d{2})(\d{3})(\d{2})(\d{2})/, '$1 $2 $3 $4');
                    e.target.value = formatted;
                }
            });
            
            // Supprimer les espaces lors de la saisie pour faciliter l'édition
            phoneInput.addEventListener('focus', function(e) {
                e.target.value = e.target.value.replace(/\s/g, '');
            });
            
            // Validation en temps réel : uniquement des chiffres et espaces
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value;
                // Autoriser uniquement les chiffres et espaces
                value = value.replace(/[^\d\s]/g, '');
                e.target.value = value;
            });
        }
    });

    // Fonction pour réinitialiser le formulaire aux valeurs originales
    function resetForm() {
        if (confirm('Voulez-vous réinitialiser le formulaire aux valeurs originales ?')) {
            const originalValues = @json($etudiant);
            const form = document.querySelector('form');
            
            // Réinitialiser les champs de texte
            form.querySelector('[name="nom"]').value = originalValues.nom;
            form.querySelector('[name="prenom"]').value = originalValues.prenom;
            form.querySelector('[name="email"]').value = originalValues.email;
            
            // Pour le téléphone, retirer le +221 s'il est présent
            let telValue = originalValues.telephone || '';
            telValue = telValue.replace(/^\+221\s*/, '');
            form.querySelector('[name="telephone"]').value = telValue;
            
            form.querySelector('[name="adresse"]').value = originalValues.adresse;
            form.querySelector('[name="lieu_naissance"]').value = originalValues.lieu_naissance;
            
            // Réinitialiser la date de naissance
            if (originalValues.date_naissance) {
                const date = new Date(originalValues.date_naissance);
                form.querySelector('[name="date_naissance"]').value = date.toISOString().split('T')[0];
            } else {
                form.querySelector('[name="date_naissance"]').value = '';
            }
            
            // Réinitialiser les selects
            form.querySelector('[name="classe_id"]').value = originalValues.classe_id;
            form.querySelector('[name="statut"]').value = originalValues.statut;
            form.querySelector('[name="genre"]').value = originalValues.genre;
            
            // Scroll vers le haut
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Afficher un message
            alert('Formulaire réinitialisé aux valeurs originales.');
        }
    }
</script>
@endpush

@endsection