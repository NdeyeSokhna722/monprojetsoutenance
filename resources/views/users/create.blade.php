@extends('layouts.app')

@section('content')

{{-- En-tête --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Ajouter un nouvel utilisateur</h1>
    <p class="text-gray-600 dark:text-gray-400">Remplissez les informations pour créer un nouveau compte</p>
</div>

{{-- Carte du formulaire --}}
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
    {{-- En-tête de la carte --}}
    <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-orange-500 to-orange-400 flex items-center justify-center">
                <i class="fas fa-user-plus text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Création d'un utilisateur</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Tous les champs sont obligatoires</p>
            </div>
        </div>
    </div>

    {{-- Formulaire --}}
    <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-6">
        @csrf

        {{-- Informations personnelles --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <i class="fas fa-id-card text-orange-500"></i>
                Informations personnelles
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nom --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-user text-gray-500"></i>
                            Nom complet
                        </span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input
                            type="text"
                            name="name"
                            required
                            value="{{ old('name') }}"
                            placeholder="John Doe"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        >
                    </div>
                    @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-envelope text-gray-500"></i>
                            Adresse email
                        </span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-at text-gray-400"></i>
                        </div>
                        <input
                            type="email"
                            name="email"
                            required
                            value="{{ old('email') }}"
                            placeholder="john.doe@ndindy.edu"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        >
                    </div>
                    @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Mot de passe et rôle --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <i class="fas fa-lock text-orange-500"></i>
                Sécurité et rôle
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Mot de passe --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-key text-gray-500"></i>
                            Mot de passe
                        </span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input
                            type="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        >
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" onclick="togglePassword(this)" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimum 8 caractères</p>
                    @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmation mot de passe --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-key text-gray-500"></i>
                            Confirmation mot de passe
                        </span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="••••••••"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        >
                    </div>
                </div>
            </div>

            {{-- Rôle --}}
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-user-tag text-gray-500"></i>
                        Rôle de l'utilisateur
                    </span>
                </label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <input type="radio" name="role" value="admin" class="text-orange-600 focus:ring-orange-500">
                        <div class="ml-3">
                            <span class="font-medium text-gray-900 dark:text-white">Administrateur</span>
                            <p class="text-xs text-gray-500">Accès complet</p>
                        </div>
                    </label>
                    
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <input type="radio" name="role" value="teacher" class="text-blue-600 focus:ring-blue-500">
                        <div class="ml-3">
                            <span class="font-medium text-gray-900 dark:text-white">Enseignant</span>
                            <p class="text-xs text-gray-500">Gestion cours</p>
                        </div>
                    </label>
                    
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <input type="radio" name="role" value="student" class="text-green-600 focus:ring-green-500">
                        <div class="ml-3">
                            <span class="font-medium text-gray-900 dark:text-white">Étudiant</span>
                            <p class="text-xs text-gray-500">Accès étudiant</p>
                        </div>
                    </label>
                    
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <input type="radio" name="role" value="user" class="text-gray-600 focus:ring-gray-500" checked>
                        <div class="ml-3">
                            <span class="font-medium text-gray-900 dark:text-white">Utilisateur</span>
                            <p class="text-xs text-gray-500">Accès limité</p>
                        </div>
                    </label>
                </div>
                @error('role')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Section supplémentaire (optionnel) --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <i class="fas fa-info-circle text-orange-500"></i>
                Informations supplémentaires
            </h3>
            
            {{-- Téléphone --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-phone text-gray-500"></i>
                        Téléphone
                    </span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-phone text-gray-400"></i>
                    </div>
                    <input
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="+33 1 23 45 67 89"
                        class="pl-10 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    >
                </div>
            </div>

            {{-- Adresse --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-gray-500"></i>
                        Adresse
                    </span>
                </label>
                <textarea
                    name="address"
                    rows="2"
                    placeholder="Adresse complète"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                >{{ old('address') }}</textarea>
            </div>
        </div>

        {{-- Actions --}}
        <div class="pt-6 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                L'utilisateur recevra un email de confirmation
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('users.index') }}"
                   class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition font-medium">
                    Annuler
                </a>
                
                <button
                    type="submit"
                    class="group relative px-6 py-3 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 font-medium flex items-center gap-2">
                    <i class="fas fa-user-plus"></i>
                    Créer l'utilisateur
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Script pour afficher/masquer le mot de passe --}}
<script>
function togglePassword(button) {
    const input = button.closest('.relative').querySelector('input[type="password"], input[type="text"]');
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Animation des champs au focus
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-orange-200', 'dark:ring-orange-900/30');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-orange-200', 'dark:ring-orange-900/30');
        });
    });
});
</script>

@endsection