@extends('layouts.public')

@section('title', 'Accueil - Collège & Lycée Ndindy School')

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
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                Excellence Éducative <br>de la 6ème à la Terminale
            </h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Une institution d'enseignement secondaire dédiée à la formation des citoyens épanouis et responsables de demain
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('catalogue') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-8 py-3 rounded-full font-semibold text-lg transition duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-graduation-cap mr-2"></i>Découvrir notre offre scolaire
                </a>
                <a href="{{ route('inscription') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full font-semibold text-lg transition duration-300 shadow-lg border border-orange-400">
                    <i class="fas fa-file-alt mr-2"></i>Pré-inscription
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Quick Stats -->
    <section class="mb-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-gray-100 hover:shadow-xl transition duration-300">
                <div class="text-4xl font-bold text-blue-600 mb-2" data-counter="750">0</div>
                <div class="text-gray-600 font-medium">Élèves</div>
                <div class="text-sm text-gray-500 mt-2">De la 6ème à la Terminale</div>
            </div>
            
            <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-gray-100 hover:shadow-xl transition duration-300">
                <div class="text-4xl font-bold text-orange-600 mb-2" data-counter="58">0</div>
                <div class="text-gray-600 font-medium">Enseignants</div>
                <div class="text-sm text-gray-500 mt-2">Diplômés et expérimentés</div>
            </div>
            
            <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-gray-100 hover:shadow-xl transition duration-300">
                <div class="text-4xl font-bold text-green-600 mb-2" data-counter="98">0%</div>
                <div class="text-gray-600 font-medium">Taux de réussite</div>
                <div class="text-sm text-gray-500 mt-2">Baccalauréat 2023</div>
            </div>
            
            <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-gray-100 hover:shadow-xl transition duration-300">
                <div class="text-4xl font-bold text-purple-600 mb-2" data-counter="96">0%</div>
                <div class="text-gray-600 font-medium">Mention Brevet</div>
                <div class="text-sm text-gray-500 mt-2">Session 2023</div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mb-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Notre Mission Éducative</h2>
                <div class="space-y-4 text-gray-600">
                    <p class="text-lg">
                        Fondée en <span class="font-bold text-orange-600">1995</span>, Ndindy School s'engage à offrir une éducation complète qui allie excellence académique, développement personnel et valeurs citoyennes.
                    </p>
                    <p class="text-lg">
                        Sous la direction de <span class="font-semibold">M. Ndiaye</span>, ancien inspecteur d'académie, nous avons développé une pédagogie innovante qui place l'élève au cœur de son apprentissage.
                    </p>
                    <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-500">
                        <p class="font-semibold text-blue-700">
                            "Notre objectif est d'accompagner chaque élève dans la découverte de ses talents et la construction de son projet d'avenir."
                        </p>
                        <p class="text-sm text-gray-600 mt-2">— M. Ndiaye, Directeur</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-orange-50 rounded-2xl p-8 shadow-lg">
                <div class="text-center">
                    <div class="inline-block p-6 bg-white rounded-full mb-4 shadow-md">
                        <i class="fas fa-school text-4xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Pédagogie Adaptée</h3>
                    <p class="text-gray-600 mb-6">
                        Des méthodes d'enseignement modernes pour accompagner chaque élève vers la réussite
                    </p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Accompagnement personnalisé</span>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Projets interdisciplinaires</span>
                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">Ouverture internationale</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cycle Scolaire -->
    <section class="mb-16 bg-gradient-to-r from-blue-50 to-orange-50 rounded-2xl p-8 md:p-12">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Notre Parcours Scolaire</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Collège -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-school text-2xl text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Collège</h3>
                            <p class="text-gray-500">De la 6ème à la 3ème</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Un cycle d'apprentissage progressif avec accompagnement personnalisé et ouverture culturelle.
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Programme de l'Éducation Nationale
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Préparation au Diplôme National du Brevet
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Options LV2 et Latin dès la 5ème
                        </li>
                    </ul>
                    <a href="{{ route('catalogue') }}#college" class="mt-6 inline-flex items-center text-blue-600 font-medium hover:text-blue-800">
                        En savoir plus <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <!-- Lycée -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user-graduate text-2xl text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Lycée</h3>
                            <p class="text-gray-500">De la 2nde à la Terminale</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Préparation au Baccalauréat avec un choix de spécialités adapté à chaque projet d'orientation.
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Bac Général avec 7 spécialités
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Option Internationale (OIB)
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Accompagnement orientation Post-Bac
                        </li>
                    </ul>
                    <a href="{{ route('catalogue') }}#lycee" class="mt-6 inline-flex items-center text-orange-600 font-medium hover:text-orange-800">
                        En savoir plus <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="mb-16">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Pourquoi choisir Ndindy School ?</h2>
            <div class="w-24 h-1 bg-orange-600 mx-auto"></div>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-200 hover:shadow-xl transition duration-300">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Encadrement Personnalisé</h3>
                <p class="text-gray-600">
                    Des effectifs réduits pour un suivi individualisé. Chaque élève bénéficie d'un tutorat et d'un accompagnement adapté.
                </p>
            </div>
            
            <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-200 hover:shadow-xl transition duration-300">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-globe-americas text-green-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Ouverture Internationale</h3>
                <p class="text-gray-600">
                    Section internationale, échanges linguistiques, préparation aux certifications Cambridge et DELE.
                </p>
            </div>
            
            <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-200 hover:shadow-xl transition duration-300">
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-heart text-orange-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Épanouissement Global</h3>
                <p class="text-gray-600">
                    Clubs sportifs, artistiques et scientifiques pour développer les talents et l'engagement citoyen.
                </p>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Témoignages</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user-graduate text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold">Fatou Ndiaye</h4>
                        <p class="text-sm text-gray-500">Ancienne élève, Terminale S</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">
                    "La préparation au Bac dans les spécialités scientifiques était excellente. J'ai intégré médecine grâce à cette solide formation."
                </p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user-tie text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold">M. Diallo</h4>
                        <p class="text-sm text-gray-500">Père d'un élève de 4ème</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">
                    "L'accompagnement personnalisé et l'attention portée à chaque élève font vraiment la différence. Mon fils s'épanouit pleinement."
                </p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-chalkboard-teacher text-orange-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold">Mme Sow</h4>
                        <p class="text-sm text-gray-500">Professeur d'anglais</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">
                    "Enseigner ici est un vrai plaisir. Les élèves sont motivés et nous avons les moyens pédagogiques pour les faire progresser."
                </p>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="mb-16 bg-gradient-to-r from-blue-50 to-orange-50 rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Événements à venir</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-lg mr-4">
                        <span class="font-bold">15</span> MAR
                    </div>
                    <div>
                        <h4 class="font-bold">Journée Portes Ouvertes</h4>
                        <p class="text-sm text-gray-500">9h00 - 17h00</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">
                    Découvrez notre établissement, rencontrez l'équipe pédagogique et visitez nos installations.
                </p>
                <a href="{{ route('visite') }}" class="mt-4 inline-flex items-center text-blue-600 text-sm font-medium">
                    S'inscrire <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="bg-green-100 text-green-800 px-3 py-1 rounded-lg mr-4">
                        <span class="font-bold">22</span> MAR
                    </div>
                    <div>
                        <h4 class="font-bold">Réunion d'Information</h4>
                        <p class="text-sm text-gray-500">18h00 - 20h00</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">
                    Présentation de notre projet éducatif et des modalités d'inscription pour la rentrée prochaine.
                </p>
                <a href="{{ route('contact') }}#rdv" class="mt-4 inline-flex items-center text-green-600 text-sm font-medium">
                    Réserver <i class="fas fa-calendar-alt ml-1"></i>
                </a>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="bg-orange-100 text-orange-800 px-3 py-1 rounded-lg mr-4">
                        <span class="font-bold">5</span> AVR
                    </div>
                    <div>
                        <h4 class="font-bold">Forum des Métiers</h4>
                        <p class="text-sm text-gray-500">14h00 - 18h00</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">
                    Rencontre avec des professionnels pour aider nos lycéens dans leur orientation post-bac.
                </p>
                <a href="{{ route('contact') }}#forum" class="mt-4 inline-flex items-center text-orange-600 text-sm font-medium">
                    En savoir plus <i class="fas fa-info-circle ml-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="text-center py-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Prêt à nous rejoindre ?</h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Inscrivez votre enfant pour une scolarité épanouissante et tournée vers la réussite
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('inscription') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full font-semibold text-lg transition duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-file-alt mr-2"></i>Pré-inscription en ligne
            </a>
            <a href="{{ route('contact') }}" class="bg-white hover:bg-gray-50 text-blue-600 border border-blue-600 px-8 py-3 rounded-full font-semibold text-lg transition duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-calendar-check mr-2"></i>Demander un rendez-vous
            </a>
            <a href="{{ route('visite') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold text-lg transition duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-door-open mr-2"></i>Portes ouvertes
            </a>
        </div>
        <p class="text-gray-500 text-sm mt-6">
            Besoin d'informations ? Contactez-nous au 
            <a href="tel:+221338214567" class="text-orange-600 hover:text-orange-800 font-medium">+221 33 821 45 67</a>
            ou par email à 
            <a href="mailto:info@ndindy.sn" class="text-blue-600 hover:text-blue-800 font-medium">info@ndindy.sn</a>
        </p>
    </section>
</main>
@endsection

@push('styles')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    }
    .gradient-bg-orange {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    }
</style>
@endpush

@push('scripts')
<script>
    // Animation pour les statistiques
    function animateCounter(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            element.textContent = value + (element.textContent.includes('%') ? '%' : '');
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Observer pour déclencher l'animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const stats = entry.target.querySelectorAll('[data-counter]');
                stats.forEach(stat => {
                    const target = parseInt(stat.getAttribute('data-counter'));
                    const hasPercent = stat.textContent.includes('%');
                    
                    stat.textContent = '0' + (hasPercent ? '%' : '');
                    animateCounter(stat, 0, target, 2000);
                });
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    // Observer la section stats (première section)
    document.addEventListener('DOMContentLoaded', function() {
        const statsSection = document.querySelector('section.mb-16');
        if (statsSection) {
            observer.observe(statsSection);
        }
    });
</script>
@endpush