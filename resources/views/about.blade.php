@extends('layouts.public')

@section('title', 'À Propos - Collège & Lycée Ndindy School')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-blue-800 to-orange-600 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80" 
             alt="Élèves du collège" 
             class="w-full h-full object-cover opacity-20">
    </div>
    
    <div class="relative max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Collège & Lycée <span class="text-orange-300">Ndindy School</span>
            </h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Depuis 15 ans, nous accompagnons les élèves de la 6ème à la Terminale 
                vers l'excellence scolaire et l'épanouissement personnel.
            </p>
        </div>
    </div>
</div>

<!-- Notre Histoire -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-6">
                    <span class="border-b-4 border-orange-500 pb-2">Notre Histoire</span>
                </h2>
                <div class="space-y-4 text-gray-600">
                    <p class="text-lg">
                        Fondé en <span class="font-bold text-orange-600">2009</span>, le Collège & Lycée Ndindy School 
                        a été créé avec une vision claire : offrir un enseignement de qualité 
                        adapté aux besoins des élèves du secondaire.
                    </p>
                    <p class="text-lg">
                        Sous la direction de <span class="font-semibold">Monsieur Abdoulaye Ndiaye</span>, 
                        ancien inspecteur d'académie, notre établissement a su construire 
                        une réputation d'excellence dans l'accompagnement des élèves vers le brevet et le baccalauréat.
                    </p>
                    <div class="bg-orange-50 p-6 rounded-xl border-l-4 border-orange-500 mt-6">
                        <p class="font-semibold text-orange-700">
                            "Notre mission : former des citoyens éclairés, responsables et préparés 
                            aux défis de demain, tout en transmettant les valeurs de respect, 
                            d'excellence et de persévérance."
                        </p>
                        <p class="text-sm text-gray-600 mt-2">— M. Abdoulaye Ndiaye, Fondateur</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="bg-gradient-to-br from-blue-50 to-orange-50 rounded-2xl p-8 shadow-xl">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
                            <div class="text-4xl font-bold text-orange-600">2009</div>
                            <div class="text-gray-600">Année de fondation</div>
                        </div>
                        <div class="text-center p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
                            <div class="text-4xl font-bold text-orange-600">98%</div>
                            <div class="text-gray-600">Taux de réussite au Bac 2023</div>
                        </div>
                        <div class="text-center p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
                            <div class="text-4xl font-bold text-orange-600">15+</div>
                            <div class="text-gray-600">Années d'expérience</div>
                        </div>
                        <div class="text-center p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
                            <div class="text-4xl font-bold text-orange-600">96%</div>
                            <div class="text-gray-600">Taux de mention au Brevet</div>
                        </div>
                    </div>
                    <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-users text-2xl text-blue-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">
                                    <span class="font-bold">850 élèves</span> répartis du collège au lycée
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nos Cycles -->
<section class="py-16 bg-gradient-to-r from-blue-50 to-orange-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Nos Cycles d'Enseignement</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Un accompagnement adapté à chaque niveau scolaire
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-blue-500">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-school text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold text-center mb-4">Collège</h3>
                <p class="text-gray-600 text-center mb-4">
                    De la 6ème à la 3ème, nous construisons les bases solides 
                    nécessaires à la réussite scolaire.
                </p>
                <div class="text-center">
                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                        Classes : 6ème → 3ème
                    </span>
                </div>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-orange-500">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-user-graduate text-2xl text-orange-600"></i>
                </div>
                <h3 class="text-xl font-bold text-center mb-4">Lycée Général</h3>
                <p class="text-gray-600 text-center mb-4">
                    Seconde, Première et Terminale avec spécialités scientifiques, 
                    économiques et littéraires.
                </p>
                <div class="text-center">
                    <span class="inline-block bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">
                        BAC Général
                    </span>
                </div>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-green-500">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-chart-line text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-bold text-center mb-4">Option Internationale</h3>
                <p class="text-gray-600 text-center mb-4">
                    Section anglophone et parcours renforcé en langues étrangères 
                    pour une ouverture internationale.
                </p>
                <div class="text-center">
                    <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                        BAC avec OIB
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nos Valeurs -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Nos Valeurs Éducatives</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Les principes qui guident notre projet pédagogique
            </p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-6">
            <div class="text-center p-6 bg-gradient-to-b from-blue-50 to-white rounded-xl hover:shadow-md transition">
                <div class="inline-flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-blue-100">
                    <i class="fas fa-medal text-blue-600"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Excellence</h3>
                <p class="text-gray-600 text-sm">
                    Viser la meilleure version de soi-même dans le travail et le comportement
                </p>
            </div>
            
            <div class="text-center p-6 bg-gradient-to-b from-orange-50 to-white rounded-xl hover:shadow-md transition">
                <div class="inline-flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-orange-100">
                    <i class="fas fa-hands-helping text-orange-600"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Respect</h3>
                <p class="text-gray-600 text-sm">
                    Respect de soi, des autres, des règles et de l'environnement
                </p>
            </div>
            
            <div class="text-center p-6 bg-gradient-to-b from-green-50 to-white rounded-xl hover:shadow-md transition">
                <div class="inline-flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-green-100">
                    <i class="fas fa-lightbulb text-green-600"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Persévérance</h3>
                <p class="text-gray-600 text-sm">
                    Apprendre à surmonter les difficultés et à aller au bout de ses efforts
                </p>
            </div>
            
            <div class="text-center p-6 bg-gradient-to-b from-purple-50 to-white rounded-xl hover:shadow-md transition">
                <div class="inline-flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-purple-100">
                    <i class="fas fa-heart text-purple-600"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Bienveillance</h3>
                <p class="text-gray-600 text-sm">
                    Un climat scolaire positif et un accompagnement personnalisé de chaque élève
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Équipe Pédagogique -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">
            Notre Équipe Éducative
        </h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="h-48 bg-gradient-to-r from-blue-600 to-blue-800 flex items-center justify-center">
                    <i class="fas fa-user-tie text-6xl text-white opacity-80"></i>
                </div>
                <div class="p-6 text-center">
                    <h4 class="font-bold text-xl mb-1">M. Abdoulaye Ndiaye</h4>
                    <p class="text-orange-600 mb-3">Proviseur</p>
                    <p class="text-gray-600 text-sm">
                        Ancien inspecteur d'académie, 25 ans d'expérience dans l'éducation
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="h-48 bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-6xl text-white opacity-80"></i>
                </div>
                <div class="p-6 text-center">
                    <h4 class="font-bold text-xl mb-1">Mme Aminata Diallo</h4>
                    <p class="text-orange-600 mb-3">Directrice des Études Collège</p>
                    <p class="text-gray-600 text-sm">
                        Professeure de Mathématiques, spécialiste de la pédagogie différenciée
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="h-48 bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center">
                    <i class="fas fa-user-graduate text-6xl text-white opacity-80"></i>
                </div>
                <div class="p-6 text-center">
                    <h4 class="font-bold text-xl mb-1">M. Mamadou Sarr</h4>
                    <p class="text-orange-600 mb-3">Directeur des Études Lycée</p>
                    <p class="text-gray-600 text-sm">
                        Professeur de Philosophie, coordinateur des préparations au BAC
                    </p>
                </div>
            </div>
        </div>
        
        <div class="mt-12 text-center">
            <p class="text-gray-600 mb-4">
                <span class="font-bold">40 professeurs qualifiés</span> dont 75% certifiés ou agrégés
            </p>
            <div class="flex flex-wrap justify-center gap-2">
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">8 Conseillers d'éducation</span>
                <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm">2 Infirmières scolaires</span>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">1 Psychologue</span>
                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">3 Documentalistes</span>
            </div>
        </div>
    </div>
</section>

<!-- Installations & Activités -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">
            Nos Installations & Activités
        </h2>
        
        <div class="grid md:grid-cols-2 gap-12">
            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Infrastructures Modernes</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-flask text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Laboratoires équipés</h4>
                            <p class="text-gray-600 text-sm">Sciences physiques, SVT et technologie</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-laptop text-orange-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Salle informatique</h4>
                            <p class="text-gray-600 text-sm">30 postes connectés, vidéoprojecteurs interactifs</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-book text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">CDI numérique</h4>
                            <p class="text-gray-600 text-sm">Centre de documentation et d'information</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-futbol text-purple-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Installations sportives</h4>
                            <p class="text-gray-600 text-sm">Gymnase, terrain de football et basket</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Vie Scolaire & Activités</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-music text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Clubs & Ateliers</h4>
                            <p class="text-gray-600 text-sm">Théâtre, musique, échecs, journal scolaire</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-globe-africa text-orange-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Sorties éducatives</h4>
                            <p class="text-gray-600 text-sm">Visites culturelles, musées, voyages scolaires</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-handshake text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Accompagnement</h4>
                            <p class="text-gray-600 text-sm">Soutien scolaire, orientation, préparation aux examens</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-star text-purple-600"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Concours & Olympiades</h4>
                            <p class="text-gray-600 text-sm">Participation aux compétitions académiques</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reconnaissances -->
<section class="py-16 bg-gradient-to-r from-blue-800 to-blue-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-6">Nos Reconnaissances</h2>
            <p class="text-xl mb-12 max-w-3xl mx-auto">
                Un établissement reconnu pour la qualité de son enseignement
            </p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-sm hover:bg-opacity-20 transition">
                    <i class="fas fa-award text-4xl mb-4 text-orange-300"></i>
                    <p class="font-bold">Label Établissement Numérique</p>
                    <p class="text-sm opacity-80 mt-2">Niveau 3</p>
                </div>
                <div class="bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-sm hover:bg-opacity-20 transition">
                    <i class="fas fa-leaf text-4xl mb-4 text-green-300"></i>
                    <p class="font-bold">Éco-École</p>
                    <p class="text-sm opacity-80 mt-2">Label développement durable</p>
                </div>
                <div class="bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-sm hover:bg-opacity-20 transition">
                    <i class="fas fa-graduation-cap text-4xl mb-4 text-yellow-300"></i>
                    <p class="font-bold">Meilleurs Résultats</p>
                    <p class="text-sm opacity-80 mt-2">Académie de Dakar</p>
                </div>
                <div class="bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-sm hover:bg-opacity-20 transition">
                    <i class="fas fa-handshake text-4xl mb-4 text-blue-300"></i>
                    <p class="font-bold">Partenariats</p>
                    <p class="text-sm opacity-80 mt-2">Établissements internationaux</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Inscription -->
<section class="py-16 bg-gradient-to-r from-orange-50 to-blue-50">
    <div class="max-w-4xl mx-auto text-center px-4">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Intéressé par Notre Établissement ?</h2>
            <p class="text-xl text-gray-600 mb-8">
                Rejoignez le Collège & Lycée Ndindy School pour une scolarité épanouissante et réussie
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('contact') }}" 
                   class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-phone-alt mr-2"></i>Nous contacter
                </a>
                <a href="{{ route('inscription') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-file-alt mr-2"></i>Pré-inscription en ligne
                </a>
                <a href="{{ route('visite') }}" 
                   class="bg-white hover:bg-gray-50 text-blue-600 border border-blue-600 px-8 py-3 rounded-lg font-semibold text-lg transition duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-calendar-alt mr-2"></i>Journée portes ouvertes
                </a>
            </div>
            <p class="text-gray-500 text-sm mt-6">
                <i class="fas fa-info-circle mr-1"></i>
                Rentrée scolaire : septembre 2024 - Inscriptions ouvertes
            </p>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush