@extends('layouts.public')

@section('title', 'Notre Offre Scolaire - Collège & Lycée Ndindy School')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-blue-800 to-orange-600 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80" 
             alt="Élèves en classe" 
             class="w-full h-full object-cover opacity-20">
    </div>
    
    <div class="relative max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Notre Offre Scolaire
            </h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Découvrez notre programme pédagogique complet pour le collège et le lycée
            </p>
            
            <!-- Filtres -->
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <button class="filter-btn active" data-filter="all">Tous les niveaux</button>
                <button class="filter-btn" data-filter="college">Collège</button>
                <button class="filter-btn" data-filter="lycee">Lycée</button>
                <button class="filter-btn" data-filter="options">Options & Spécialités</button>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-white p-6 rounded-xl shadow text-center border-l-4 border-blue-500">
                <div class="text-3xl font-bold text-blue-600">98%</div>
                <div class="text-gray-700 font-medium">Taux de réussite au Bac 2023</div>
            </div>
            <div class="bg-gradient-to-br from-orange-50 to-white p-6 rounded-xl shadow text-center border-l-4 border-orange-500">
                <div class="text-3xl font-bold text-orange-600">96%</div>
                <div class="text-gray-700 font-medium">Mention au Brevet</div>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-white p-6 rounded-xl shadow text-center border-l-4 border-green-500">
                <div class="text-3xl font-bold text-green-600">15+</div>
                <div class="text-gray-700 font-medium">Options & Spécialités</div>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-white p-6 rounded-xl shadow text-center border-l-4 border-purple-500">
                <div class="text-3xl font-bold text-purple-600">100%</div>
                <div class="text-gray-700 font-medium">Poursuite d'études</div>
            </div>
        </div>
    </div>
</section>

<!-- Niveaux Scolaires -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">
            Nos Niveaux Scolaires
        </h2>
        
        <!-- Collège -->
        <div class="formation-card mb-12 bg-white rounded-2xl shadow-lg overflow-hidden" data-category="college">
            <div class="md:flex">
                <div class="md:w-2/5 bg-gradient-to-br from-blue-600 to-blue-800 p-8 text-white">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-school text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">Collège</h3>
                            <p class="text-blue-100">De la 6ème à la 3ème</p>
                        </div>
                    </div>
                    
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-green-300"></i>
                            <span>Programme de l'Éducation Nationale</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-green-300"></i>
                            <span>Accompagnement personnalisé</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-green-300"></i>
                            <span>Préparation au Brevet</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-green-300"></i>
                            <span>Options dès la 5ème</span>
                        </li>
                    </ul>
                </div>
                
                <div class="md:w-3/5 p-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Classes du Collège</h4>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 mb-2">6ème</div>
                            <p class="text-sm text-gray-600">Cycle d'adaptation</p>
                            <ul class="mt-2 text-sm text-gray-700">
                                <li>• Français, Maths, Histoire</li>
                                <li>• LV1 Anglais</li>
                                <li>• Sciences & Technologie</li>
                            </ul>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 mb-2">5ème</div>
                            <p class="text-sm text-gray-600">Cycle central</p>
                            <ul class="mt-2 text-sm text-gray-700">
                                <li>• Physique-Chimie</li>
                                <li>• Options LV2</li>
                                <li>• Latin (option)</li>
                            </ul>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 mb-2">4ème</div>
                            <p class="text-sm text-gray-600">Cycle central</p>
                            <ul class="mt-2 text-sm text-gray-700">
                                <li>• LV2 Espagnol/Allemand</li>
                                <li>• Éducation aux médias</li>
                                <li>• Orientation progressive</li>
                            </ul>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 mb-2">3ème</div>
                            <p class="text-sm text-gray-600">Cycle d'orientation</p>
                            <ul class="mt-2 text-sm text-gray-700">
                                <li>• Préparation Brevet</li>
                                <li>• Stage en entreprise</li>
                                <li>• Orientation active</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="{{ route('contact') }}?sujet=college" 
                           class="inline-flex items-center text-blue-600 font-medium hover:text-blue-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            En savoir plus sur le collège
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Lycée -->
        <div class="formation-card mb-12 bg-white rounded-2xl shadow-lg overflow-hidden" data-category="lycee">
            <div class="md:flex">
                <div class="md:w-2/5 bg-gradient-to-br from-orange-600 to-orange-800 p-8 text-white">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user-graduate text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">Lycée</h3>
                            <p class="text-orange-100">De la 2nde à la Terminale</p>
                        </div>
                    </div>
                    
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-green-300"></i>
                            <span>Préparation au Baccalauréat</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-green-300"></i>
                            <span>Spécialités scientifiques & littéraires</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-green-300"></i>
                            <span>Orientation Post-Bac</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-green-300"></i>
                            <span>Option Internationale (OIB)</span>
                        </li>
                    </ul>
                </div>
                
                <div class="md:w-3/5 p-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Classes du Lycée</h4>
                    
                    <div class="grid grid-cols-3 gap-6">
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-orange-600 mb-2">Seconde</div>
                            <p class="text-sm text-gray-600">Classe de détermination</p>
                            <ul class="mt-2 text-sm text-gray-700">
                                <li>• Tronc commun</li>
                                <li>• Options exploratoires</li>
                                <li>• Aide à l'orientation</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-orange-600 mb-2">Première</div>
                            <p class="text-sm text-gray-600">Spécialisation</p>
                            <ul class="mt-2 text-sm text-gray-700">
                                <li>• Bac Général</li>
                                <li>• 3 Spécialités</li>
                                <li>• Épreuves anticipées</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-orange-600 mb-2">Terminale</div>
                            <p class="text-sm text-gray-600">Préparation Bac</p>
                            <ul class="mt-2 text-sm text-gray-700">
                                <li>• 2 Spécialités</li>
                                <li>• Grand Oral</li>
                                <li>• Orientation Supérieur</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h5 class="font-bold text-gray-700 mb-3">Spécialités proposées :</h5>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Mathématiques</span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Physique-Chimie</span>
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">SVT</span>
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">SES</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Histoire-Géo</span>
                            <span class="px-3 py-1 bg-pink-100 text-pink-800 rounded-full text-sm">Humanités</span>
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">LLCE Anglais</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="{{ route('contact') }}?sujet=lycee" 
                           class="inline-flex items-center text-orange-600 font-medium hover:text-orange-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            En savoir plus sur le lycée
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Options & Spécialités -->
        <div class="formation-card bg-white rounded-2xl shadow-lg overflow-hidden" data-category="options">
            <div class="p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">
                    Options & Spécialités
                </h3>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-b from-blue-50 to-white rounded-xl p-6 border border-blue-200">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-globe-americas text-blue-600 text-xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-3">Section Internationale</h4>
                        <p class="text-gray-600 text-sm mb-4">
                            Option Bac avec mention internationale (OIB). Renforcement en anglais avec littérature anglo-saxonne.
                        </p>
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-clock mr-1"></i> 4h/semaine
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-b from-green-50 to-white rounded-xl p-6 border border-green-200">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-code text-green-600 text-xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-3">Numérique & Coding</h4>
                        <p class="text-gray-600 text-sm mb-4">
                            Initiation à la programmation, robotique éducative et culture numérique dès la 5ème.
                        </p>
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-clock mr-1"></i> 3h/semaine
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-b from-purple-50 to-white rounded-xl p-6 border border-purple-200">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-theater-masks text-purple-600 text-xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-3">Arts & Culture</h4>
                        <p class="text-gray-600 text-sm mb-4">
                            Théâtre, musique, arts plastiques. Préparation à l'option Arts du Baccalauréat.
                        </p>
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-clock mr-1"></i> 3h/semaine
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Langues Vivantes -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">
            Enseignement des Langues
        </h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-8 bg-gradient-to-b from-blue-50 to-white rounded-2xl shadow">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-6 rounded-full bg-gradient-to-r from-blue-100 to-blue-200">
                    <i class="fas fa-flag-usa text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Anglais</h3>
                <ul class="text-gray-600 space-y-2 text-left">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>LV1 dès la 6ème</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Section européenne</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Préparation Cambridge</span>
                    </li>
                </ul>
            </div>
            
            <div class="text-center p-8 bg-gradient-to-b from-red-50 to-white rounded-2xl shadow">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-6 rounded-full bg-gradient-to-r from-red-100 to-red-200">
                    <i class="fas fa-flag text-3xl text-red-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Espagnol</h3>
                <ul class="text-gray-600 space-y-2 text-left">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>LV2 dès la 5ème</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Échanges culturels</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>DELE préparatoire</span>
                    </li>
                </ul>
            </div>
            
            <div class="text-center p-8 bg-gradient-to-b from-yellow-50 to-white rounded-2xl shadow">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-6 rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200">
                    <i class="fas fa-language text-3xl text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Allemand & Latin</h3>
                <ul class="text-gray-600 space-y-2 text-left">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Allemand LV2 option</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Latin dès la 5ème</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Option au Bac</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Activités Périscolaires -->
<section class="py-16 bg-gradient-to-r from-blue-50 to-orange-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">
            Activités & Vie Scolaire
        </h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-futbol text-blue-600"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Sports</h4>
                <p class="text-gray-600 text-sm">Football, basket, natation, athlétisme, échecs</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-music text-green-600"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Culture</h4>
                <p class="text-gray-600 text-sm">Théâtre, chorale, orchestre, journal scolaire</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-flask text-purple-600"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Sciences</h4>
                <p class="text-gray-600 text-sm">Club robotique, olympiades, projets scientifiques</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-hands-helping text-orange-600"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Citoyenneté</h4>
                <p class="text-gray-600 text-sm">Conseil de vie, éco-école, actions solidaires</p>
            </div>
        </div>
    </div>
</section>

<!-- Témoignages -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-12 text-center">
            Témoignages de Parents & Élèves
        </h3>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-bold">Mme Diallo</p>
                        <p class="text-sm text-gray-500">Mère d'un élève de 3ème</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">
                    "L'accompagnement personnalisé en 3ème a permis à mon fils d'obtenir son Brevet avec mention Très Bien. Merci à toute l'équipe !"
                </p>
            </div>
            
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user-graduate text-orange-600"></i>
                    </div>
                    <div>
                        <p class="font-bold">Fatou Ndiaye</p>
                        <p class="text-sm text-gray-500">Ancienne élève, Terminale S</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">
                    "La préparation au Bac dans les spécialités scientifiques était excellente. J'ai intégré médecine grâce à cette solide formation."
                </p>
            </div>
            
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user-tie text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-bold">M. Sarr</p>
                        <p class="text-sm text-gray-500">Père d'une élève de 2nde</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">
                    "L'option internationale a vraiment développé le niveau d'anglais de ma fille. Les professeurs sont impliqués et passionnés."
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-6">Prêt à Rejoindre Ndindy School ?</h2>
        <p class="text-xl mb-8 opacity-90">
            Inscrivez votre enfant pour une scolarité épanouissante et réussie
        </p>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('inscription') }}" 
               class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-file-alt mr-2"></i>Pré-inscription en ligne
            </a>
            <a href="{{ route('contact') }}" 
               class="bg-white hover:bg-gray-100 text-blue-600 px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-calendar-alt mr-2"></i>Demander un rendez-vous
            </a>
            <a href="{{ route('visite') }}" 
               class="bg-transparent hover:bg-white hover:bg-opacity-20 border-2 border-white text-white px-8 py-3 rounded-lg font-semibold text-lg transition duration-300">
                <i class="fas fa-door-open mr-2"></i>Journées portes ouvertes
            </a>
        </div>
        
        <p class="text-sm opacity-80 mt-6">
            <i class="fas fa-phone-alt mr-1"></i>
            Pour toute question : +221 33 821 45 67 • 
            <i class="fas fa-envelope ml-4 mr-1"></i>
            info@ndindy.sn
        </p>
    </div>
</section>
@endsection

@push('styles')
<style>
    .formation-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .formation-card:hover {
        transform: translateY(-5px);
    }
    
    .filter-btn {
        @apply px-5 py-2 rounded-full text-white bg-white bg-opacity-20 hover:bg-opacity-30 transition font-medium;
    }
    
    .filter-btn.active {
        @apply bg-white bg-opacity-40 font-bold shadow-lg;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const formationCards = document.querySelectorAll('.formation-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Mettre à jour les boutons actifs
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.getAttribute('data-filter');
                
                // Filtrer les cartes
                formationCards.forEach(card => {
                    if (filter === 'all' || card.getAttribute('data-category') === filter) {
                        card.style.display = 'block';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Animation initiale
        formationCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.3s, transform 0.3s';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endpush