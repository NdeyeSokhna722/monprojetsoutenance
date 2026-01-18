@extends('layouts.app')

@section('content')

{{-- En-tête --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Détails de l'utilisateur</h1>
            <p class="text-gray-600 dark:text-gray-400">Informations complètes de {{ $user->name }}</p>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="{{ route('users.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition font-medium">
                <i class="fas fa-arrow-left"></i>
                Retour à la liste
            </a>
            <a href="{{ route('users.edit', $user) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 font-medium">
                <i class="fas fa-edit"></i>
                Modifier
            </a>
        </div>
    </div>
</div>

{{-- Carte principale --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Colonne de gauche : Profil et informations de base --}}
    <div class="lg:col-span-2 space-y-8">
        {{-- Carte du profil --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
            {{-- En-tête avec photo de profil --}}
            <div class="p-6 bg-gradient-to-r from-orange-600 to-orange-500 text-white">
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center shadow-lg">
                            <span class="text-3xl font-bold text-orange-600">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                        <p class="text-orange-100">{{ $user->email }}</p>
                        <div class="flex items-center gap-3 mt-2">
                            @if($user->role === 'admin')
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                                <i class="fas fa-crown mr-1"></i> Administrateur
                            </span>
                            @elseif($user->role === 'teacher')
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                                <i class="fas fa-chalkboard-teacher mr-1"></i> Enseignant
                            </span>
                            @elseif($user->role === 'student')
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                                <i class="fas fa-graduation-cap mr-1"></i> Étudiant
                            </span>
                            @else
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                                <i class="fas fa-user mr-1"></i> Utilisateur
                            </span>
                            @endif
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm">
                                <i class="fas fa-id-card mr-1"></i> ID: {{ $user->id }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informations détaillées --}}
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-orange-500"></i>
                    Informations personnelles
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nom complet</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Rôle</label>
                            <div class="mt-1">
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
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date d'inscription</label>
                            <p class="text-gray-900 dark:text-white font-medium">
                                {{ $user->created_at ? $user->created_at->format('d/m/Y à H:i') : 'Non disponible' }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Dernière mise à jour</label>
                            <p class="text-gray-900 dark:text-white font-medium">
                                {{ $user->updated_at ? $user->updated_at->format('d/m/Y à H:i') : 'Non disponible' }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Statut</label>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="text-green-700 dark:text-green-400 font-medium">Actif</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informations supplémentaires --}}
                @if($user->phone || $user->address)
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-address-card text-orange-500"></i>
                        Coordonnées
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($user->phone)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Téléphone</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $user->phone }}</p>
                        </div>
                        @endif
                        
                        @if($user->address)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Adresse</label>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $user->address }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Section des statistiques (optionnelle) --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fas fa-chart-bar text-orange-500"></i>
                    Activité de l'utilisateur
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">0</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Cours suivis</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">0</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Notes publiées</div>
                    </div>
                    <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">0</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Présences</div>
                    </div>
                    <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $user->created_at ? now()->diffInDays($user->created_at) : '0' }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Jours inscrits</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Colonne de droite : Actions et informations rapides --}}
    <div class="space-y-8">
        {{-- Actions rapides --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fas fa-bolt text-orange-500"></i>
                    Actions rapides
                </h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('users.edit', $user) }}"
                   class="flex items-center gap-3 p-3 rounded-lg hover:bg-orange-50 dark:hover:bg-orange-900/20 transition">
                    <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-edit text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Modifier le profil</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Éditer les informations</p>
                    </div>
                </a>
                
                <a href="#"
                   class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-envelope text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Envoyer un message</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Contacter l'utilisateur</p>
                    </div>
                </a>
                
                <form action="{{ route('users.destroy', $user) }}" method="POST" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition text-red-600 dark:text-red-400">
                        <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-trash"></i>
                        </div>
                        <div class="text-left">
                            <p class="font-medium">Supprimer l'utilisateur</p>
                            <p class="text-sm opacity-75">Action irréversible</p>
                        </div>
                    </button>
                </form>
            </div>
        </div>

        {{-- Informations de compte --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fas fa-user-shield text-orange-500"></i>
                    Sécurité du compte
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Dernière connexion</label>
                    <p class="text-gray-900 dark:text-white font-medium">
                        {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y à H:i') : 'Jamais' }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Statut du compte</label>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-green-700 dark:text-green-400 font-medium">Actif et vérifié</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Permissions</label>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @if($user->role === 'admin')
                        <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs rounded">Accès complet</span>
                        <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs rounded">Gestion utilisateurs</span>
                        <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs rounded">Configuration</span>
                        @elseif($user->role === 'teacher')
                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs rounded">Gestion cours</span>
                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs rounded">Publication notes</span>
                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs rounded">Suivi étudiants</span>
                        @elseif($user->role === 'student')
                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs rounded">Accès cours</span>
                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs rounded">Consultation notes</span>
                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs rounded">Téléchargement</span>
                        @else
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400 text-xs rounded">Accès limité</span>
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400 text-xs rounded">Consultation</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Code QR ou badge (optionnel) --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fas fa-qrcode text-orange-500"></i>
                    Badge numérique
                </h3>
            </div>
            <div class="p-6 flex flex-col items-center justify-center">
                <div class="w-32 h-32 bg-gradient-to-r from-orange-500 to-orange-400 rounded-lg flex items-center justify-center mb-4">
                    <span class="text-4xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
                    Badge d'identification numérique<br>
                    ID: <span class="font-mono">{{ $user->id }}</span>
                </p>
                <button class="mt-4 px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-sm transition">
                    <i class="fas fa-download mr-1"></i> Télécharger
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Script pour les animations --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'entrée des éléments
    const cards = document.querySelectorAll('.bg-white, .bg-gray-800');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Confirmation de suppression améliorée
    const deleteForm = document.querySelector('form[onsubmit]');
    if (deleteForm) {
        deleteForm.onsubmit = function(e) {
            e.preventDefault();
            
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4';
            modal.innerHTML = `
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 max-w-md w-full">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">Confirmer la suppression</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Êtes-vous sûr de vouloir supprimer l'utilisateur <strong>${'{{ $user->name }}'}</strong> ? Cette action est irréversible.</p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="this.closest('.fixed').remove()" class="px-4 py-2.5 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                            Annuler
                        </button>
                        <button onclick="this.closest('form').submit()" class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                            Supprimer définitivement
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            modal.querySelector('button:last-child').focus();
            
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.remove();
                }
            });
            
            return false;
        };
    }
});
</script>

@endsection