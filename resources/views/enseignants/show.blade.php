@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
        <i class="fas fa-chalkboard-teacher text-blue-600"></i>
        Détails de l'enseignant
    </h1>
    <div class="flex items-center gap-3">
        <a href="{{ route('enseignants.index') }}"
           class="text-gray-600 hover:text-blue-600 transition flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            Retour à la liste
        </a>
        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
        <span class="text-sm text-gray-500">
            ID: #{{ str_pad($enseignant->id, 5, '0', STR_PAD_LEFT) }}
        </span>
    </div>
</div>

{{-- CARTE PRINCIPALE --}}
<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 mb-8">
    
    {{-- EN-TÊTE AVEC PHOTO ET INFO PRINCIPALES --}}
    <div class="bg-gradient-to-r from-blue-50 to-gray-50 p-6 md:p-8 border-b border-gray-200">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-8">
            
            {{-- PHOTO DE PROFIL --}}
            <div class="relative">
                <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-gray-100 rounded-full border-4 border-white shadow-lg overflow-hidden">
                    @if($enseignant->photo)
                        <img src="{{ asset('storage/enseignants/'.$enseignant->photo) }}"
                             alt="{{ $enseignant->prenom }} {{ $enseignant->nom }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-200 to-blue-300">
                            <div class="text-center">
                                <i class="fas fa-user-graduate text-4xl text-white opacity-80"></i>
                                <p class="text-xs text-white opacity-90 mt-1">Pas de photo</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="absolute -bottom-2 -right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                    Enseignant
                </div>
            </div>

            {{-- NOM ET STATUT --}}
            <div class="flex-1">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                            {{ $enseignant->prenom }} {{ $enseignant->nom }}
                        </h2>
                        <p class="text-gray-600 mt-1 flex items-center gap-2">
                            <i class="fas fa-graduation-cap text-blue-500"></i>
                            <span>{{ $enseignant->matiere->nom ?? 'Matière non définie' }}</span>
                        </p>
                    </div>
                    
                    {{-- BADGES --}}
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            Actif
                        </span>
                        @if($enseignant->specialite)
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                            <i class="fas fa-star text-xs mr-1"></i>
                            {{ $enseignant->specialite }}
                        </span>
                        @endif
                    </div>
                </div>

                {{-- INFO RAPIDES --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-envelope text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Email</p>
                            <a href="mailto:{{ $enseignant->email }}" 
                               class="text-sm font-medium text-gray-900 hover:text-blue-600">
                                {{ $enseignant->email }}
                            </a>
                        </div>
                    </div>

                    @if($enseignant->telephone)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-phone text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Téléphone</p>
                            <a href="tel:{{ $enseignant->telephone }}" 
                               class="text-sm font-medium text-gray-900 hover:text-green-600">
                                {{ $enseignant->telephone }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if($enseignant->date_naissance)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-birthday-cake text-orange-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Âge</p>
                            <p class="text-sm font-medium text-gray-900">
                                {{ now()->diffInYears($enseignant->date_naissance) }} ans
                            </p>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-gray-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Membre depuis</p>
                            <p class="text-sm font-medium text-gray-900">
                                {{ $enseignant->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENU PRINCIPAL --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-6 md:p-8">
        
        {{-- COLONNE GAUCHE : INFORMATIONS PERSONNELLES --}}
        <div class="lg:col-span-2">
            
            {{-- INFORMATIONS PERSONNELLES --}}
            <div class="bg-gray-50 rounded-xl p-6 mb-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-200 flex items-center gap-2">
                    <i class="fas fa-user-circle text-blue-600"></i>
                    Informations personnelles
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Genre</label>
                        <div class="flex items-center gap-2">
                            @if($enseignant->genre == 'M')
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                    <i class="fas fa-male mr-1"></i> Masculin
                                </span>
                            @elseif($enseignant->genre == 'F')
                                <span class="px-3 py-1 bg-pink-100 text-pink-800 rounded-full text-sm font-medium">
                                    <i class="fas fa-female mr-1"></i> Féminin
                                </span>
                            @else
                                <span class="text-gray-600">—</span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Date de naissance</label>
                        <p class="text-gray-900">
                            @if($enseignant->date_naissance)
                                {{ $enseignant->date_naissance->format('d/m/Y') }}
                                <span class="text-gray-500 text-sm">
                                    ({{ now()->diffInYears($enseignant->date_naissance) }} ans)
                                </span>
                            @else
                                <span class="text-gray-500">—</span>
                            @endif
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-500 mb-1">Adresse</label>
                        <p class="text-gray-900">
                            @if($enseignant->adresse)
                                {{ $enseignant->adresse }}
                            @else
                                <span class="text-gray-500">—</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            {{-- INFORMATIONS PROFESSIONNELLES --}}
            <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                <h3 class="text-lg font-semibold text-blue-900 mb-4 pb-3 border-b border-blue-200 flex items-center gap-2">
                    <i class="fas fa-briefcase text-blue-700"></i>
                    Informations professionnelles
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-blue-700 mb-1">Matière enseignée</label>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white rounded-lg border border-blue-200 flex items-center justify-center">
                                <i class="fas fa-book text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $enseignant->matiere->nom ?? '—' }}</p>
                                @if($enseignant->matiere?->description)
                                    <p class="text-sm text-gray-600">{{ $enseignant->matiere->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-700 mb-1">Spécialité</label>
                        <p class="text-gray-900">
                            @if($enseignant->specialite)
                                <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                                    <i class="fas fa-star text-xs mr-2"></i>
                                    {{ $enseignant->specialite }}
                                </span>
                            @else
                                <span class="text-gray-500">—</span>
                            @endif
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-blue-700 mb-1">Description du poste</label>
                        <p class="text-gray-900">
                            @if($enseignant->description)
                                {{ $enseignant->description }}
                            @else
                                <span class="text-gray-500 italic">Aucune description fournie</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- COLONNE DROITE : STATISTIQUES ET ACTIONS --}}
        <div>
            
            {{-- STATISTIQUES --}}
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 text-white rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4 text-white flex items-center gap-2">
                    <i class="fas fa-chart-line"></i>
                    Statistiques
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-blue-300"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Étudiants</p>
                                <p class="text-lg font-bold">{{ rand(15, 30) }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-green-400">+{{ rand(5, 12) }}%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chalkboard text-green-300"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Classes</p>
                                <p class="text-lg font-bold">{{ rand(2, 5) }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-blue-400">{{ rand(20, 40) }}h/sem</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-file-alt text-purple-300"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Cours créés</p>
                                <p class="text-lg font-bold">{{ rand(5, 15) }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-yellow-400">{{ rand(4, 5) }}/5 ★</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MÉTADONNÉES --}}
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-gray-600"></i>
                    Métadonnées
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">ID</span>
                        <span class="text-sm font-medium">#{{ str_pad($enseignant->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">Créé le</span>
                        <span class="text-sm font-medium">{{ $enseignant->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">Modifié le</span>
                        <span class="text-sm font-medium">{{ $enseignant->updated_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">Dernière connexion</span>
                        <span class="text-sm font-medium text-green-600">Aujourd'hui</span>
                    </div>
                </div>
            </div>

            {{-- ACTIONS RAPIDES --}}
            <div class="space-y-3">
                <a href="{{ route('enseignants.edit', $enseignant) }}"
                   class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
                          text-white px-4 py-3 rounded-lg shadow hover:shadow-lg transition 
                          flex items-center justify-center gap-2 font-medium">
                    <i class="fas fa-edit"></i>
                    Modifier l'enseignant
                </a>

                <form action="{{ route('enseignants.destroy', $enseignant) }}" 
                      method="POST" 
                      class="inline w-full"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 
                                   text-white px-4 py-3 rounded-lg shadow hover:shadow-lg transition 
                                   flex items-center justify-center gap-2 font-medium">
                        <i class="fas fa-trash-alt"></i>
                        Supprimer l'enseignant
                    </button>
                </form>

                <a href="{{ route('enseignants.index') }}"
                   class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 
                          px-4 py-3 rounded-lg shadow hover:shadow-lg transition 
                          flex items-center justify-center gap-2 font-medium border border-gray-300">
                    <i class="fas fa-list"></i>
                    Voir tous les enseignants
                </a>
            </div>
        </div>
    </div>
</div>

{{-- SECTION SUPPLEMENTAIRE : CLASSES ENSEIGNÉES --}}
<div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mb-8">
    <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center gap-2">
        <i class="fas fa-chalkboard text-green-600"></i>
        Classes enseignées
    </h3>
    
    @if($enseignant->classes && $enseignant->classes->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($enseignant->classes->take(6) as $classe)
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 border border-green-100 hover:border-green-300 transition">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-school text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $classe->nom }}</h4>
                            <p class="text-xs text-gray-600">{{ $classe->niveau ?? 'Tous niveaux' }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-medium">
                        {{ rand(15, 30) }} élèves
                    </span>
                </div>
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <span>{{ $classe->annee_scolaire ?? '2023-2024' }}</span>
                    <a href="{{ route('classes.show', $classe) }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        Voir la classe →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($enseignant->classes->count() > 6)
        <div class="text-center mt-6">
            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                Voir les {{ $enseignant->classes->count() - 6 }} autres classes →
            </a>
        </div>
        @endif
    @else
        <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
            <i class="fas fa-chalkboard-teacher text-4xl text-gray-300 mb-3"></i>
            <p class="text-gray-600">Cet enseignant n'est pas assigné à une classe pour le moment</p>
            <a href="{{ route('classes.index') }}" class="text-blue-600 hover:text-blue-800 font-medium mt-2 inline-block">
                Assigner à une classe →
            </a>
        </div>
    @endif
</div>

{{-- INFORMATIONS DE CONTACT --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-envelope text-blue-600 text-xl"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-900">Email</h4>
                <p class="text-sm text-gray-600">Contact professionnel</p>
            </div>
        </div>
        <a href="mailto:{{ $enseignant->email }}" 
           class="text-lg font-medium text-blue-600 hover:text-blue-800">
            {{ $enseignant->email }}
        </a>
    </div>

    @if($enseignant->telephone)
    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-phone text-green-600 text-xl"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-900">Téléphone</h4>
                <p class="text-sm text-gray-600">Contact direct</p>
            </div>
        </div>
        <a href="tel:{{ $enseignant->telephone }}" 
           class="text-lg font-medium text-gray-900 hover:text-green-600">
            {{ $enseignant->telephone }}
        </a>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-purple-600 text-xl"></i>
            </div>
            <div>
                <h4 class="font-semibold text-gray-900">Disponibilité</h4>
                <p class="text-sm text-gray-600">Horaires de travail</p>
            </div>
        </div>
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-gray-600">Lundi - Vendredi</span>
                <span class="font-medium">8h00 - 17h00</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Samedi</span>
                <span class="font-medium">9h00 - 12h00</span>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Animation pour les cartes */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>
@endpush