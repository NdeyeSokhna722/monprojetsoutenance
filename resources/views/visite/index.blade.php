@extends('layouts.public')

@section('title', 'Journées Portes Ouvertes - Collège & Lycée Ndindy School')

@section('content')
<div class="relative bg-gradient-to-r from-blue-900 to-blue-700 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0 bg-black"></div>
        <img src="https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80" 
             alt="Élèves en classe" 
             class="w-full h-full object-cover">
    </div>
    
    <div class="relative max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
            Journées Portes Ouvertes
        </h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto">
            Venez découvrir le Collège & Lycée Ndindy School et rencontrer notre équipe éducative
        </p>
        <div class="mt-8 inline-block bg-orange-500 text-white px-6 py-3 rounded-full font-bold text-lg">
            Prochaine date : Samedi 15 Mars 2024
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Informations principales -->
    <div class="grid md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="text-center mb-4">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <i class="fas fa-calendar-day text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Dates & Horaires</h3>
                <p class="text-gray-600">
                    Samedi 15 Mars 2024<br>
                    <span class="font-bold text-lg">9h00 - 17h00</span>
                </p>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="text-center mb-4">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 rounded-full mb-4">
                    <i class="fas fa-map-marker-alt text-3xl text-orange-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Lieu</h3>
                <p class="text-gray-600">
                    Collège & Lycée Ndindy School<br>
                    123 Avenue de l'Éducation, Dakar
                </p>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="text-center mb-4">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i class="fas fa-user-friends text-3xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Public</h3>
                <p class="text-gray-600">
                    Parents et élèves<br>
                    <span class="text-sm">(de la 6ème à la Terminale)</span>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Programme -->
    <div class="bg-gradient-to-r from-blue-50 to-orange-50 rounded-2xl p-8 mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Programme de la Journée</h2>
        
        <div class="space-y-6 max-w-4xl mx-auto">
            <div class="flex items-start bg-white rounded-xl p-6 shadow">
                <div class="flex-shrink-0 w-24 text-center">
                    <div class="text-2xl font-bold text-blue-600">9h00</div>
                    <div class="text-sm text-gray-500">Accueil</div>
                </div>
                <div class="ml-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Accueil café & présentation générale</h3>
                    <p class="text-gray-600">Mot de bienvenue par la direction et présentation de l'établissement</p>
                </div>
            </div>
            
            <div class="flex items-start bg-white rounded-xl p-6 shadow">
                <div class="flex-shrink-0 w-24 text-center">
                    <div class="text-2xl font-bold text-blue-600">10h00</div>
                    <div class="text-sm text-gray-500">Visites</div>
                </div>
                <div class="ml-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Visites guidées des installations</h3>
                    <p class="text-gray-600 mb-2">Découverte des salles de classe, laboratoires, CDI et installations sportives</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Groupes de 15 personnes</span>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Départs toutes les 30 min</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-start bg-white rounded-xl p-6 shadow">
                <div class="flex-shrink-0 w-24 text-center">
                    <div class="text-2xl font-bold text-blue-600">11h30</div>
                    <div class="text-sm text-gray-500">Rencontres</div>
                </div>
                <div class="ml-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Rencontre avec les professeurs</h3>
                    <p class="text-gray-600">Échanges avec l'équipe pédagogique par matière et par niveau</p>
                </div>
            </div>
            
            <div class="flex items-start bg-white rounded-xl p-6 shadow">
                <div class="flex-shrink-0 w-24 text-center">
                    <div class="text-2xl font-bold text-blue-600">13h00</div>
                    <div class="text-sm text-gray-500">Pause</div>
                </div>
                <div class="ml-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Buffet et échanges informels</h3>
                    <p class="text-gray-600">Rencontre avec des parents d'élèves actuels et anciens élèves</p>
                </div>
            </div>
            
            <div class="flex items-start bg-white rounded-xl p-6 shadow">
                <div class="flex-shrink-0 w-24 text-center">
                    <div class="text-2xl font-bold text-blue-600">14h30</div>
                    <div class="text-sm text-gray-500">Ateliers</div>
                </div>
                <div class="ml-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Ateliers thématiques</h3>
                    <ul class="text-gray-600 space-y-1">
                        <li>• Orientation et choix de spécialités en lycée</li>
                        <li>• Préparation aux examens (Brevet, Bac)</li>
                        <li>• Présentation des options internationales</li>
                        <li>• Vie scolaire et activités périscolaires</li>
                    </ul>
                </div>
            </div>
            
            <div class="flex items-start bg-white rounded-xl p-6 shadow">
                <div class="flex-shrink-0 w-24 text-center">
                    <div class="text-2xl font-bold text-blue-600">16h00</div>
                    <div class="text-sm text-gray-500">Questions</div>
                </div>
                <div class="ml-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Session questions-réponses avec la direction</h3>
                    <p class="text-gray-600">Réponses à toutes vos questions sur l'inscription, les frais scolaires, etc.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Formulaire d'inscription -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Inscription à la Journée Portes Ouvertes</h2>
        <p class="text-gray-600 text-center mb-8 max-w-2xl mx-auto">
            Pour nous aider à mieux vous accueillir, merci de vous inscrire à l'avance.
            L'inscription est gratuite mais obligatoire.
        </p>
        
        <form class="max-w-2xl mx-auto space-y-6">
            @csrf
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="visiteur_nom" class="block text-sm font-medium text-gray-700 mb-1">
                        Nom *
                    </label>
                    <input type="text" id="visiteur_nom" name="visiteur_nom" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="visiteur_prenom" class="block text-sm font-medium text-gray-700 mb-1">
                        Prénom *
                    </label>
                    <input type="text" id="visiteur_prenom" name="visiteur_prenom" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
            </div>
            
            <div>
                <label for="visiteur_email" class="block text-sm font-medium text-gray-700 mb-1">
                    Email *
                </label>
                <input type="email" id="visiteur_email" name="visiteur_email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            </div>
            
            <div>
                <label for="visiteur_telephone" class="block text-sm font-medium text-gray-700 mb-1">
                    Téléphone *
                </label>
                <input type="tel" id="visiteur_telephone" name="visiteur_telephone" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            </div>
            
            <div>
                <label for="nombre_personnes" class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre de personnes *
                </label>
                <select id="nombre_personnes" name="nombre_personnes" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Sélectionnez...</option>
                    <option value="1">1 personne</option>
                    <option value="2">2 personnes</option>
                    <option value="3">3 personnes</option>
                    <option value="4">4 personnes</option>
                    <option value="5">5 personnes ou plus</option>
                </select>
            </div>
            
            <div>
                <label for="interet_niveau" class="block text-sm font-medium text-gray-700 mb-1">
                    Niveau qui vous intéresse *
                </label>
                <select id="interet_niveau" name="interet_niveau" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Sélectionnez un niveau</option>
                    <option value="college">Collège (6ème - 3ème)</option>
                    <option value="lycee">Lycée (2nde - Terminale)</option>
                    <option value="les_deux">Les deux</option>
                    <option value="autre">Autre</option>
                </select>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" id="newsletter" name="newsletter"
                       class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                <label for="newsletter" class="ml-2 block text-sm text-gray-700">
                    Je souhaite recevoir les actualités de Ndindy School
                </label>
            </div>
            
            <div class="text-center pt-4">
                <button type="submit"
                        class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
                    M'inscrire à la journée portes ouvertes
                </button>
                <p class="text-gray-500 text-sm mt-3">
                    Vous recevrez un email de confirmation avec tous les détails.
                </p>
            </div>
        </form>
    </div>
    
    <!-- Accès et informations pratiques -->
    <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-gray-50 rounded-xl p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-car mr-2 text-blue-600"></i>
                Accès et stationnement
            </h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start">
                    <i class="fas fa-bus mt-1 mr-2 text-blue-500"></i>
                    <span>Bus : lignes 12, 23, 45 - Arrêt "École Ndindy"</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-subway mt-1 mr-2 text-green-500"></i>
                    <span>Métro : station "Université" (à 10 min à pied)</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-parking mt-1 mr-2 text-orange-500"></i>
                    <span>Parking gratuit disponible sur place</span>
                </li>
            </ul>
        </div>
        
        <div class="bg-gray-50 rounded-xl p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-question-circle mr-2 text-green-600"></i>
                Questions fréquentes
            </h3>
            <div class="space-y-4">
                <div>
                    <p class="font-semibold text-gray-700">Dois-je amener mon enfant ?</p>
                    <p class="text-gray-600 text-sm">Oui, nous encourageons les enfants à venir découvrir leur futur établissement.</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Faut-il apporter des documents ?</p>
                    <p class="text-gray-600 text-sm">Non, la journée portes ouvertes est une visite découverte. Les dossiers d'inscription seront distribués sur place.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection