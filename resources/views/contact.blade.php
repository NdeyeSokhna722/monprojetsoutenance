@extends('layouts.public')

@section('title', 'Contact - Collège & Lycée Ndindy School')

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
                Contactez-Nous
            </h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Notre équipe est à votre disposition pour répondre à vos questions sur l'inscription, 
                nos formations et la vie scolaire au collège et lycée
            </p>
        </div>
    </div>
</div>

<!-- Contact Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            
            <!-- Informations de contact -->
            <div class="lg:col-span-1">
                <h2 class="text-2xl font-bold text-gray-800 mb-8">Nos Coordonnées</h2>
                
                <div class="space-y-8">
                    <!-- Adresse -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-xl text-blue-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">Notre Adresse</h3>
                            <p class="text-gray-600 mt-1">
                                Rue de l'Éducation, BP 15000<br>
                                Ndindy, Diourbel - Sénégal
                            </p>
                            <a href="https://maps.google.com/?q=14.716677,-17.467686" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-2 inline-block">
                                <i class="fas fa-directions mr-1"></i> Voir sur Google Maps
                            </a>
                        </div>
                    </div>
                    
                    <!-- Téléphones -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-phone text-xl text-green-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">Téléphones</h3>
                            <div class="mt-2 space-y-2">
                                <div>
                                    <p class="text-gray-600 font-medium">Secrétariat / Inscriptions</p>
                                    <a href="tel:+221338214567" class="text-gray-800 hover:text-blue-600 font-medium">
                                        +221 33 821 45 67
                                    </a>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-medium">Vie Scolaire</p>
                                    <a href="tel:+221338214568" class="text-gray-800 hover:text-blue-600 font-medium">
                                        +221 33 821 45 68
                                    </a>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-medium">Direction</p>
                                    <a href="tel:+221338214569" class="text-gray-800 hover:text-blue-600 font-medium">
                                        +221 33 821 45 69
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-xl text-orange-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">Email</h3>
                            <div class="mt-2 space-y-2">
                                <div>
                                    <p class="text-gray-600 font-medium">Informations générales</p>
                                    <a href="mailto:info@ndindy.sn" class="text-gray-800 hover:text-blue-600 font-medium">
                                        info@ndindy.sn
                                    </a>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-medium">Inscriptions</p>
                                    <a href="mailto:inscription@ndindy.sn" class="text-gray-800 hover:text-blue-600 font-medium">
                                        inscription@ndindy.sn
                                    </a>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-medium">Vie scolaire</p>
                                    <a href="mailto:viescolaire@ndindy.sn" class="text-gray-800 hover:text-blue-600 font-medium">
                                        viescolaire@ndindy.sn
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Horaires -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-clock text-xl text-purple-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">Horaires d'accueil</h3>
                            <div class="mt-2">
                                <div class="flex justify-between py-2 border-b">
                                    <span class="text-gray-600">Lundi - Jeudi</span>
                                    <span class="font-medium">7h30 - 17h30</span>
                                </div>
                                <div class="flex justify-between py-2 border-b">
                                    <span class="text-gray-600">Vendredi</span>
                                    <span class="font-medium">7h30 - 13h00</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="text-gray-600">Samedi</span>
                                    <span class="font-medium">8h00 - 12h00</span>
                                </div>
                                <div class="flex justify-between py-2 mt-2">
                                    <span class="text-gray-600">Dimanche</span>
                                    <span class="font-medium text-red-500">Fermé</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-3">
                                <i class="fas fa-info-circle mr-1"></i>
                                Accueil téléphonique jusqu'à 17h00
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Réseaux sociaux -->
                <div class="mt-10 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Suivez-nous</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Restez informés des actualités de l'établissement
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://facebook.com/ndindyschool" target="_blank" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center text-white transition transform hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://instagram.com/ndindyschool" target="_blank" class="w-10 h-10 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 rounded-full flex items-center justify-center text-white transition transform hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://linkedin.com/school/ndindyschool" target="_blank" class="w-10 h-10 bg-blue-700 hover:bg-blue-800 rounded-full flex items-center justify-center text-white transition transform hover:scale-110">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://youtube.com/ndindyschool" target="_blank" class="w-10 h-10 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center text-white transition transform hover:scale-110">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Formulaire de contact -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-orange-600 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-comments text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Envoyez-nous un message</h2>
                            <p class="text-gray-600">
                                Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais
                            </p>
                        </div>
                    </div>
                    
                                <form id="contactForm" class="space-y-6" action="/contact" method="POST">
                        @csrf
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Prénom -->
                            <div>
                                <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">
                                    Prénom *
                                </label>
                                <input type="text" 
                                       id="prenom" 
                                       name="prenom"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                            
                            <!-- Nom -->
                            <div>
                                <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nom *
                                </label>
                                <input type="text" 
                                       id="nom" 
                                       name="nom"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email *
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        
                        <!-- Téléphone -->
                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone *
                            </label>
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-3 py-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        +221
                                    </span>
                                </div>
                                <input type="tel" 
                                       id="telephone" 
                                       name="telephone"
                                       required
                                       pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"
                                       placeholder="33 821 45 67"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-r-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Format : 33 821 45 67 (sans espaces)</p>
                        </div>
                        
                        <!-- Sujet -->
                        <div>
                            <label for="sujet" class="block text-sm font-medium text-gray-700 mb-2">
                                Sujet de votre demande *
                            </label>
                            <select id="sujet" 
                                    name="sujet"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Sélectionnez un sujet</option>
                                <option value="inscription">Demande d'inscription</option>
                                <option value="college">Informations sur le collège</option>
                                <option value="lycee">Informations sur le lycée</option>
                                <option value="rendezvous">Demande de rendez-vous</option>
                                <option value="portesouvertes">Journées portes ouvertes</option>
                                <option value="frais">Informations sur les frais de scolarité</option>
                                <option value="transport">Transport scolaire</option>
                                <option value="cantine">Service de cantine</option>
                                <option value="autre">Autre demande</option>
                            </select>
                        </div>
                        
                        <!-- Niveau concerné -->
                        <div>
                            <label for="niveau" class="block text-sm font-medium text-gray-700 mb-2">
                                Niveau scolaire concerné
                            </label>
                            <select id="niveau" 
                                    name="niveau"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Sélectionnez un niveau</option>
                                <optgroup label="Collège">
                                    <option value="6eme">6ème</option>
                                    <option value="5eme">5ème</option>
                                    <option value="4eme">4ème</option>
                                    <option value="3eme">3ème</option>
                                </optgroup>
                                <optgroup label="Lycée">
                                    <option value="2nde">Seconde</option>
                                    <option value="1ere">Première</option>
                                    <option value="terminale">Terminale</option>
                                </optgroup>
                                <option value="autre">Non applicable</option>
                            </select>
                        </div>
                        
                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                Votre message *
                            </label>
                            <textarea id="message" 
                                      name="message"
                                      rows="6"
                                      required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                      placeholder="Décrivez votre demande en détail..."></textarea>
                        </div>
                        
                        <!-- Checkbox RGPD -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="rgpd" 
                                       name="rgpd"
                                       type="checkbox"
                                       required
                                       class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="rgpd" class="text-gray-700">
                                    J'accepte que mes données personnelles soient traitées conformément à la 
                                    <a href="{{ route('confidentialite') }}" class="text-blue-600 hover:text-blue-800">politique de confidentialité</a>. *
                                </label>
                            </div>
                        </div>
                        
                        <!-- Bouton d'envoi -->
                        <div>
                            <button type="submit" 
                                    id="submitBtn"
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center shadow-lg hover:shadow-xl">
                                <span id="submitText">Envoyer le message</span>
                                <svg id="loadingSpinner" class="hidden w-5 h-5 ml-2 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Message de confirmation (caché par défaut) -->
                        <div id="successMessage" class="hidden p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                                <div>
                                    <p class="font-medium text-green-800">Message envoyé avec succès !</p>
                                    <p class="text-green-700 text-sm mt-1">
                                        Nous vous répondrons dans les 24-48 heures.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Message d'erreur (caché par défaut) -->
                        <div id="errorMessage" class="hidden p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                                <div>
                                    <p class="font-medium text-red-800">Une erreur est survenue</p>
                                    <p class="text-red-700 text-sm mt-1" id="errorMessageText">
                                        Veuillez réessayer ou nous contacter par téléphone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- FAQ / Questions fréquentes -->
                <div class="mt-12">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Questions Fréquentes</h3>
                    <div class="space-y-4">
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:border-blue-300 transition">
                            <button class="faq-question w-full px-6 py-4 text-left flex justify-between items-center hover:bg-blue-50 transition">
                                <span class="font-medium text-gray-800">
                                    Quels sont les délais d'inscription pour la rentrée ?
                                </span>
                                <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                            </button>
                            <div class="faq-answer px-6 py-4 border-t border-gray-200 hidden">
                                <p class="text-gray-600">
                                    Les inscriptions pour la rentrée de septembre ouvrent en janvier et se clôturent fin juillet. 
                                    Nous acceptons également les inscriptions en cours d'année dans la limite des places disponibles.
                                </p>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:border-blue-300 transition">
                            <button class="faq-question w-full px-6 py-4 text-left flex justify-between items-center hover:bg-blue-50 transition">
                                <span class="font-medium text-gray-800">
                                    Proposez-vous une visite de l'établissement ?
                                </span>
                                <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                            </button>
                            <div class="faq-answer px-6 py-4 border-t border-gray-200 hidden">
                                <p class="text-gray-600">
                                    Oui, nous organisons des journées portes ouvertes tous les mois de janvier à juin. 
                                    Vous pouvez également prendre rendez-vous pour une visite personnalisée avec la direction.
                                </p>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:border-blue-300 transition">
                            <button class="faq-question w-full px-6 py-4 text-left flex justify-between items-center hover:bg-blue-50 transition">
                                <span class="font-medium text-gray-800">
                                    Quelles sont les options de transport scolaire ?
                                </span>
                                <i class="fas fa-chevron-down text-blue-600 transition-transform"></i>
                            </button>
                            <div class="faq-answer px-6 py-4 border-t border-gray-200 hidden">
                                <p class="text-gray-600">
                                    Nous proposons un service de transport scolaire avec plusieurs circuits couvrant Dakar et ses environs. 
                                    Les tarifs et trajets sont disponibles au secrétariat.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 text-center">
                        <a href="{{ route('faq') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            <i class="fas fa-question-circle mr-2"></i>
                            Voir toutes les questions fréquentes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Carte et Accès -->
<section class="py-16 bg-gradient-to-b from-blue-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Comment nous trouver</h2>
        
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Carte (placeholder pour Google Maps) -->
            <div class="h-80 bg-gradient-to-br from-blue-100 to-orange-100 flex items-center justify-center relative">
                <!-- Points d'intérêt sur la carte -->
                <div class="absolute top-1/4 left-1/4">
                    <div class="w-6 h-6 bg-blue-600 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-white text-xs"></i>
                    </div>
                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 bg-white px-3 py-1 rounded-lg shadow text-sm font-medium whitespace-nowrap">
                        Ndindy School
                    </div>
                </div>
                
                <!-- Légende -->
                <div class="absolute bottom-4 left-4 bg-white p-4 rounded-lg shadow">
                    <h4 class="font-semibold text-gray-800 mb-2">Notre Emplacement</h4>
                    <p class="text-gray-600 text-sm">Rue de l'Éducation, BP 15000</p>
                    <p class="text-gray-600 text-sm">Ndindy, Diourbel - Sénégal</p>
                </div>
                
                <!-- Bouton itinéraire -->
                <a href="https://maps.google.com/?q=14.716677,-17.467686" target="_blank" class="absolute bottom-4 right-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow flex items-center transition">
                    <i class="fas fa-directions mr-2"></i>
                    Itinéraire
                </a>
            </div>
            
            <!-- Transport -->
            <div class="grid md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-200">
                <div class="p-6 text-center">
                    <i class="fas fa-bus text-3xl text-green-600 mb-3"></i>
                    <h4 class="font-semibold text-gray-800">Bus</h4>
                    <p class="text-gray-600 text-sm mt-2">Lignes 10, 14, 22</p>
                    <p class="text-gray-600 text-sm">Arrêt "École Ndindy"</p>
                </div>
                <div class="p-6 text-center">
                    <i class="fas fa-car text-3xl text-blue-600 mb-3"></i>
                    <h4 class="font-semibold text-gray-800">Voiture</h4>
                    <p class="text-gray-600 text-sm mt-2">Parking sécurisé</p>
                    <p class="text-gray-600 text-sm">50 places disponibles</p>
                </div>
                <div class="p-6 text-center">
                    <i class="fas fa-user-friends text-3xl text-orange-600 mb-3"></i>
                    <h4 class="font-semibold text-gray-800">Covoiturage</h4>
                    <p class="text-gray-600 text-sm mt-2">Zone de dépose-minute</p>
                    <p class="text-gray-600 text-sm">Accès facile</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact d'urgence -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-orange-600 to-orange-700 rounded-2xl p-8 md:p-10 text-white text-center">
            <div class="max-w-3xl mx-auto">
                <h3 class="text-2xl font-bold mb-4">Contacts d'Urgence</h3>
                <p class="text-lg mb-6">
                    Pour les situations urgentes concernant la sécurité ou la santé d'un élève
                </p>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white bg-opacity-10 rounded-xl p-6">
                        <i class="fas fa-shield-alt text-3xl mb-4"></i>
                        <h4 class="font-bold text-xl mb-2">Sécurité École</h4>
                        <p class="text-orange-100 mb-4">Gardien / Surveillant</p>
                        <a href="tel:+221338214570" class="text-2xl font-bold hover:text-white transition block">+221 33 821 45 70</a>
                    </div>
                    <div class="bg-white bg-opacity-10 rounded-xl p-6">
                        <i class="fas fa-first-aid text-3xl mb-4"></i>
                        <h4 class="font-bold text-xl mb-2">Infirmerie</h4>
                        <p class="text-orange-100 mb-4">Pendant les heures scolaires</p>
                        <a href="tel:+221338214571" class="text-2xl font-bold hover:text-white transition block">+221 33 821 45 71</a>
                    </div>
                </div>
                <p class="text-sm opacity-80 mt-8">
                    <i class="fas fa-info-circle mr-1"></i>
                    Pour les urgences médicales graves, composez le 15 (SAMU) ou le 18 (Pompiers)
                </p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .faq-question.active i {
        transform: rotate(180deg);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // FAQ Accordéon
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const icon = this.querySelector('i');
                
                // Toggle active class
                this.classList.toggle('active');
                
                // Toggle icon rotation
                icon.classList.toggle('rotate-180');
                
                // Toggle answer visibility
                if (answer.style.maxHeight) {
                    answer.style.maxHeight = null;
                    answer.classList.add('hidden');
                } else {
                    answer.classList.remove('hidden');
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                }
                
                // Close other answers
                faqQuestions.forEach(otherQuestion => {
                    if (otherQuestion !== this) {
                        const otherAnswer = otherQuestion.nextElementSibling;
                        const otherIcon = otherQuestion.querySelector('i');
                        
                        otherQuestion.classList.remove('active');
                        otherIcon.classList.remove('rotate-180');
                        otherAnswer.style.maxHeight = null;
                        otherAnswer.classList.add('hidden');
                    }
                });
            });
        });
        
        // Animation d'entrée pour les FAQ
        const faqItems = document.querySelectorAll('.bg-white.rounded-lg.border');
        faqItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            item.style.transition = 'opacity 0.5s, transform 0.5s';
            
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 100 + 300);
        });
        
        // Formatage du téléphone
        const phoneInput = document.getElementById('telephone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                
                if (value.length > 2) {
                    value = value.substring(0, 2) + ' ' + value.substring(2);
                }
                if (value.length > 5) {
                    value = value.substring(0, 5) + ' ' + value.substring(5);
                }
                if (value.length > 8) {
                    value = value.substring(0, 8) + ' ' + value.substring(8);
                }
                if (value.length > 11) {
                    value = value.substring(0, 11);
                }
                
                e.target.value = value;
            });
        }
        
        // Validation et envoi du formulaire
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Récupérer les données du formulaire
                const formData = new FormData(this);
                const submitBtn = document.getElementById('submitBtn');
                const submitText = document.getElementById('submitText');
                const loadingSpinner = document.getElementById('loadingSpinner');
                const successMessage = document.getElementById('successMessage');
                const errorMessage = document.getElementById('errorMessage');
                const errorMessageText = document.getElementById('errorMessageText');
                
                // Validation côté client
                let isValid = true;
                const requiredFields = contactForm.querySelectorAll('[required]');
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });
                
                if (!isValid) {
                    errorMessageText.textContent = 'Veuillez remplir tous les champs obligatoires.';
                    errorMessage.classList.remove('hidden');
                    errorMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    return;
                }
                
                // Afficher le loader
                submitText.textContent = 'Envoi en cours...';
                loadingSpinner.classList.remove('hidden');
                submitBtn.disabled = true;
                
                // Cacher les messages précédents
                successMessage.classList.add('hidden');
                errorMessage.classList.add('hidden');
                
                // Simulation d'envoi (à remplacer par une vraie requête AJAX)
                setTimeout(() => {
                    // En production, remplacer par:
                    // fetch(contactForm.action, {
                    //     method: 'POST',
                    //     body: formData,
                    //     headers: {
                    //         'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    //         'Accept': 'application/json'
                    //     }
                    // })
                    // .then(response => response.json())
                    // .then(data => {
                    //     if (data.success) {
                    //         // Succès
                    //         successMessage.classList.remove('hidden');
                    //         contactForm.reset();
                    //         successMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    //     } else {
                    //         // Erreur
                    //         errorMessageText.textContent = data.message || 'Une erreur est survenue.';
                    //         errorMessage.classList.remove('hidden');
                    //         errorMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    //     }
                    // })
                    // .catch(error => {
                    //     errorMessageText.textContent = 'Erreur de connexion. Veuillez réessayer.';
                    //     errorMessage.classList.remove('hidden');
                    //     errorMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    // })
                    // .finally(() => {
                    //     submitText.textContent = 'Envoyer le message';
                    //     loadingSpinner.classList.add('hidden');
                    //     submitBtn.disabled = false;
                    // });
                    
                    // Simulation pour le développement
                    const isSuccess = Math.random() > 0.2;
                    
                    if (isSuccess) {
                        // Succès
                        successMessage.classList.remove('hidden');
                        contactForm.reset();
                        successMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    } else {
                        // Erreur
                        errorMessageText.textContent = 'Erreur de serveur. Veuillez réessayer dans quelques instants.';
                        errorMessage.classList.remove('hidden');
                        errorMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                    
                    // Réinitialiser le bouton
                    submitText.textContent = 'Envoyer le message';
                    loadingSpinner.classList.add('hidden');
                    submitBtn.disabled = false;
                }, 1500);
            });
            
            // Validation en temps réel
            const inputs = contactForm.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '' && this.hasAttribute('required')) {
                        this.classList.add('border-red-300');
                        this.classList.remove('border-gray-300');
                    } else {
                        this.classList.remove('border-red-300');
                        this.classList.add('border-gray-300');
                    }
                });
                
                input.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        this.classList.remove('border-red-300');
                        this.classList.add('border-gray-300');
                    }
                });
            });
        }
    });
</script>
@endpush