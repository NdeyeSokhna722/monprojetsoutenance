@extends('layouts.app')

@section('content')

{{-- TITRE + ACTION --}}
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
        <i class="fas fa-users-class mr-3 text-orange-500"></i>
        Gestion des Classes
    </h1>

    <a href="{{ route('classes.create') }}"
       class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300 flex items-center gap-3 transform hover:-translate-y-1">
        <i class="fas fa-plus-circle"></i>
        <span class="font-semibold">Nouvelle classe</span>
    </a>
</div>

{{-- CARTES STATISTIQUES --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-gray-800 dark:to-blue-900/30 p-6 rounded-2xl shadow-lg border border-blue-200 dark:border-blue-800">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-blue-700 dark:text-blue-300">Total des classes</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $classes->total() }}</p>
            </div>
            <div class="p-4 bg-blue-100 dark:bg-blue-900 rounded-2xl">
                <i class="fas fa-school text-2xl text-blue-600 dark:text-blue-400"></i>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-gray-800 dark:to-green-900/30 p-6 rounded-2xl shadow-lg border border-green-200 dark:border-green-800">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-green-700 dark:text-green-300">Classes affichées</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $classes->count() }}</p>
            </div>
            <div class="p-4 bg-green-100 dark:bg-green-900 rounded-2xl">
                <i class="fas fa-list text-2xl text-green-600 dark:text-green-400"></i>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-gray-800 dark:to-purple-900/30 p-6 rounded-2xl shadow-lg border border-purple-200 dark:border-purple-800">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-purple-700 dark:text-purple-300">Niveaux différents</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                    {{ $classes->unique('niveau')->count() }}
                </p>
            </div>
            <div class="p-4 bg-purple-100 dark:bg-purple-900 rounded-2xl">
                <i class="fas fa-layer-group text-2xl text-purple-600 dark:text-purple-400"></i>
            </div>
        </div>
    </div>
</div>

{{-- BARRE DE RECHERCHE ET FILTRES --}}
<div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 p-6 rounded-2xl shadow-lg mb-8 border border-gray-200 dark:border-gray-700">
    <form method="GET" action="{{ route('classes.index') }}" class="flex flex-col lg:flex-row gap-6">
        <div class="flex-1">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 dark:text-gray-500"></i>
                </div>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher une classe par nom..."
                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300"
                >
            </div>
        </div>

        <div class="flex flex-wrap gap-4">
            @if(request('search'))
                <a href="{{ route('classes.index') }}" 
                   class="px-4 py-3 rounded-xl bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-300 transition-colors duration-300 flex items-center gap-2">
                    <i class="fas fa-times"></i>
                    Effacer filtres
                </a>
            @endif

            <button
                type="submit"
                class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl transition-all duration-300 flex items-center gap-3 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class="fas fa-filter"></i>
                Appliquer filtres
            </button>
        </div>
    </form>
</div>

{{-- TABLEAU AMÉLIORÉ --}}
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800">
                <tr>
                    <th class="p-6 text-left">
                        <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 font-semibold">
                            <i class="fas fa-hashtag"></i>
                            ID
                        </div>
                    </th>
                    <th class="p-6 text-left">
                        <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 font-semibold">
                            <i class="fas fa-font"></i>
                            Nom
                        </div>
                    </th>
                    <th class="p-6 text-left">
                        <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 font-semibold">
                            <i class="fas fa-chart-line"></i>
                            Niveau
                        </div>
                    </th>
                    <th class="p-6 text-left">
                        <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 font-semibold">
                            <i class="fas fa-cogs"></i>
                            Actions
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($classes as $classe)
                <tr class="border-t border-gray-100 dark:border-gray-700 hover:bg-gradient-to-r hover:from-orange-50/50 hover:to-orange-100/50 dark:hover:from-gray-750 dark:hover:to-gray-700 transition-all duration-300 group">
                    <td class="p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center">
                                <span class="font-bold text-blue-600 dark:text-blue-400">{{ $classe->id }}</span>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $classe->id }}</span>
                        </div>
                    </td>
                    
                    <td class="p-6">
                        <div class="flex flex-col">
                            <span class="font-semibold text-gray-900 dark:text-white text-lg">{{ $classe->nom }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                <i class="fas fa-calendar mr-1"></i>
                                Créée le {{ $classe->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </td>

                    <td class="p-6">
                        @php
                            $niveauColors = [
                                'Débutant' => 'from-green-500 to-emerald-600',
                                'Intermédiaire' => 'from-blue-500 to-cyan-600',
                                'Avancé' => 'from-purple-500 to-violet-600',
                                'Expert' => 'from-orange-500 to-red-600',
                            ];
                            $color = $niveauColors[$classe->niveau] ?? 'from-gray-500 to-gray-600';
                        @endphp
                        <div class="inline-flex items-center gap-3">
                            <span class="px-5 py-2.5 rounded-xl bg-gradient-to-r {{ $color }} text-white font-semibold shadow-lg">
                                {{ $classe->niveau }}
                            </span>
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r {{ $color }} opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <i class="fas fa-arrow-right text-white text-xs"></i>
                            </div>
                        </div>
                    </td>

                    <td class="p-6">
                        <div class="flex items-center gap-3">
                            {{-- Modifier --}}
                            <a href="{{ route('classes.edit', $classe->id) }}"
                               class="p-3 rounded-xl bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 text-orange-600 dark:text-orange-400 hover:from-orange-100 hover:to-orange-200 dark:hover:from-orange-800/30 dark:hover:to-orange-700/30 transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md"
                               title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>

                            {{-- Supprimer --}}
                            <button
                                onclick="showDeleteModal({{ $classe->id }}, '{{ $classe->nom }}')"
                                class="p-3 rounded-xl bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 text-red-600 dark:text-red-400 hover:from-red-100 hover:to-red-200 dark:hover:from-red-800/30 dark:hover:to-red-700/30 transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md"
                                title="Supprimer">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-12 text-center">
                        <div class="flex flex-col items-center justify-center gap-4">
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                                <i class="fas fa-users-slash text-4xl text-gray-400 dark:text-gray-600"></i>
                            </div>
                            <div class="text-center">
                                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Aucune classe trouvée
                                </h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-6">
                                    @if(request('search'))
                                        Aucun résultat pour "{{ request('search') }}"
                                    @else
                                        Commencez par créer votre première classe
                                    @endif
                                </p>
                                <a href="{{ route('classes.create') }}"
                                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-plus"></i>
                                    Créer une classe
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if($classes->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Affichage de <span class="font-semibold">{{ $classes->firstItem() }}</span> à 
                <span class="font-semibold">{{ $classes->lastItem() }}</span> sur 
                <span class="font-semibold">{{ $classes->total() }}</span> classes
            </div>
            <div class="flex gap-2">
                {{ $classes->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

{{-- MODAL DE CONFIRMATION DE SUPPRESSION --}}
<div id="deleteModal" class="fixed inset-0 bg-gray-900/70 dark:bg-gray-900/90 backdrop-blur-sm z-50 hidden transition-opacity duration-300">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <div class="p-8">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-red-100 to-red-200 dark:from-red-900/30 dark:to-red-800/30 mx-auto mb-6">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                
                <h3 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-2">
                    Confirmer la suppression
                </h3>
                
                <p class="text-center text-gray-600 dark:text-gray-300 mb-8">
                    Êtes-vous sûr de vouloir supprimer la classe <span id="className" class="font-semibold text-orange-600 dark:text-orange-400"></span> ?
                    Cette action est irréversible.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button
                        onclick="hideDeleteModal()"
                        class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 hover:from-gray-300 hover:to-gray-400 dark:hover:from-gray-600 dark:hover:to-gray-700 text-gray-800 dark:text-gray-300 transition-all duration-300 font-semibold">
                        Annuler
                    </button>
                    
                    <form id="deleteForm" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="w-full px-6 py-3 rounded-xl bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script>
    function showDeleteModal(id, name) {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        const className = document.getElementById('className');
        const form = document.getElementById('deleteForm');
        
        className.textContent = name;
        form.action = `/classes/${id}`;
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function hideDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Fermer la modal en cliquant en dehors
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target.id === 'deleteModal') {
            hideDeleteModal();
        }
    });

    // Gestion des messages flash
    @if(session('success'))
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            className: "shadow-lg rounded-xl",
        }).showToast();
    @endif

    @if(session('error'))
        Toastify({
            text: "{{ session('error') }}",
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
            className: "shadow-lg rounded-xl",
        }).showToast();
    @endif
</script>

<style>
    /* Animations personnalisées */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fadeIn {
        animation: fadeIn 0.5s ease-out;
    }

    /* Style pour la pagination */
    .pagination {
        display: flex;
        gap: 0.5rem;
    }

    .pagination .page-item .page-link {
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
        background: linear-gradient(to right, #f3f4f6, #e5e7eb);
        color: #374151;
        transition: all 0.3s;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(to right, #f97316, #ea580c);
        color: white;
        box-shadow: 0 4px 6px -1px rgba(249, 115, 22, 0.3);
    }

    .pagination .page-item:not(.active) .page-link:hover {
        background: linear-gradient(to right, #e5e7eb, #d1d5db);
        transform: translateY(-2px);
    }

    /* Dark mode pour la pagination */
    .dark .pagination .page-item .page-link {
        background: linear-gradient(to right, #374151, #4b5563);
        color: #d1d5db;
    }

    .dark .pagination .page-item:not(.active) .page-link:hover {
        background: linear-gradient(to right, #4b5563, #6b7280);
    }
</style>

@endsection