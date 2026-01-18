@extends('layouts.public')

@section('title', 'Pré-inscription - Collège & Lycée Ndindy School')

@section('content')
<div class="bg-gradient-to-r from-blue-800 to-orange-600 text-white py-12 rounded-b-3xl shadow-xl mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Pré-inscription </h1>
        <p class="text-xl opacity-90 mb-6">Réservez une place pour votre enfant au Collège & Lycée Ndindy School</p>
        <div class="flex justify-center space-x-4">
            <div class="bg-white/20 px-4 py-2 rounded-full">
                <i class="fas fa-clock mr-2"></i>Réponse sous 48h
            </div>
            <div class="bg-white/20 px-4 py-2 rounded-full">
                <i class="fas fa-shield-alt mr-2"></i>Données sécurisées
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
    <div class="grid lg:grid-cols-3 gap-8">
        {{-- COLONNE GAUCHE: FORMULAIRE --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                <div class="flex items-center mb-6 border-b pb-4">
                    <div class="p-3 bg-blue-100 rounded-xl mr-4">
                        <i class="fas fa-file-alt text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Formulaire de Pré-inscription</h2>
                        <p class="text-gray-600">Remplissez tous les champs obligatoires (*) pour initier le processus d'inscription</p>
                    </div>
                </div>
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-500 text-xl mt-1"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800">
                                    Pré-inscription envoyée avec succès !
                                </h3>
                                <div class="mt-2 text-sm text-green-700">
                                    <p>Nous vous contacterons dans les 48 heures pour finaliser le dossier.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500 text-xl mt-1"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Il y a {{ $errors->count() }} erreur(s) à corriger
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                <form action="{{ route('preinscription.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    {{-- SECTION 1: INFORMATIONS DE L'ÉLÈVE --}}
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-user-graduate mr-3 text-blue-600"></i>
                            Informations de l'élève
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- NOM --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user mr-1 text-orange-500"></i>
                                    Nom *
                                </label>
                                <input type="text" name="nom" value="{{ old('nom') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                                              @error('nom') border-red-500 @enderror"
                                       placeholder="Nom de famille">
                                @error('nom')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- PRENOM --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user mr-1 text-orange-500"></i>
                                    Prénom *
                                </label>
                                <input type="text" name="prenom" value="{{ old('prenom') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                                              @error('prenom') border-red-500 @enderror"
                                       placeholder="Prénom">
                                @error('prenom')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- GENRE --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-venus-mars mr-1 text-blue-500"></i>
                                    Genre *
                                </label>
                                <select name="genre" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                                               @error('genre') border-red-500 @enderror">
                                    <option value="">— Sélectionnez —</option>
                                    <option value="M" {{ old('genre') == 'M' ? 'selected' : '' }}>Masculin</option>
                                    <option value="F" {{ old('genre') == 'F' ? 'selected' : '' }}>Féminin</option>
                                </select>
                                @error('genre')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- DATE DE NAISSANCE --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-birthday-cake mr-1 text-orange-500"></i>
                                    Date de naissance *
                                </label>
                                <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                                              @error('date_naissance') border-red-500 @enderror">
                                @error('date_naissance')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- LIEU DE NAISSANCE --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-map-marker-alt mr-1 text-blue-500"></i>
                                    Lieu de naissance
                                </label>
                                <input type="text" name="lieu_naissance" value="{{ old('lieu_naissance') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                                       placeholder="Ville, Pays">
                            </div>
                            
                            {{-- NIVEAU DEMANDÉ --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-graduation-cap mr-1 text-orange-500"></i>
                                    Niveau demandé *
                                </label>
                                <select name="niveau" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                                               @error('niveau') border-red-500 @enderror">
                                    <option value="">— Sélectionnez un niveau —</option>
                                    <optgroup label="Collège">
                                        <option value="6eme" {{ old('niveau') == '6eme' ? 'selected' : '' }}>6ème</option>
                                        <option value="5eme" {{ old('niveau') == '5eme' ? 'selected' : '' }}>5ème</option>
                                        <option value="4eme" {{ old('niveau') == '4eme' ? 'selected' : '' }}>4ème</option>
                                        <option value="3eme" {{ old('niveau') == '3eme' ? 'selected' : '' }}>3ème</option>
                                    </optgroup>
                                    <optgroup label="Lycée">
                                        <option value="2nde" {{ old('niveau') == '2nde' ? 'selected' : '' }}>Seconde</option>
                                        <option value="1ere" {{ old('niveau') == '1ere' ? 'selected' : '' }}>Première</option>
                                        <option value="terminale" {{ old('niveau') == 'terminale' ? 'selected' : '' }}>Terminale</option>
                                    </optgroup>
                                </select>
                                @error('niveau')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    {{-- SECTION 2: INFORMATIONS DES PARENTS --}}
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-users mr-3 text-blue-600"></i>
                            Informations des parents / tuteur
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- NOM DU PARENT --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user mr-1 text-orange-500"></i>
                                    Nom du parent *
                                </label>
                                <input type="text" name="parent_nom" value="{{ old('parent_nom') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                                              @error('parent_nom') border-red-500 @enderror"
                                       placeholder="Nom de famille">
                                @error('parent_nom')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- PRENOM DU PARENT --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user mr-1 text-orange-500"></i>
                                    Prénom du parent *
                                </label>
                                <input type="text" name="parent_prenom" value="{{ old('parent_prenom') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                                              @error('parent_prenom') border-red-500 @enderror"
                                       placeholder="Prénom">
                                @error('parent_prenom')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- EMAIL --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-1 text-blue-500"></i>
                                    Email *
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition
                                              @error('email') border-red-500 @enderror"
                                       placeholder="exemple@email.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- TELEPHONE --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-phone mr-1 text-orange-500"></i>
                                    Téléphone *
                                </label>
                                <input type="tel" 
                                  name="telephone" 
                                  value="{{ old('telephone') }}" 
                                  required
                                  pattern="^\+221 [0-9]{9}$"
                                  title="Format: +221 suivi de 9 chiffres (ex: +221 777268419)"
                                  placeholder="+221 777268419"
                                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            
                            {{-- RELATION AVEC L'ÉLÈVE --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-handshake mr-1 text-blue-500"></i>
                                    Relation avec l'élève
                                </label>
                                <select name="relation"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                                    <option value="">— Sélectionnez —</option>
                                    <option value="pere" {{ old('relation') == 'pere' ? 'selected' : '' }}>Père</option>
                                    <option value="mere" {{ old('relation') == 'mere' ? 'selected' : '' }}>Mère</option>
                                    <option value="tuteur" {{ old('relation') == 'tuteur' ? 'selected' : '' }}>Tuteur légal</option>
                                    <option value="autre" {{ old('relation') == 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                            </div>
                            
                            {{-- PROFESSION --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-briefcase mr-1 text-orange-500"></i>
                                    Profession
                                </label>
                                <input type="text" name="profession" value="{{ old('profession') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                                       placeholder="Profession du parent">
                            </div>
                        </div>
                    </div>
                    
                    {{-- SECTION 3: INFORMATIONS COMPLÉMENTAIRES --}}
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-3 text-blue-600"></i>
                            Informations complémentaires
                        </h3>
                        
                        {{-- ADRESSE --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-home mr-1 text-orange-500"></i>
                                Adresse du domicile
                            </label>
                            <textarea name="adresse" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                                      placeholder="N°, Rue, Quartier, Ville...">{{ old('adresse') }}</textarea>
                        </div>
                        
                        {{-- MESSAGE --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-comment-alt mr-1 text-blue-500"></i>
                                Message complémentaire (optionnel)
                            </label>
                            <textarea name="message" rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                                      placeholder="Informations supplémentaires, questions, besoins particuliers...">{{ old('message') }}</textarea>
                        </div>
                    </div>
                    
                    {{-- SECTION 4: CONSENTEMENT ET SOUMISSION --}}
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-start mb-4">
                            <input type="checkbox" id="conditions" name="conditions" required
                                   class="h-5 w-5 text-orange-600 focus:ring-orange-500 border-gray-300 rounded mt-1">
                            <label for="conditions" class="ml-3 block text-sm text-gray-700">
                                <span class="font-medium">J'accepte les conditions de traitement des données *</span>
                                <p class="text-gray-600 mt-1">
                                    Je consens à ce que mes données personnelles soient traitées dans le cadre de la pré-inscription et que je sois contacté(e) par l'établissement.
                                </p>
                            </label>
                        </div>
                        
                        <div class="flex items-start mb-6">
                            <input type="checkbox" id="newsletter" name="newsletter" value="1"
                                   class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1">
                            <label for="newsletter" class="ml-3 block text-sm text-gray-700">
                                <span class="font-medium">Je souhaite recevoir les actualités de l'établissement</span>
                                <p class="text-gray-600 mt-1">
                                    Recevez des informations sur les événements, les portes ouvertes et les nouveautés pédagogiques.
                                </p>
                            </label>
                        </div>
                        
                        <div class="pt-4 border-t border-blue-200">
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-orange-600 to-orange-800 hover:from-orange-700 hover:to-orange-900 
                                           text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition 
                                           duration-300 flex items-center justify-center gap-2 text-lg">
                                <i class="fas fa-paper-plane text-xl"></i>
                                Envoyer la pré-inscription
                            </button>
                        </div>
                    </div>
                    
                    <div class="text-center text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Les champs marqués d'un * sont obligatoires. Réponse garantie sous 48h.
                    </div>
                </form>
            </div>
        </div>
        
        {{-- COLONNE DROITE: INFORMATIONS --}}
        <div class="space-y-6">
            {{-- CARTE: INFORMATIONS IMPORTANTES --}}
            <div class="bg-blue-50 rounded-2xl p-6 border border-blue-200 shadow-sm">
                <h3 class="text-xl font-bold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations importantes
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <i class="fas fa-check text-green-500"></i>
                        </div>
                        <span class="ml-2 text-gray-700">La pré-inscription ne garantit pas automatiquement une place</span>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <i class="fas fa-check text-green-500"></i>
                        </div>
                        <span class="ml-2 text-gray-700">Un entretien avec la direction est requis pour validation</span>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <i class="fas fa-check text-green-500"></i>
                        </div>
                        <span class="ml-2 text-gray-700">Dossier complet à fournir : bulletins, certificat de scolarité</span>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <i class="fas fa-check text-green-500"></i>
                        </div>
                        <span class="ml-2 text-gray-700">Réponse sous 5 jours ouvrés après réception du dossier</span>
                    </li>
                </ul>
            </div>
            
            {{-- CARTE: CALENDRIER --}}
            <div class="bg-orange-50 rounded-2xl p-6 border border-orange-200 shadow-sm">
                <h3 class="text-xl font-bold text-orange-800 mb-4 flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Calendrier des inscriptions
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <span class="text-gray-700">Février - Avril</span>
                        <span class="font-semibold text-orange-600">Pré-inscriptions</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-700">Mai</span>
                        <span class="font-semibold text-blue-600">Entretiens</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-700">Juin</span>
                        <span class="font-semibold text-green-600">Réponses</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-gray-700">Septembre</span>
                        <span class="font-semibold text-purple-600">Rentrée</span>
                    </li>
                </ul>
            </div>
            
            {{-- CARTE: DOCUMENTS REQUIS --}}
            <div class="bg-gradient-to-r from-blue-50 to-orange-50 rounded-2xl p-6 border border-blue-200 shadow-sm">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-file-alt mr-2 text-orange-600"></i>
                    Documents requis
                </h3>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                        <span class="text-sm">Copie acte de naissance</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-file-image text-green-500 mr-2"></i>
                        <span class="text-sm">Photo d'identité récente</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-file-contract text-blue-500 mr-2"></i>
                        <span class="text-sm">Bulletins des 2 dernières années</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-certificate text-purple-500 mr-2"></i>
                        <span class="text-sm">Certificat de scolarité</span>
                    </li>
                </ul>
            </div>
            
            {{-- CARTE: CONTACT --}}
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200 shadow-sm">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-phone-alt mr-2"></i>
                    Contact inscriptions
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 rounded-lg mr-3">
                            <i class="fas fa-envelope text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-medium">inscriptions@ndindy.sn</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="p-2 bg-orange-100 rounded-lg mr-3">
                            <i class="fas fa-phone text-orange-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Téléphone</p>
                            <p class="font-medium">+221 33 821 45 67</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 rounded-lg mr-3">
                            <i class="fas fa-clock text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Horaires</p>
                            <p class="font-medium">Lundi - Vendredi, 8h - 17h</p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <a href="{{ route('contact') }}" 
                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                        <i class="fas fa-external-link-alt mr-2"></i>
                        Formulaire de contact complet
                    </a>
                </div>
            </div>
            
            {{-- CARTE: TÉMOIGNAGES --}}
            <div class="bg-gradient-to-br from-orange-50 to-yellow-50 rounded-2xl p-6 border border-orange-200 shadow-sm">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-star mr-2 text-yellow-500"></i>
                    Témoignages parents
                </h3>
                <div class="space-y-4">
                    <div class="relative bg-white p-4 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-sm">M. Diop</p>
                                <p class="text-xs text-gray-500">Parent de Terminale</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-700 italic">"Un accompagnement personnalisé et des résultats excellents au bac."</p>
                    </div>
                    <div class="relative bg-white p-4 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-user text-orange-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-sm">Mme. Ndiaye</p>
                                <p class="text-xs text-gray-500">Parent de 4ème</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-700 italic">"L'équipe pédagogique est à l'écoute et très professionnelle."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Masque de téléphone
   const phoneInput = document.querySelector('input[name="telephone"]');
if (phoneInput) {
    phoneInput.addEventListener('input', function(e) {
        // Récupérer la valeur sans les caractères non-numériques
        let digits = this.value.replace(/\D/g, '');
        
        // Si le numéro commence par 221 et a plus de 3 chiffres
        if (digits.startsWith('221') && digits.length > 3) {
            digits = digits.substring(3); // Enlever le 221
        }
        
        // Garder seulement 9 chiffres
        digits = digits.substring(0, 9);
        
        // Formater : +221 suivi des chiffres
        this.value = digits ? '+221 ' + digits : '';
        
        // Empêcher la suppression du "+221 "
        if (this.value.length < 5 && (e.inputType === 'deleteContentBackward' || 
                                      e.inputType === 'deleteContentForward')) {
            this.value = '+221 ';
        }
    });
    
    // Initialiser le champ avec "+221 " s'il est vide au focus
    phoneInput.addEventListener('focus', function() {
        if (!this.value || this.value === '') {
            this.value = '+221 ';
        } else if (!this.value.startsWith('+221 ')) {
            // Si le numéro est déjà entré mais mal formaté
            let digits = this.value.replace(/\D/g, '');
            if (digits.length === 9) {
                this.value = '+221 ' + digits;
            } else if (digits.startsWith('221') && digits.length === 12) {
                this.value = '+221 ' + digits.substring(3);
            } else {
                this.value = '+221 ';
            }
        }
    });
    
    
    // Calcul de l'âge
    const birthDateInput = document.querySelector('input[name="date_naissance"]');
    if (birthDateInput) {
        const today = new Date();
        const maxDate = new Date();
        maxDate.setFullYear(today.getFullYear() - 5);
        
        birthDateInput.max = maxDate.toISOString().split('T')[0];
        
        birthDateInput.addEventListener('change', function() {
            if (this.value) {
                const birthDate = new Date(this.value);
                const age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                
                // Afficher un message si l'âge n'est pas approprié
                if (age < 5) {
                    alert('⚠️ L\'élève doit avoir au moins 5 ans pour s\'inscrire.');
                    this.value = '';
                } else if (age > 25) {
                    alert('⚠️ L\'âge maximum pour l\'inscription est de 25 ans.');
                    this.value = '';
                }
            }
        });
    }
    
    // Animation des cartes au survol
    document.querySelectorAll('.bg-gray-50, .bg-blue-50, .bg-orange-50').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush

<style>
/* Styles personnalisés */
.bg-gradient-to-r {
    background-size: 200% 200%;
    animation: gradient 15s ease infinite;
}

@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Style pour les champs obligatoires */
label:has(+ input[required])::after,
label:has(+ select[required])::after {
    content: " *";
    color: #ef4444;
}

/* Style pour les placeholders */
input::placeholder, textarea::placeholder {
    color: #9ca3af;
    opacity: 0.7;
}

/* Effet de focus amélioré */
input:focus, select:focus, textarea:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
}

/* Animation pour le bouton */
button[type="submit"] {
    position: relative;
    overflow: hidden;
}

button[type="submit"]::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.5);
    opacity: 0;
    border-radius: 100%;
    transform: scale(1, 1) translate(-50%);
    transform-origin: 50% 50%;
}

button[type="submit"]:focus:not(:active)::after {
    animation: ripple 1s ease-out;
}

@keyframes ripple {
    0% {
        transform: scale(0, 0);
        opacity: 0.5;
    }
    100% {
        transform: scale(40, 40);
        opacity: 0;
    }
}
</style>
@endsection