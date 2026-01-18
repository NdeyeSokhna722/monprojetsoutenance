<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <!-- Colonne 1 : Logo et description -->
            <div>
                <div class="flex items-center mb-4">
                    <svg class="h-8 w-8 text-blue-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-2 text-2xl font-bold">Ndindy School</span>
                </div>
                <p class="text-gray-400 text-sm">
                    Spécialiste du matériel pédagogique scientifique depuis 2008.
                    Plus de 6500 produits pour les enseignants de sciences.
                </p>
                
                <!-- Réseaux sociaux -->
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-pink-500 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            
            <!-- Colonne 2 : Liens rapides -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Liens Rapides</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ url('/catalogue') }}" class="text-gray-400 hover:text-white transition flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Catalogue complet
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/about') }}" class="text-gray-400 hover:text-white transition flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Qui sommes-nous
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Kits de travaux pratiques
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Nouveautés 2024
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            Guide pédagogique
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Colonne 3 : Contact -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Nous contacter</h4>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-400"></i>
                        <div>
                            <p class="font-medium">Adresse</p>
                            <p class="text-sm">Ndindy, Diourbel <br>Sénégal</p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-3 text-blue-400"></i>
                        <div>
                            <p class="font-medium">Téléphone</p>
                            <p class="text-sm">+221 777268419</p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-blue-400"></i>
                        <div>
                            <p class="font-medium">Email</p>
                            <p class="text-sm">ndindyschool@gmail.com</p>
                        </div>
                    </li>
                </ul>
            </div>
            
            <!-- Colonne 4 : Horaires et informations -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Horaires & Infos</h4>
                <div class="bg-gray-800 rounded-lg p-4 mb-4">
                    <p class="text-sm text-gray-300 mb-2">
                        <i class="fas fa-clock mr-2 text-green-400"></i>
                        <span class="font-medium">Horaires d'ouverture :</span>
                    </p>
                    <p class="text-sm text-gray-400">
                        Lundi - Vendredi<br>
                        8h30 - 12h30 & 13h30 - 17h30
                    </p>
                </div>
                
                <div class="bg-gray-800 rounded-lg p-4">
                    <p class="text-sm text-gray-300 mb-2">
                        <i class="fas fa-building mr-2 text-yellow-400"></i>
                        <span class="font-medium">Informations légales :</span>
                    </p>
                    
                </div>
            </div>
            
        </div>
        
        <!-- Newsletter (optionnel) -->
        <div class="mt-12 pt-8 border-t border-gray-800">
            <div class="max-w-md mx-auto text-center">
                <h5 class="text-lg font-semibold mb-4">Restez informé</h5>
                <form class="flex flex-col sm:flex-row gap-2">
                    <input type="email" 
                           placeholder="Votre email" 
                           class="flex-1 px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:border-blue-500">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                        S'inscrire
                    </button>
                </form>
                <p class="text-xs text-gray-500 mt-2">
                    En vous inscrivant, vous acceptez notre politique de confidentialité
                </p>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="mt-12 pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-500 text-sm">
                    &copy; 2000-{{ date('Y') }} Ndindy school. Tous droits réservés.
                </div>
                
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">
                        Mentions légales
                    </a>
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">
                        Politique de confidentialité
                    </a>
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">
                        Conditions générales
                    </a>
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">
                        Plan du site
                    </a>
                </div>
            </div>
                
            </div>
        </div>
    </div>
</footer>

<!-- Retour en haut -->
<button id="backToTop" 
        class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition opacity-0 transform translate-y-4">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Script pour le retour en haut -->
<script>
    // Retour en haut
    const backToTop = document.getElementById('backToTop');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTop.classList.remove('opacity-0', 'translate-y-4');
            backToTop.classList.add('opacity-100', 'translate-y-0');
        } else {
            backToTop.classList.remove('opacity-100', 'translate-y-0');
            backToTop.classList.add('opacity-0', 'translate-y-4');
        }
    });
    
    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>