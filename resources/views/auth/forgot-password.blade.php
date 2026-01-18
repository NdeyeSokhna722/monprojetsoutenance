<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation mot de passe - Ndindy School</title>
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
        <!-- Carte de réinitialisation -->
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
                <p class="text-gray-600">Réinitialisation du mot de passe</p>
            </div>

            <!-- Message d'information -->
            <div class="mb-6 text-sm text-gray-600 bg-blue-50 p-4 rounded-lg border border-blue-100">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-primary mt-0.5 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-700 mb-1">Mot de passe oublié ?</p>
                        <p>Aucun problème. Indiquez-nous simplement votre adresse email et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.</p>
                    </div>
                </div>
            </div>

            <!-- Session Status -->
            @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start">
                <i class="fas fa-check-circle text-green-500 mt-0.5 mr-3"></i>
                <div class="text-green-700 text-sm">{{ session('status') }}</div>
            </div>
            @endif

            <!-- Formulaire de réinitialisation -->
            <form method="POST" action="{{ route('password.email') }}">
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
                            placeholder="votre@email.com"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition duration-200 bg-cream/30"
                        />
                    </div>
                    @error('email')
                    <div class="mt-2 text-sm text-orange-primary flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Bouton d'envoi -->
                <button type="submit" class="w-full gradient-bg text-white py-3 px-4 rounded-lg font-medium hover:opacity-90 transition duration-200 flex items-center justify-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <i class="fas fa-paper-plane mr-3"></i>
                    Envoyer le lien de réinitialisation
                </button>

                <!-- Lien de retour -->
                <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-blue-primary hover:text-blue-dark inline-flex items-center font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour à la connexion
                    </a>
                </div>
            </form>

            <!-- Assistance -->
            <div class="mt-8 p-4 bg-orange-50 border border-orange-100 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-life-ring text-orange-primary mt-0.5 mr-3"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-1">Besoin d'aide ?</p>
                        <p class="text-xs text-gray-600">Si vous ne recevez pas l'email, vérifiez vos spams ou contactez notre support à <span class="text-blue-primary">support@ndindy.edu</span></p>
                    </div>
                </div>
            </div>
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

    <!-- Script pour les animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
            
            // Animation sur le champ
            const emailInput = document.getElementById('email');
            if (emailInput) {
                // Animation au focus
                emailInput.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-orange-primary/30');
                    this.style.transform = 'translateY(-2px)';
                });
                
                // Animation à la perte de focus
                emailInput.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-orange-primary/30');
                    this.style.transform = 'translateY(0)';
                });
                
                // Animation à la saisie
                emailInput.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.classList.add('border-orange-primary');
                    } else {
                        this.classList.remove('border-orange-primary');
                    }
                });
            }
            
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
            const resetCard = document.querySelector('.bg-white');
            if (resetCard) {
                resetCard.style.opacity = '0';
                resetCard.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    resetCard.style.transition = 'all 0.6s ease-out';
                    resetCard.style.opacity = '1';
                    resetCard.style.transform = 'translateY(0)';
                }, 100);
            }
            
            // Animation pour le message d'information
            const infoBox = document.querySelector('.bg-blue-50');
            if (infoBox) {
                infoBox.style.opacity = '0';
                infoBox.style.transform = 'scale(0.95)';
                
                setTimeout(() => {
                    infoBox.style.transition = 'all 0.4s ease-out 0.2s';
                    infoBox.style.opacity = '1';
                    infoBox.style.transform = 'scale(1)';
                }, 300);
            }
        });
    </script>
</body>
</html>