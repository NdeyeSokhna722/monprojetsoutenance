<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Ndindy School</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'orange-primary': '#FF6B35',
                        'orange-light': '#FF9A6C',
                        'orange-dark': '#E55A2B',
                        'blue-light': '#4DA6FF',
                        'blue-primary': '#0077FF',
                        'blue-dark': '#0059CC',
                        'cream': '#FFF8F0'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #FFF8F0 0%, #E6F2FF 100%);
        }
        .card-shadow {
            box-shadow: 0 10px 40px rgba(255, 107, 53, 0.15), 0 5px 15px rgba(77, 166, 255, 0.1);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
            border-color: #FF6B35;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #FF6B35 0%, #4DA6FF 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #FF6B35 0%, #4DA6FF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Carte de connexion -->
        <div class="bg-white rounded-2xl card-shadow p-8 border border-orange-100">
            <!-- En-tête avec logo -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="w-20 h-20 rounded-full gradient-bg flex items-center justify-center shadow-lg">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold gradient-text">N</span>
                        </div>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Ndindy School</h1>
                <p class="text-gray-600">Connectez-vous à votre espace</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start">
                <i class="fas fa-check-circle text-green-500 mt-0.5 mr-3"></i>
                <div class="text-green-700 text-sm">{{ session('status') }}</div>
            </div>
            @endif

            <!-- Formulaire de connexion -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-orange-primary"></i>Adresse email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-at text-orange-light"></i>
                        </div>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            required 
                            autofocus 
                            autocomplete="email"
                            value="{{ old('email') }}"
                            placeholder="admin@ndindy.edu"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition duration-200 bg-cream/30"
                        />
                    </div>
                    @error('email')
                    <div class="mt-2 text-sm text-orange-primary flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-orange-primary"></i>Mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-orange-light"></i>
                        </div>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition duration-200 bg-cream/30"
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" id="togglePassword" class="text-orange-light hover:text-orange-primary">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                    <div class="mt-2 text-sm text-orange-primary flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Se souvenir de moi & Mot de passe oublié -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            name="remember" 
                            type="checkbox" 
                            class="h-4 w-4 text-orange-primary focus:ring-orange-primary border-gray-300 rounded"
                        />
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-primary hover:text-blue-dark font-medium">
                        Mot de passe oublié ?
                    </a>
                    @endif
                </div>

                <!-- Bouton de connexion -->
                <button type="submit" class="w-full gradient-bg text-white py-3 px-4 rounded-lg font-medium hover:opacity-90 transition duration-200 flex items-center justify-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <i class="fas fa-sign-in-alt mr-3"></i>
                    Se connecter
                </button>

                <!-- Stats de l'école (optionnel) -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <div class="text-lg font-bold text-orange-primary">24</div>
                            <div class="text-xs text-gray-600">Utilisateurs</div>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-blue-primary">5</div>
                            <div class="text-xs text-gray-600">Enseignants</div>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-orange-light">19</div>
                            <div class="text-xs text-gray-600">Étudiants</div>
                        </div>
                    </div>
                </div>

                <!-- Lien vers le tableau de bord (pour développement) -->
                <div class="mt-6 text-center">
                    <a href="{{ route('dashboard') }}" class="text-sm text-blue-primary hover:text-blue-dark inline-flex items-center font-medium">
                        <i class="fas fa-chart-line mr-2"></i>
                        Accéder au tableau de bord
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                © 2025 Ndindy School. Tous droits réservés.
                <span id="current-time" class="ml-2 font-mono text-gray-800"></span>
            </p>
            <div class="mt-4">
                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-light to-blue-light text-white rounded-full shadow-sm">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <span class="text-sm">Activer Windows - Accédez aux paramètres</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Animation d'arrière-plan -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-orange-light/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-light/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-orange-light/10 to-blue-light/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Script pour afficher/masquer le mot de passe -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Changer l'icône
                    const icon = this.querySelector('i');
                    if (type === 'password') {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    } else {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                });
            }
            
            // Mettre à jour l'heure actuelle
            function updateTime() {
                const now = new Date();
                const timeString = now.getHours().toString().padStart(2, '0') + ':' + 
                                 now.getMinutes().toString().padStart(2, '0') + ':' + 
                                 now.getSeconds().toString().padStart(2, '0');
                const timeElement = document.getElementById('current-time');
                if (timeElement) {
                    timeElement.textContent = timeString;
                }
            }
            
            updateTime();
            setInterval(updateTime, 1000);
            
            // Animation sur les champs
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                // Animation au focus
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-orange-primary/30');
                    this.style.transform = 'translateY(-2px)';
                });
                
                // Animation à la perte de focus
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-orange-primary/30');
                    this.style.transform = 'translateY(0)';
                });
                
                // Animation à la saisie
                input.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.classList.add('border-orange-primary');
                    } else {
                        this.classList.remove('border-orange-primary');
                    }
                });
            });
            
            // Animation du bouton
            const submitButton = document.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.02)';
                });
                
                submitButton.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            }
            
            // Animation de la carte au chargement
            const loginCard = document.querySelector('.bg-white');
            if (loginCard) {
                loginCard.style.opacity = '0';
                loginCard.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    loginCard.style.transition = 'all 0.6s ease-out';
                    loginCard.style.opacity = '1';
                    loginCard.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>
</body>
</html>