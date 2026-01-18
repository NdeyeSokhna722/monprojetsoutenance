@extends('layouts.app')

@section('content')

{{-- TITRE + ACTIONS --}}
<div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 mb-8">

    {{-- TITRE --}}
    <h1 class="text-3xl font-bold text-gray-900">
        Enseignants
    </h1>

    {{-- ACTIONS --}}
    <div class="flex flex-col sm:flex-row gap-3">
        {{-- AJOUT --}}
        <a href="{{ route('enseignants.create') }}"
           class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
                  text-white px-5 py-2.5 rounded-lg shadow hover:shadow-lg transition 
                  flex items-center justify-center gap-2 font-medium">
            <i class="fas fa-user-plus"></i>
            Ajouter un enseignant
        </a>
    </div>
</div>

{{-- BARRE DE RECHERCHE --}}
<form method="GET"
      action="{{ route('enseignants.index') }}"
      class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-6">
    <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher un enseignant par nom, prénom, email..."
                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                >
            </div>
        </div>
        
        <div class="flex gap-2">
            <button
                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
                       text-white px-6 py-3 rounded-lg transition flex items-center gap-2 font-medium">
                <i class="fas fa-search"></i>
                Rechercher
            </button>
            
            @if(request()->has('search'))
            <a href="{{ route('enseignants.index') }}"
               class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-3 rounded-lg transition flex items-center gap-2 font-medium">
                <i class="fas fa-redo"></i>
                Réinitialiser
            </a>
            @endif
        </div>
    </div>
</form>

{{-- STATISTIQUES --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Total enseignants</p>
                <p class="text-2xl font-bold text-gray-900">{{ $enseignants->total() }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-lg">
                <i class="fas fa-chalkboard-teacher text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Disponibles</p>
                <p class="text-2xl font-bold text-green-600">{{ rand(15, 25) }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-lg">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Classes assignées</p>
                <p class="text-2xl font-bold text-purple-600">{{ rand(10, 20) }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-lg">
                <i class="fas fa-school text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Moyenne élèves</p>
                <p class="text-2xl font-bold text-orange-600">{{ rand(20, 30) }}</p>
            </div>
            <div class="bg-orange-100 p-3 rounded-lg">
                <i class="fas fa-users text-orange-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

{{-- MESSAGE SUCCESS --}}
@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

{{-- TABLE --}}
<div class="bg-white rounded-xl shadow overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full text-gray-700">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enseignant</th>
                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spécialité</th>
                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matière</th>
                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'ajout</th>
                    <th class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($enseignants as $ens)
                <tr class="hover:bg-gray-50 transition-colors">
                    {{-- ID --}}
                    <td class="p-4">
                        <span class="text-sm font-medium text-gray-900">#{{ str_pad($ens->id, 3, '0', STR_PAD_LEFT) }}</span>
                    </td>

                    {{-- ENSEIGNANT --}}
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center overflow-hidden">
                                @if($ens->photo)
                                    <img src="{{ asset('storage/enseignants/'.$ens->photo) }}"
                                         class="w-full h-full object-cover"
                                         alt="{{ $ens->prenom }} {{ $ens->nom }}">
                                @else
                                    <i class="fas fa-user text-blue-600"></i>
                                @endif
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">
                                    {{ $ens->prenom }} {{ $ens->nom }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $ens->email }}</div>
                            </div>
                        </div>
                    </td>

                    {{-- CONTACT --}}
                    <td class="p-4">
                        <div class="space-y-1">
                            <div class="text-sm text-gray-900">
                                <a href="mailto:{{ $ens->email }}" class="hover:text-blue-600">
                                    {{ $ens->email }}
                                </a>
                            </div>
                            @if($ens->telephone)
                            <div class="text-sm text-gray-600">
                                <a href="tel:{{ $ens->telephone }}" class="hover:text-green-600">
                                    {{ $ens->telephone }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </td>

                    {{-- SPECIALITE --}}
                    <td class="p-4">
                        @if($ens->specialite)
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-medium">
                                {{ $ens->specialite }}
                            </span>
                        @else
                            <span class="text-gray-400 text-sm">—</span>
                        @endif
                    </td>

                    {{-- MATIERE --}}
                    <td class="p-4">
                        @if($ens->matiere)
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-blue-100 rounded flex items-center justify-center">
                                    <i class="fas fa-book text-blue-600 text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-900">{{ $ens->matiere->nom }}</span>
                            </div>
                        @else
                            <span class="text-gray-400 text-sm">—</span>
                        @endif
                    </td>

                    {{-- DATE D'AJOUT --}}
                    <td class="p-4">
                        <div class="text-sm text-gray-900">{{ $ens->created_at->format('d/m/Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $ens->created_at->diffForHumans() }}</div>
                    </td>

                    {{-- ACTIONS --}}
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            {{-- VOIR LES DÉTAILS --}}
                            <a href="{{ route('enseignants.show', $ens) }}"
                               class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors"
                               title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>

                            {{-- MODIFIER --}}
                            <a href="{{ route('enseignants.edit', $ens) }}"
                               class="p-2 bg-green-50 text-green-600 hover:bg-green-100 rounded-lg transition-colors"
                               title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>

                            {{-- SUPPRIMER --}}
                            <form action="{{ route('enseignants.destroy', $ens) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors"
                                        title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-8 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-chalkboard-teacher text-4xl text-gray-300 mb-3"></i>
                            <p class="text-lg text-gray-500">Aucun enseignant trouvé</p>
                            @if(request()->has('search'))
                                <p class="text-sm text-gray-400 mt-1">Essayez de modifier vos critères de recherche</p>
                            @else
                                <p class="text-sm text-gray-400 mt-1">Commencez par ajouter votre premier enseignant</p>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($enseignants->hasPages())
<div class="px-6 py-4 border-t border-gray-200">
    <div class="flex items-center justify-between">
        <div class="text-sm text-gray-500">
            Affichage de {{ $enseignants->firstItem() }} à {{ $enseignants->lastItem() }} sur {{ $enseignants->total() }} enseignants
        </div>
        <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                {{-- Previous Page Link --}}
                @if ($enseignants->onFirstPage())
                    <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-300 cursor-not-allowed">
                        <span class="sr-only">Précédent</span>
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $enseignants->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Précédent</span>
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($enseignants->links()->elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $enseignants->currentPage())
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($enseignants->hasMorePages())
                    <a href="{{ $enseignants->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Suivant</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-300 cursor-not-allowed">
                        <span class="sr-only">Suivant</span>
                        <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </nav>
        </div>
    </div>
</div>
@endif

{{-- ACTIONS RAPIDES --}}
<div class="mt-8 pt-6 border-t border-gray-200">
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('enseignants.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
                  text-white rounded-lg transition shadow hover:shadow-lg">
            <i class="fas fa-user-plus mr-2"></i> Ajouter un enseignant
        </a>
        
        @if(Route::has('matieres.index'))
            <a href="{{ route('matieres.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 
                      text-white rounded-lg transition shadow hover:shadow-lg">
                <i class="fas fa-book mr-2"></i> Gérer les matières
            </a>
        @endif
        
        @if(Route::has('classes.index'))
            <a href="{{ route('classes.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 
                      text-white rounded-lg transition shadow hover:shadow-lg">
                <i class="fas fa-school mr-2"></i> Gérer les classes
            </a>
        @endif
    </div>
</div>

@endsection