@extends('layouts.app')

@section('content')

{{-- En-tête avec stats et bouton --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Gestion des Utilisateurs</h1>
            <p class="text-gray-600 dark:text-gray-400">Gérez les accès et permissions de tous les utilisateurs</p>
        </div>
        
        <a href="{{ route('users.create') }}"
           class="group relative inline-flex items-center gap-3 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
            <i class="fas fa-user-plus text-lg"></i>
            <span>Nouvel Utilisateur</span>
            <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full animate-pulse"></div>
        </a>
    </div>
    
    {{-- Stats rapides --}}
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 p-4 rounded-xl border border-blue-200 dark:border-blue-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-700 dark:text-blue-300 font-medium">Total Utilisateurs</p>
                    <p class="text-2xl font-bold text-blue-900 dark:text-blue-100 mt-1">{{ $users->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 p-4 rounded-xl border border-green-200 dark:border-green-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-700 dark:text-green-300 font-medium">Administrateurs</p>
                    <p class="text-2xl font-bold text-green-900 dark:text-green-100 mt-1">{{ $users->where('role', 'admin')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shield-alt text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 p-4 rounded-xl border border-purple-200 dark:border-purple-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-purple-700 dark:text-purple-300 font-medium">Utilisateurs Actifs</p>
                    <p class="text-2xl font-bold text-purple-900 dark:text-purple-100 mt-1">{{ $users->where('is_active', true)->count() ?? $users->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-check text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Message de succès --}}
@if(session('success'))
<div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-start gap-3 animate-fade-in">
    <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center flex-shrink-0">
        <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
    </div>
    <div>
        <p class="font-medium text-green-800 dark:text-green-300">Succès !</p>
        <p class="text-green-700 dark:text-green-400 text-sm mt-1">{{ session('success') }}</p>
    </div>
    <button onclick="this.parentElement.remove()" class="ml-auto text-green-600 hover:text-green-800">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

{{-- Tableau --}}
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
    {{-- En-tête du tableau avec recherche --}}
    <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="relative w-full md:w-auto">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" 
                       placeholder="Rechercher un utilisateur..." 
                       class="pl-10 pr-4 py-2.5 w-full md:w-80 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
            </div>
            <div class="flex items-center gap-3">
                <select class="px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Tous les rôles</option>
                    <option value="admin">Administrateurs</option>
                    <option value="user">Utilisateurs</option>
                </select>
                <button class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                        <div class="flex items-center gap-2">
                            <span>ID</span>
                            <i class="fas fa-sort text-gray-400 cursor-pointer"></i>
                        </div>
                    </th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                        <div class="flex items-center gap-2">
                            <span>Utilisateur</span>
                            <i class="fas fa-sort text-gray-400 cursor-pointer"></i>
                        </div>
                    </th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                        Rôle
                    </th>
                    
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                    <td class="p-4">
                        <span class="font-mono text-sm text-gray-500 dark:text-gray-400">#{{ $user->id }}</span>
                    </td>
                    
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-500 to-orange-400 flex items-center justify-center text-white font-bold">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Créé le {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </td>
                    
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-envelope text-gray-400 text-sm"></i>
                            <span class="text-gray-700 dark:text-gray-300">{{ $user->email }}</span>
                        </div>
                    </td>
                    
                    <td class="p-4">
                        @if($user->role === 'admin')
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-red-100 to-red-50 dark:from-red-900/40 dark:to-red-800/40 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-800">
                            <i class="fas fa-crown"></i>
                            Administrateur
                        </span>
                        @elseif($user->role === 'teacher')
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-100 to-blue-50 dark:from-blue-900/40 dark:to-blue-800/40 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                            <i class="fas fa-chalkboard-teacher"></i>
                            Enseignant
                        </span>
                        @elseif($user->role === 'student')
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-green-100 to-green-50 dark:from-green-900/40 dark:to-green-800/40 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-800">
                            <i class="fas fa-graduation-cap"></i>
                            Étudiant
                        </span>
                        @else
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-900/40 dark:to-gray-800/40 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-800">
                            <i class="fas fa-user"></i>
                            Utilisateur
                        </span>
                        @endif
                    </td>

                    
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('users.show', $user) }}"
                               class="w-10 h-10 flex items-center justify-center bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-lg transition group"
                               title="Voir détails">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <a href="{{ route('users.edit', $user) }}"
                               class="w-10 h-10 flex items-center justify-center bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 hover:bg-orange-100 dark:hover:bg-orange-900/50 rounded-lg transition group"
                               title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="{{ route('users.destroy', $user) }}"
                                  method="POST"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-10 h-10 flex items-center justify-center bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-lg transition"
                                        title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center">
                        <div class="flex flex-col items-center justify-center gap-4 py-8">
                            <div class="w-20 h-20 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                <i class="fas fa-users text-3xl text-gray-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">Aucun utilisateur trouvé</p>
                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Commencez par ajouter un nouvel utilisateur</p>
                            </div>
                            <a href="{{ route('users.create') }}"
                               class="mt-4 inline-flex items-center gap-2 text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300">
                                <i class="fas fa-plus"></i>
                                Ajouter un utilisateur
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination et footer du tableau --}}
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Affichage de <span class="font-semibold">{{ $users->firstItem() ?? 0 }}</span> à <span class="font-semibold">{{ $users->lastItem() ?? 0 }}</span> sur <span class="font-semibold">{{ $users->total() }}</span> utilisateurs
            </div>
            
            @if($users->hasPages())
            <div class="flex items-center gap-2">
                <button class="px-3 py-1.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                @for($i = 1; $i <= min(5, $users->lastPage()); $i++)
                    <button class="px-3 py-1.5 rounded-lg {{ $users->currentPage() == $i ? 'bg-orange-600 text-white' : 'bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600' }}">
                        {{ $i }}
                    </button>
                @endfor
                
                @if($users->lastPage() > 5)
                    <span class="px-2">...</span>
                    <button class="px-3 py-1.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600">
                        {{ $users->lastPage() }}
                    </button>
                @endif
                
                <button class="px-3 py-1.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Script pour améliorer l'interactivité --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des lignes au chargement
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(10px)';
        
        setTimeout(() => {
            row.style.transition = 'all 0.3s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 50);
    });
    
    // Confirmation de suppression améliorée
    const deleteForms = document.querySelectorAll('form[onsubmit]');
    deleteForms.forEach(form => {
        form.onsubmit = function(e) {
            e.preventDefault();
            
            // Créer une modale de confirmation personnalisée
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4';
            modal.innerHTML = `
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 max-w-md w-full animate-fade-in">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">Confirmer la suppression</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Cette action est irréversible. Voulez-vous vraiment supprimer cet utilisateur ?</p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button onclick="this.closest('.fixed').remove()" class="px-4 py-2.5 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                            Annuler
                        </button>
                        <button onclick="this.closest('form').submit()" class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                            Supprimer
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            modal.querySelector('button:last-child').focus();
            
            // Fermer en cliquant en dehors
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.remove();
                }
            });
            
            return false;
        };
    });
});
</script>

<style>
.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

@endsection