@extends('layouts.app')

@section('content')

{{-- TITRE + ACTION --}}
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-blue-800">Élèves</h1>

    <a href="{{ route('etudiants.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition flex items-center">
        <i class="fas fa-plus mr-2"></i> Ajouter
    </a>
</div>

{{-- RECHERCHE --}}
<form method="GET" class="mb-6 flex gap-2">
    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Rechercher un étudiant..."
           class="w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
    
    <select name="classe_id" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        <option value="">Toutes les classes</option>
        @foreach($classes as $classe)
            <option value="{{ $classe->id }}" {{ request('classe_id') == $classe->id ? 'selected' : '' }}>
                {{ $classe->nom }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition flex items-center">
        <i class="fas fa-search mr-2"></i> Rechercher
    </button>
    
    @if(request()->has('search') || request()->has('classe_id'))
        <a href="{{ route('etudiants.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">
            Réinitialiser
        </a>
    @endif
</form>

{{-- STATISTIQUES --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
        <div class="text-2xl font-bold text-blue-600">{{ $totalEtudiants }}</div>
        <div class="text-gray-600">Total étudiants</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
        <div class="text-2xl font-bold text-green-600">{{ $etudiantsActifs }}</div>
        <div class="text-gray-600">Étudiants actifs</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
        <div class="text-2xl font-bold text-purple-600">{{ $classesCount }}</div>
        <div class="text-gray-600">Classes</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
        <div class="text-2xl font-bold text-orange-600">{{ $moyenneParClasse }}</div>
        <div class="text-gray-600">Moyenne/classe</div>
    </div>
</div>

{{-- TABLE --}}
<div class="bg-white rounded-xl shadow overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full text-gray-700">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Nom</th>
                    <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Prénom</th>
                    <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Email</th>
                    <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Classe</th>
                    <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Téléphone</th>
                    <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Date de naissance</th>
                    <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Adresse</th>
                    <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Statut</th>
                    <th class="px-4 py-3 text-center font-semibold whitespace-nowrap">Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse($etudiants as $etudiant)
                <tr class="border-t border-gray-200 hover:bg-blue-50 transition duration-150">
                    {{-- NOM --}}
                    <td class="px-4 py-3 font-medium whitespace-nowrap">{{ $etudiant->nom }}</td>
                    
                    {{-- PRENOM --}}
                    <td class="px-4 py-3 whitespace-nowrap">{{ $etudiant->prenom }}</td>
                    
                    {{-- EMAIL --}}
                    <td class="px-4 py-3 whitespace-nowrap">
                        <a href="mailto:{{ $etudiant->email }}" class="text-blue-600 hover:text-blue-800 truncate block max-w-xs">
                            {{ $etudiant->email }}
                        </a>
                    </td>
                    
                    {{-- CLASSE --}}
                    <td class="px-4 py-3 whitespace-nowrap">
                        @if($etudiant->classe)
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm whitespace-nowrap">
                                {{ $etudiant->classe->nom }}
                            </span>
                        @else
                            <span class="text-gray-400">—</span>
                        @endif
                    </td>
                    
                    {{-- TELEPHONE --}}
                    <td class="px-4 py-3 whitespace-nowrap">
                        @if($etudiant->telephone)
                            <a href="tel:{{ $etudiant->telephone }}" class="text-gray-600 hover:text-blue-600">
                                {{ $etudiant->telephone }}
                            </a>
                        @else
                            <span class="text-gray-400">—</span>
                        @endif
                    </td>
                    
                    {{-- DATE DE NAISSANCE --}}
                    <td class="px-4 py-3 whitespace-nowrap">
                        @if($etudiant->date_naissance)
                            {{ $etudiant->date_naissance->format('d/m/Y') }}
                            @php
                                $age = now()->diffInYears($etudiant->date_naissance);
                            @endphp
                            <span class="text-xs text-gray-500 block">({{ $age }} ans)</span>
                        @else
                            <span class="text-gray-400">—</span>
                        @endif
                    </td>
                    
                    {{-- ADRESSE --}}
                    <td class="px-4 py-3 max-w-xs">
                        @if($etudiant->adresse)
                            <div class="group relative">
                                <span class="truncate block">
                                    {{ Str::limit($etudiant->adresse, 40) }}
                                </span>
                                @if(strlen($etudiant->adresse) > 40)
                                    <div class="absolute invisible group-hover:visible z-10 bg-gray-900 text-white text-xs rounded py-1 px-2 mt-1 whitespace-normal max-w-xs">
                                        {{ $etudiant->adresse }}
                                        <div class="absolute -top-1 left-4 w-2 h-2 bg-gray-900 transform rotate-45"></div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <span class="text-gray-400">—</span>
                        @endif
                    </td>
                    
                    {{-- STATUT --}}
                    <td class="px-4 py-3 whitespace-nowrap">
                        @php
                            $statutColors = [
                                'actif' => 'bg-green-100 text-green-800',
                                'inactif' => 'bg-gray-100 text-gray-800',
                                'diplome' => 'bg-blue-100 text-blue-800',
                                'abandon' => 'bg-red-100 text-red-800',
                            ];
                            $statutColor = $statutColors[$etudiant->statut] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statutColor }}">
                            {{ ucfirst($etudiant->statut) }}
                        </span>
                    </td>
                    
                    {{-- ACTIONS --}}
                    <td class="px-4 py-3 whitespace-nowrap">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('etudiants.show', $etudiant) }}"
                               class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition text-sm"
                               title="Voir">
                                <i class="fas fa-eye mr-1"></i>
                            </a>

                            <a href="{{ route('etudiants.edit', $etudiant) }}"
                               class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition text-sm"
                               title="Modifier">
                                <i class="fas fa-edit mr-1"></i>
                            </a>

                            <form action="{{ route('etudiants.destroy', $etudiant) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ? Cette action est irréversible.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition text-sm"
                                        title="Supprimer">
                                    <i class="fas fa-trash mr-1"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-user-graduate text-4xl text-gray-300 mb-3"></i>
                            <p class="text-lg">Aucun étudiant trouvé</p>
                            @if(request()->has('search') || request()->has('classe_id'))
                                <p class="text-sm mt-1">Essayez de modifier vos critères de recherche</p>
                            @else
                                <p class="text-sm mt-1">Commencez par ajouter votre premier étudiant</p>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- PAGINATION --}}
<div class="mt-6">
    {{ $etudiants->links() }}
</div>

{{-- ACTIONS RAPIDES --}}
<div class="mt-8 pt-6 border-t border-gray-200">
    <div class="flex flex-wrap gap-4">
        @if(Route::has('classes.index'))
            <a href="{{ route('classes.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition">
                <i class="fas fa-chalkboard-teacher mr-2"></i> Gérer les classes
            </a>
        @endif
        
        @if(Route::has('etudiants.export'))
            <a href="{{ route('etudiants.export') }}" 
               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                <i class="fas fa-file-excel mr-2"></i> Exporter (Excel)
            </a>
        @endif
        
        <a href="{{ route('etudiants.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition">
            <i class="fas fa-user-plus mr-2"></i> Inscription rapide
        </a>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Styles pour le tooltip de l'adresse */
    .group:hover .group-hover\:visible {
        visibility: visible;
    }
    
    .group .group-hover\:visible {
        visibility: hidden;
    }
</style>
@endpush