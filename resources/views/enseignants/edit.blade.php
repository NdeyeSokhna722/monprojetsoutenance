@extends('layouts.app')

@section('content')

{{-- TITRE --}}
<div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-bold text-gray-900">
        Modifier l'enseignant : {{ $enseignant->prenom }} {{ $enseignant->nom }}
    </h1>
    <a href="{{ route('enseignants.index') }}"
       class="text-gray-600 hover:text-blue-600 transition flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
    </a>
</div>

{{-- CARTE --}}
<div class="bg-white rounded-xl shadow-lg p-8 max-w-3xl mx-auto border border-gray-200">

    <form action="{{ route('enseignants.update', $enseignant) }}" method="POST" enctype="multipart/form-data"
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

        {{-- Photo de profil --}}
        <div class="md:col-span-2">
            <label class="block text-gray-700 font-medium mb-2">Photo de profil</label>
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <div class="w-32 h-32 bg-gray-100 rounded-full border-2 border-gray-300 flex items-center justify-center overflow-hidden">
                        @if($enseignant->photo)
                            <img id="currentPhoto" 
                                 src="{{ asset('storage/enseignants/'.$enseignant->photo) }}" 
                                 alt="{{ $enseignant->prenom }} {{ $enseignant->nom }}"
                                 class="w-full h-full object-cover">
                        @else
                            <img id="currentPhoto" 
                                 src="" 
                                 alt=""
                                 class="hidden w-full h-full object-cover">
                            <div id="currentPlaceholder" class="text-center">
                                <i class="fas fa-user text-3xl text-gray-400 mb-2"></i>
                                <p class="text-xs text-gray-500">Aucune photo</p>
                            </div>
                        @endif
                        
                        <img id="previewImage" class="hidden w-full h-full object-cover absolute inset-0" src="" alt="Preview">
                        <div id="newPlaceholder" class="hidden text-center absolute inset-0 flex items-center justify-center bg-white">
                            <i class="fas fa-user text-3xl text-gray-400 mb-2"></i>
                            <p class="text-xs text-gray-500">Nouvelle photo</p>
                        </div>
                    </div>
                    @if($enseignant->photo)
                    <button type="button" 
                            onclick="removePhoto()"
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition"
                            title="Supprimer la photo">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                    @endif
                </div>
                <div class="flex-1">
                    <input type="file" 
                           name="photo" 
                           id="photoInput"
                           accept="image/*"
                           class="hidden"
                           onchange="previewFile()">
                    <input type="hidden" name="remove_photo" id="removePhotoInput" value="0">
                    <button type="button" 
                            onclick="document.getElementById('photoInput').click()"
                            class="px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 rounded-lg transition border border-gray-300 flex items-center gap-2 shadow-sm mb-2">
                        <i class="fas fa-upload"></i>
                        Choisir une nouvelle image
                    </button>
                    <p class="text-sm text-gray-500">
                        Formats acceptés : JPG, PNG, GIF (max 2MB)
                    </p>
                    @error('photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- NOM --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Nom *</label>
            <input type="text" name="nom" value="{{ old('nom', $enseignant->nom) }}" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                          transition placeholder-gray-400
                          @error('nom') border-red-500 @enderror"
                   placeholder="Dupont">
            @error('nom')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- PRENOM --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Prénom *</label>
            <input type="text" name="prenom" value="{{ old('prenom', $enseignant->prenom) }}" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                          transition placeholder-gray-400
                          @error('prenom') border-red-500 @enderror"
                   placeholder="Jean">
            @error('prenom')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div class="md:col-span-2">
            <label class="block text-gray-700 font-medium mb-2">Email *</label>
            <input type="email" name="email" value="{{ old('email', $enseignant->email) }}" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                          transition placeholder-gray-400
                          @error('email') border-red-500 @enderror"
                   placeholder="jean.dupont@example.com">
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
                @php
                    $telephone = old('telephone', $enseignant->telephone);
                    $telephone = preg_replace('/^\+221\s*/', '', $telephone);
                @endphp
                <input type="tel" name="telephone" value="{{ $telephone }}"
                       class="w-full pl-16 px-4 py-3 rounded-lg border border-gray-300 
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                              transition placeholder-gray-400
                              @error('telephone') border-red-500 @enderror"
                       placeholder="77 123 45 67"
                       maxlength="15">
            </div>
            <p class="mt-1 text-sm text-gray-500">Entrez le numéro sans l'indicatif pays</p>
            @error('telephone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- SPECIALITE --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Spécialité</label>
            <input type="text" name="specialite" value="{{ old('specialite', $enseignant->specialite) }}"
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                          transition placeholder-gray-400
                          @error('specialite') border-red-500 @enderror"
                   placeholder="Mathématiques avancées">
            @error('specialite')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- MATIERE --}}
        <div class="md:col-span-2">
            <label class="block text-gray-700 font-medium mb-2">Matière enseignée *</label>
            <select name="matiere_id" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                           transition appearance-none
                           @error('matiere_id') border-red-500 @enderror">
                <option value="">— Choisir une matière —</option>
                @foreach ($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ old('matiere_id', $enseignant->matiere_id) == $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->nom }}
                        @if($matiere->description)
                            <span class="text-gray-500 text-sm">({{ $matiere->description }})</span>
                        @endif
                    </option>
                @endforeach
            </select>
            @error('matiere_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Informations supplémentaires --}}
        <div class="md:col-span-2">
            <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations supplémentaires
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- DATE DE NAISSANCE --}}
                    <div>
                        <label class="block text-gray-700 mb-2">Date de naissance</label>
                        <input type="date" name="date_naissance" 
                               value="{{ old('date_naissance', $enseignant->date_naissance ? $enseignant->date_naissance->format('Y-m-d') : '') }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                      transition"
                               max="{{ date('Y-m-d', strtotime('-18 years')) }}">
                        <p class="mt-1 text-sm text-gray-500">Âge minimum : 18 ans</p>
                    </div>

                    {{-- GENRE --}}
                    <div>
                        <label class="block text-gray-700 mb-2">Genre</label>
                        <select name="genre" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                       transition">
                            <option value="">— Non spécifié —</option>
                            <option value="M" {{ old('genre', $enseignant->genre) == 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ old('genre', $enseignant->genre) == 'F' ? 'selected' : '' }}>Féminin</option>
                            <option value="autre" {{ old('genre', $enseignant->genre) == 'autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>

                    {{-- ADRESSE --}}
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 mb-2">Adresse</label>
                        <textarea name="adresse" rows="2"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 
                                         focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                         transition placeholder-gray-400"
                                  placeholder="Adresse complète...">{{ old('adresse', $enseignant->adresse) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Informations de l'enseignant --}}
        <div class="md:col-span-2">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Informations de l'enseignant</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">ID</p>
                        <p class="font-medium">{{ $enseignant->id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Date d'inscription</p>
                        <p class="font-medium">{{ $enseignant->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Dernière mise à jour</p>
                        <p class="font-medium">{{ $enseignant->updated_at->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Âge</p>
                        <p class="font-medium">
                            @if($enseignant->date_naissance)
                                {{ now()->diffInYears($enseignant->date_naissance) }} ans
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
                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
                               text-white px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition 
                               flex items-center justify-center gap-2 font-semibold">
                    <i class="fas fa-save"></i>
                    Mettre à jour
                </button>

                <a href="{{ route('enseignants.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-800 
                          px-6 py-3 rounded-lg shadow hover:shadow-lg transition 
                          flex items-center justify-center gap-2 font-semibold border border-gray-300">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>

                <button type="button" onclick="resetForm()"
                        class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 
                               px-6 py-3 rounded-lg shadow hover:shadow-lg transition 
                               flex items-center justify-center gap-2 font-semibold border border-yellow-200">
                    <i class="fas fa-undo"></i>
                    Réinitialiser
                </button>
            </div>
            
            <p class="text-sm text-gray-500 mt-4 flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                Les champs marqués d'un * sont obligatoires.
            </p>
        </div>

    </form>
</div>

{{-- JAVASCRIPT --}}
@push('scripts')
<script>
    function previewFile() {
        const preview = document.getElementById('previewImage');
        const currentPhoto = document.getElementById('currentPhoto');
        const currentPlaceholder = document.getElementById('currentPlaceholder');
        const newPlaceholder = document.getElementById('newPlaceholder');
        const file = document.getElementById('photoInput').files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.classList.remove('hidden');
            if (currentPhoto) currentPhoto.classList.add('hidden');
            if (currentPlaceholder) currentPlaceholder.classList.add('hidden');
            newPlaceholder.classList.add('hidden');
        }

        if (file) {
            // Vérifier la taille du fichier (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Le fichier est trop volumineux (max 2MB)');
                document.getElementById('photoInput').value = '';
                preview.classList.add('hidden');
                newPlaceholder.classList.add('hidden');
                if (currentPhoto) currentPhoto.classList.remove('hidden');
                if (currentPlaceholder) currentPlaceholder.classList.remove('hidden');
                return;
            }
            
            // Vérifier le type de fichier
            if (!file.type.match('image.*')) {
                alert('Veuillez sélectionner une image valide');
                document.getElementById('photoInput').value = '';
                preview.classList.add('hidden');
                newPlaceholder.classList.add('hidden');
                if (currentPhoto) currentPhoto.classList.remove('hidden');
                if (currentPlaceholder) currentPlaceholder.classList.remove('hidden');
                return;
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
            newPlaceholder.classList.add('hidden');
            if (currentPhoto) currentPhoto.classList.remove('hidden');
            if (currentPlaceholder) currentPlaceholder.classList.remove('hidden');
        }
    }

    function removePhoto() {
        const currentPhoto = document.getElementById('currentPhoto');
        const currentPlaceholder = document.getElementById('currentPlaceholder');
        const preview = document.getElementById('previewImage');
        const newPlaceholder = document.getElementById('newPlaceholder');
        const removePhotoInput = document.getElementById('removePhotoInput');
        
        if (currentPhoto) currentPhoto.classList.add('hidden');
        if (currentPlaceholder) currentPlaceholder.classList.add('hidden');
        preview.classList.add('hidden');
        newPlaceholder.classList.remove('hidden');
        removePhotoInput.value = '1';
        document.getElementById('photoInput').value = '';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Limiter la date de naissance (minimum 18 ans)
        const dateInput = document.querySelector('input[name="date_naissance"]');
        if (dateInput) {
            const maxDate = new Date();
            maxDate.setFullYear(maxDate.getFullYear() - 18);
            dateInput.max = maxDate.toISOString().split('T')[0];
        }
        
        // Formater le téléphone
        const phoneInput = document.querySelector('input[name="telephone"]');
        if (phoneInput) {
            phoneInput.addEventListener('blur', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                
                if (value.length === 9) {
                    // Format Sénégal: XX XXX XX XX
                    const formatted = value.replace(/(\d{2})(\d{3})(\d{2})(\d{2})/, '$1 $2 $3 $4');
                    e.target.value = formatted;
                }
            });
            
            phoneInput.addEventListener('focus', function(e) {
                e.target.value = e.target.value.replace(/\s/g, '');
            });
            
            phoneInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^\d\s]/g, '');
            });
        }
    });

    // Fonction pour réinitialiser le formulaire
    function resetForm() {
        if (confirm('Voulez-vous réinitialiser le formulaire aux valeurs originales ?')) {
            const originalValues = @json($enseignant);
            const form = document.querySelector('form');
            
            // Réinitialiser les champs
            form.querySelector('[name="nom"]').value = originalValues.nom;
            form.querySelector('[name="prenom"]').value = originalValues.prenom;
            form.querySelector('[name="email"]').value = originalValues.email;
            
            // Téléphone (enlever le +221)
            let telValue = originalValues.telephone || '';
            telValue = telValue.replace(/^\+221\s*/, '');
            form.querySelector('[name="telephone"]').value = telValue;
            
            form.querySelector('[name="specialite"]').value = originalValues.specialite;
            form.querySelector('[name="adresse"]').value = originalValues.adresse;
            
            // Date de naissance
            if (originalValues.date_naissance) {
                const date = new Date(originalValues.date_naissance);
                form.querySelector('[name="date_naissance"]').value = date.toISOString().split('T')[0];
            } else {
                form.querySelector('[name="date_naissance"]').value = '';
            }
            
            // Sélecteurs
            form.querySelector('[name="matiere_id"]').value = originalValues.matiere_id;
            form.querySelector('[name="genre"]').value = originalValues.genre;
            
            // Réinitialiser la photo
            const currentPhoto = document.getElementById('currentPhoto');
            const currentPlaceholder = document.getElementById('currentPlaceholder');
            const preview = document.getElementById('previewImage');
            const newPlaceholder = document.getElementById('newPlaceholder');
            const removePhotoInput = document.getElementById('removePhotoInput');
            
            if (originalValues.photo) {
                if (currentPhoto) currentPhoto.classList.remove('hidden');
                if (currentPlaceholder) currentPlaceholder.classList.add('hidden');
            } else {
                if (currentPhoto) currentPhoto.classList.add('hidden');
                if (currentPlaceholder) currentPlaceholder.classList.remove('hidden');
            }
            preview.classList.add('hidden');
            newPlaceholder.classList.add('hidden');
            removePhotoInput.value = '0';
            document.getElementById('photoInput').value = '';
            
            alert('Formulaire réinitialisé aux valeurs originales.');
        }
    }
</script>
@endpush

@endsection