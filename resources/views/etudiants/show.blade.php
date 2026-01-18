@extends('layouts.app')

@section('content')

{{-- TITRE --}}
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-blue-800">Détails de l'étudiant</h1>
        <p class="text-gray-600 mt-2">
            <i class="fas fa-user-graduate mr-2"></i>
            Informations complètes sur l'étudiant
        </p>
    </div>
    
    <div class="flex gap-3">
        <a href="{{ route('etudiants.edit', $etudiant) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition flex items-center">
            <i class="fas fa-edit mr-2"></i> Modifier
        </a>
        <a href="{{ route('etudiants.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow transition flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
    </div>
</div>

{{-- CARTE PRINCIPALE --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- COLONNE GAUCHE : INFORMATIONS PERSONNELLES --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-200">
            {{-- EN-TÊTE AVEC NOM ET STATUT --}}
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $etudiant->prenom }} {{ $etudiant->nom }}
                    </h2>
                    <p class="text-gray-600 mt-1">
                        <i class="fas fa-envelope mr-2"></i>
                        {{ $etudiant->email }}
                    </p>
                </div>
                
                @php
                    $statutColors = [
                        'actif' => 'bg-green-100 text-green-800',
                        'inactif' => 'bg-gray-100 text-gray-800',
                        'diplome' => 'bg-blue-100 text-blue-800',
                        'abandon' => 'bg-red-100 text-red-800',
                    ];
                    $statutColor = $statutColors[$etudiant->statut] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $statutColor }}">
                    {{ ucfirst($etudiant->statut) }}
                </span>
            </div>

            {{-- GRID D'INFORMATIONS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- TELEPHONE --}}
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-phone text-blue-600 mr-3"></i>
                        <h3 class="font-semibold text-gray-700">Téléphone</h3>
                    </div>
                    <p class="text-gray-800">
                        @if($etudiant->telephone)
                            <a href="tel:{{ $etudiant->telephone }}" class="hover:text-blue-600">
                                {{ $etudiant->telephone }}
                            </a>
                        @else
                            <span class="text-gray-400">Non renseigné</span>
                        @endif
                    </p>
                </div>

                {{-- DATE DE NAISSANCE ET AGE --}}
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-birthday-cake text-green-600 mr-3"></i>
                        <h3 class="font-semibold text-gray-700">Date de naissance</h3>
                    </div>
                    <p class="text-gray-800">
                        @if($etudiant->date_naissance)
                            {{ $etudiant->date_naissance->format('d/m/Y') }}
                            <span class="text-gray-600 ml-2">
                                ({{ now()->diffInYears($etudiant->date_naissance) }} ans)
                            </span>
                        @else
                            <span class="text-gray-400">Non renseignée</span>
                        @endif
                    </p>
                </div>

                {{-- LIEU DE NAISSANCE --}}
                <div class="bg-purple-50 p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-map-marker-alt text-purple-600 mr-3"></i>
                        <h3 class="font-semibold text-gray-700">Lieu de naissance</h3>
                    </div>
                    <p class="text-gray-800">
                        {{ $etudiant->lieu_naissance ?? 'Non renseigné' }}
                    </p>
                </div>

                {{-- GENRE --}}
                <div class="bg-pink-50 p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user text-pink-600 mr-3"></i>
                        <h3 class="font-semibold text-gray-700">Genre</h3>
                    </div>
                    <p class="text-gray-800">
                        @php
                            $genres = [
                                'M' => 'Masculin',
                                'F' => 'Féminin',
                                'autre' => 'Autre'
                            ];
                        @endphp
                        {{ $genres[$etudiant->genre] ?? 'Non spécifié' }}
                    </p>
                </div>

                {{-- ADRESSE --}}
                <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-home text-gray-600 mr-3"></i>
                        <h3 class="font-semibold text-gray-700">Adresse</h3>
                    </div>
                    <p class="text-gray-800">
                        {{ $etudiant->adresse ?? 'Non renseignée' }}
                    </p>
                </div>

                {{-- CLASSE --}}
                <div class="md:col-span-2 bg-orange-50 p-4 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-chalkboard-teacher text-orange-600 mr-3"></i>
                            <div>
                                <h3 class="font-semibold text-gray-700">Classe</h3>
                                <p class="text-gray-800 mt-1">
                                    @if($etudiant->classe)
                                        <span class="font-medium">{{ $etudiant->classe->nom }}</span>
                                        @if($etudiant->classe->niveau)
                                            <span class="text-gray-600 ml-2">({{ $etudiant->classe->niveau }})</span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">Aucune classe assignée</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if($etudiant->classe)
                            <a href="{{ route('classes.show', $etudiant->classe) }}"
                               class="text-sm text-orange-600 hover:text-orange-800 font-medium">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                Voir la classe
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- NOTES ET EVALUATIONS --}}
        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-200 mt-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Notes et évaluations
                </h2>
                <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fas fa-plus mr-1"></i>
                    Ajouter une note
                </button>
            </div>

            @if($etudiant->notes && $etudiant->notes->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left">Matière</th>
                                <th class="px-4 py-3 text-left">Note</th>
                                <th class="px-4 py-3 text-left">Date</th>
                                <th class="px-4 py-3 text-left">Commentaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($etudiant->notes as $note)
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $note->matiere ?? 'Non spécifié' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="font-semibold {{ $note->valeur >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $note->valeur }}/20
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">{{ $note->date_evaluation->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $note->commentaire }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{-- MOYENNE --}}
                <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-700">Moyenne générale</p>
                            <p class="text-sm text-gray-600">Basée sur {{ $etudiant->notes->count() }} notes</p>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-bold text-blue-700">
                                {{ number_format($etudiant->notes->avg('valeur'), 2) }}/20
                            </p>
                            @php
                                $moyenne = $etudiant->notes->avg('valeur');
                                $appreciation = $moyenne >= 16 ? 'Très bien' : 
                                               ($moyenne >= 14 ? 'Bien' : 
                                               ($moyenne >= 12 ? 'Assez bien' : 
                                               ($moyenne >= 10 ? 'Passable' : 'Insuffisant')));
                            @endphp
                            <p class="text-sm font-medium text-gray-700">{{ $appreciation }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-chart-line text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Aucune note enregistrée pour cet étudiant</p>
                    <p class="text-sm text-gray-400 mt-2">Ajoutez des notes pour suivre sa progression</p>
                </div>
            @endif
        </div>
    </div>

    {{-- COLONNE DROITE : METADONNEES ET ACTIONS --}}
    <div class="lg:col-span-1">
        {{-- CARTE METADONNEES --}}
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-info-circle mr-2"></i>
                Métadonnées
            </h3>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                    <span class="text-gray-600">ID</span>
                    <span class="font-mono text-gray-800">{{ $etudiant->id }}</span>
                </div>
                
                <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                    <span class="text-gray-600">Date d'inscription</span>
                    <span class="font-medium">{{ $etudiant->created_at->format('d/m/Y') }}</span>
                </div>
                
                <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                    <span class="text-gray-600">Dernière modification</span>
                    <span class="font-medium">{{ $etudiant->updated_at->format('d/m/Y H:i') }}</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Code étudiant</span>
                    <span class="font-mono bg-gray-100 px-2 py-1 rounded text-sm">
                        {{ strtoupper(substr($etudiant->nom, 0, 3)) }}{{ strtoupper(substr($etudiant->prenom, 0, 2)) }}{{ $etudiant->id }}
                    </span>
                </div>
            </div>
        </div>

        {{-- CARTE ACTIONS RAPIDES --}}
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-bolt mr-2"></i>
                Actions rapides
            </h3>
            
            <div class="space-y-3">
                <a href="{{ route('etudiants.edit', $etudiant) }}"
                   class="flex items-center justify-between p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                    <div class="flex items-center">
                        <i class="fas fa-edit text-blue-600 mr-3"></i>
                        <span class="font-medium text-gray-800">Modifier</span>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </a>
                
                <button onclick="showDeleteModal()"
                        class="w-full flex items-center justify-between p-3 bg-red-50 hover:bg-red-100 rounded-lg transition">
                    <div class="flex items-center">
                        <i class="fas fa-trash text-red-600 mr-3"></i>
                        <span class="font-medium text-gray-800">Supprimer</span>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </button>
                
                <a href="mailto:{{ $etudiant->email }}"
                   class="flex items-center justify-between p-3 bg-green-50 hover:bg-green-100 rounded-lg transition">
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-green-600 mr-3"></i>
                        <span class="font-medium text-gray-800">Envoyer un email</span>
                    </div>
                    <i class="fas fa-external-link-alt text-gray-400"></i>
                </a>
                
                <a href="#"
                   class="flex items-center justify-between p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-purple-600 mr-3"></i>
                        <span class="font-medium text-gray-800">Générer un PDF</span>
                    </div>
                    <i class="fas fa-download text-gray-400"></i>
                </a>
            </div>
        </div>

        {{-- CARTE QR CODE --}}
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-qrcode mr-2"></i>
                Carte étudiante
            </h3>
            
            <div class="text-center">
                {{-- Placeholder pour QR code --}}
                <div class="bg-gray-100 p-8 rounded-lg inline-block mb-4">
                    <div class="text-center text-gray-400">
                        <i class="fas fa-qrcode text-5xl mb-2"></i>
                        <p class="text-sm">QR Code</p>
                    </div>
                </div>
                
                <p class="text-sm text-gray-600 mb-4">
                    Scannez pour accéder aux informations de l'étudiant
                </p>
                
                <div class="flex items-center justify-center space-x-4">
                    <button onclick="generateQRCode()"
                            class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-sync mr-1"></i>
                        Générer
                    </button>
                    <button onclick="downloadQRCode()"
                            class="text-sm text-green-600 hover:text-green-800 font-medium">
                        <i class="fas fa-download mr-1"></i>
                        Télécharger
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL DE SUPPRESSION --}}
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl p-8 max-w-md w-full">
        <div class="text-center mb-6">
            <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Confirmer la suppression</h3>
            <p class="text-gray-600">
                Êtes-vous sûr de vouloir supprimer l'étudiant 
                <span class="font-semibold">{{ $etudiant->prenom }} {{ $etudiant->nom }}</span> ?
                Cette action est irréversible.
            </p>
        </div>
        
        <div class="flex justify-center space-x-4">
            <form action="{{ route('etudiants.destroy', $etudiant) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition font-semibold">
                    Oui, supprimer
                </button>
            </form>
            
            <button onclick="hideDeleteModal()"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition font-semibold">
                Annuler
            </button>
        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
@push('scripts')
<script>
    // Modal de suppression
    function showDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }
    
    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
    
    // QR Code functions (placeholder)
    function generateQRCode() {
        alert('Génération du QR Code pour {{ $etudiant->prenom }} {{ $etudiant->nom }}');
        // Ici, vous pourriez implémenter une vraie génération de QR code
    }
    
    function downloadQRCode() {
        alert('Téléchargement du QR Code');
        // Ici, vous pourriez implémenter le téléchargement du QR code
    }
    
    // Fermer le modal en cliquant en dehors
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideDeleteModal();
        }
    });
    
    // Fermer le modal avec la touche Échap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideDeleteModal();
        }
    });
</script>
@endpush

<style>
    /* Animation pour le modal */
    #deleteModal {
        animation: fadeIn 0.3s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

@endsection