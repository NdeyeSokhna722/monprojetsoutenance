@extends('layouts.public')

@section('title', 'Confirmation de Pré-inscription - Ndindy School')

@section('content')
<div class="bg-gradient-to-r from-blue-800 to-green-600 text-white py-12 rounded-b-3xl shadow-xl mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            <i class="fas fa-check-circle mr-3"></i>
            Pré-inscription Confirmée !
        </h1>
        <p class="text-xl opacity-90">
            Votre demande de pré-inscription a été enregistrée avec succès.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10">
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-4xl text-green-600"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Félicitations, votre dossier a été créé !
            </h2>
            <p class="text-gray-600">
                Nous avons bien reçu votre demande de pré-inscription.
            </p>
        </div>

        {{-- CARTE D'INFORMATION --}}
        <div class="bg-blue-50 rounded-xl p-6 mb-8 border border-blue-200">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-blue-100 rounded-lg mr-4">
                    <i class="fas fa-file-alt text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Numéro de dossier</h3>
                    <p class="text-sm text-gray-600">Conservez ce numéro pour tout suivi</p>
                </div>
            </div>
            <div class="text-center">
                <div class="inline-block bg-white px-8 py-4 rounded-lg border-2 border-blue-300 shadow-sm">
                    <span class="text-3xl font-bold text-blue-800 tracking-wider">
                        {{ $numero_dossier ?? 'PRE-' . date('Y') . '-0000' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- ÉTAPES SUIVANTES --}}
        <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-list-check mr-3 text-orange-600"></i>
                Prochaines étapes
            </h3>
            
            <div class="space-y-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-blue-600 font-bold">1</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-800">Contact sous 48 heures</h4>
                        <p class="text-gray-600 text-sm mt-1">
                            Notre équipe d'admission vous contactera par téléphone ou email dans les 48 heures pour fixer un rendez-vous.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                            <span class="text-orange-600 font-bold">2</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-800">Entretien de sélection</h4>
                        <p class="text-gray-600 text-sm mt-1">
                            Un entretien avec la direction sera organisé pour évaluer la compatibilité avec notre projet pédagogique.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="text-green-600 font-bold">3</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-800">Réponse définitive</h4>
                        <p class="text-gray-600 text-sm mt-1">
                            Vous recevrez une réponse définitive sous 5 jours ouvrés après l'entretien.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- DOCUMENTS À PRÉPARER --}}
        <div class="bg-orange-50 rounded-xl p-6 mb-8 border border-orange-200">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-file-alt mr-3 text-orange-600"></i>
                Documents à préparer
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center">
                    <i class="fas fa-file-pdf text-red-500 mr-3"></i>
                    <span>Copie de l'acte de naissance</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-id-card text-blue-500 mr-3"></i>
                    <span>Photo d'identité récente</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-green-500 mr-3"></i>
                    <span>Bulletins des 2 dernières années</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-certificate text-purple-500 mr-3"></i>
                    <span>Certificat de scolarité</span>
                </div>
            </div>
        </div>

        {{-- CONTACT --}}
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Besoin d'aide ?</h3>
            <p class="text-gray-600 mb-4">
                Si vous avez des questions concernant votre pré-inscription, n'hésitez pas à nous contacter :
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="tel:+221338214567" 
                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                    <i class="fas fa-phone mr-2"></i>
                    Appeler : +221 33 821 45 67
                </a>
                <a href="mailto:inscriptions@ndindy.sn" 
                   class="flex-1 bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                    <i class="fas fa-envelope mr-2"></i>
                    Écrire un email
                </a>
            </div>
        </div>

        {{-- BOUTONS D'ACTION --}}
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('home') }}" 
                   class="flex-1 bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 
                          text-white font-semibold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                    <i class="fas fa-home mr-2"></i>
                    Retour à l'accueil
                </a>
                
                <a href="{{ route('preinscription.create') }}" 
                   class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 
                          font-semibold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>
                    Nouvelle pré-inscription
                </a>
            </div>
            
            <div class="text-center mt-6">
                <a href="{{ route('contact') }}" 
                   class="text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Accéder au formulaire de contact complet
                </a>
            </div>
        </div>
    </div>
</div>
@endsection