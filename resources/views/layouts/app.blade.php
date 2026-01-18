<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ndindy School - Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">

<div class="flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    <aside id="sidebar"
           class="w-64 bg-gradient-to-b from-orange-600 to-orange-700 dark:from-gray-800 dark:to-gray-900 text-white flex-shrink-0 transition-all duration-300 z-50 shadow-xl">
        
        {{-- LOGO avec effet --}}
        <div class="p-6 text-2xl font-bold flex items-center gap-3 border-b border-orange-500/30 dark:border-gray-700">
            <div class="relative">
                <i class="fas fa-school text-3xl text-white"></i>
                <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
            </div>
            <span class="sidebar-text font-bold tracking-wide">Ndindy School</span>
            <span class="text-xs bg-white/20 px-2 py-1 rounded-full">L'excellence</span>
        </div>

       {{-- MENU avec indicateur actif --}}
<nav class="mt-6 space-y-1 px-3">
    @php
        $menu = [
            ['Dashboard', 'dashboard', 'fa-chart-line'],
            ['Utilisateurs', 'users.index', 'fa-users'],
            ['Enseignants', 'enseignants.index', 'fa-chalkboard-teacher'],
            ['Étudiants', 'etudiants.index', 'fa-user-graduate'],
            ['Classes', 'classes.index', 'fa-school'],
            ['Matières', 'matieres.index', 'fa-book'],
            ['Notes', 'notes.index', 'fa-pen'],
            ['Présences', 'attendances.index', 'fa-calendar-check'],
            ['Emploi de temps', 'timetables.index', 'fa-clock'],
            ['Calendrier', 'calendrier.index', 'fa-calendar'],
            ['Messages', 'messages.index', 'fa-comments'],
            ['Rapports', 'rapports.index', 'fa-chart-bar'],
        ];
        
        $currentRoute = request()->route() ? request()->route()->getName() : 'dashboard';
    @endphp
    
    @foreach($menu as $item)
        @php
            $label = $item[0];
            $route = $item[1];
            $icon = $item[2];
            $isCurrent = $currentRoute === $route;
        @endphp

        <a href="{{ route($route) }}" 
           class="sidebar-link flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition-all duration-200 {{ $isCurrent ? 'active bg-white/10' : '' }} group">
            <div class="relative">
                <i class="fas {{ $icon }} w-6 text-lg {{ $isCurrent ? 'text-white' : 'text-orange-200' }}"></i>
                @if($label === 'Messages')
                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-400 rounded-full animate-ping"></span>
                @endif
            </div>
            <span class="ml-3 sidebar-text font-medium">{{ $label }}</span>
            @if($isCurrent)
                <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
            @endif
            <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                <i class="fas fa-chevron-right text-xs"></i>
            </div>
        </a>
    @endforeach

    
</nav>

        {{-- STATS MINIATURES --}}
        <div class="mt-8 px-4">
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm text-orange-200">Statut serveur</span>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-xs">En ligne</span>
                    </div>
                </div>
                <div class="text-xs text-orange-200">
                    <div class="flex justify-between mb-1">
                        <span>Stockage</span>
                        <span>65%</span>
                    </div>
                    <div class="w-full bg-white/20 rounded-full h-1">
                        <div class="bg-white h-1 rounded-full" style="width: 65%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- THEME TOGGLE dans sidebar --}}
        <div class="mt-6 px-4">
            <button id="themeToggle" class="w-full bg-white/10 hover:bg-white/20 rounded-lg p-3 flex items-center justify-center transition">
                <i class="fas fa-moon mr-2"></i>
                <span class="sidebar-text">Mode sombre</span>
            </button>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col bg-gray-50 dark:bg-gray-900 overflow-hidden">

        {{-- HEADER amélioré --}}
        <header class="h-16 bg-white dark:bg-gray-800 flex items-center justify-between px-6 shadow-sm border-b border-gray-200 dark:border-gray-700">
            
            <div class="flex items-center gap-4">
                {{-- Toggle Sidebar --}}
                <button id="toggleSidebar"
                        class="text-gray-600 dark:text-gray-300 text-xl hover:text-orange-600 dark:hover:text-orange-400 transition p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-bars"></i>
                </button>

                {{-- Search Bar --}}
                <div class="hidden md:block relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" 
                           placeholder="Rechercher..." 
                           class="pl-10 pr-4 py-2 w-64 lg:w-80 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent dark:focus:ring-orange-400 transition">
                </div>
            </div>
{{-- Right side: Notifications, User --}}
<div class="flex items-center gap-4">
    
    {{-- Quick Actions --}}
    <div class="hidden md:flex items-center gap-2">
        <button class="p-2 text-gray-600 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition"
                title="Créer rapide">
            <i class="fas fa-plus"></i>
        </button>
        <button class="p-2 text-gray-600 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition"
                title="Paramètres rapides">
            <i class="fas fa-cog"></i>
        </button>
    </div>
    
    {{-- 🔔 NOTIFICATIONS --}}
    <div class="relative">
        <a href="{{ route('notifications.index') }}" 
           class="relative flex items-center gap-2 p-2 text-gray-600 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
            <i class="fas fa-bell text-xl"></i>
            @auth
                @php
                    $unreadCount = 0;
                    try {
                        if (Auth::check() && method_exists(Auth::user(), 'unreadNotifications')) {
                            $unreadCount = Auth::user()->unreadNotifications()->count();
                        }
                    } catch (\Exception $e) {
                        // En cas d'erreur (table inexistante), on retourne 0
                        $unreadCount = 0;
                    }
                @endphp
                @if($unreadCount > 0)
                    <span class="notification-badge absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform bg-red-600 rounded-full">
                        {{ $unreadCount }}
                    </span>
                @endif
            @endauth
        </a>
    </div>
                {{-- User Menu --}}
                <div class="relative">
                    <button id="userMenuBtn" 
                            class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="font-medium text-sm">{{ Auth::user()->name ?? 'Utilisateur' }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Administrateur</p>
                        </div>
                        <i class="fas fa-chevron-down text-sm text-gray-500"></i>
                    </button>
                    
                    {{-- User Dropdown --}}
<div id="userDropdown" 
     class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 z-50">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
        <p class="font-semibold">{{ Auth::user()->name ?? 'Utilisateur' }}</p>
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email ?? 'email@exemple.com' }}</p>
    </div>
    <div class="p-2">
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.profile') }}" 
               class="flex items-center px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                <i class="fas fa-user-circle mr-3 text-gray-500"></i>
                Mon profil
            </a>
        @else
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                <i class="fas fa-user-circle mr-3 text-gray-500"></i>
                Mon profil
            </a>

            <a href="#" 
           class="flex items-center px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
            <i class="fas fa-cog mr-3 text-gray-500"></i>
            Paramètres
        </a>
        @endif
        <a href="{{ route('help') }}" 
           class="flex items-center px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
            <i class="fas fa-question-circle mr-3 text-gray-500"></i>
            Aide & Support
        </a>
        
    </div>
    <div class="p-2 border-t border-gray-200 dark:border-gray-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="flex items-center w-full px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Déconnexion 
            </button>
        </form>
    </div>
</div>
                </div>
            </div>
        </header>
       
        {{-- CONTENT avec breadcrumb --}}
        <main class="flex-1 overflow-y-auto p-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <a href="{{ route('dashboard') }}" class="hover:text-orange-600 dark:hover:text-orange-400 transition">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-right mx-2 text-xs"></i>
                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ $title ?? 'Dashboard' }}</span>
                </div>
                
                {{-- Date et heure --}}
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <span id="currentDateTime"></span>
                </div>
            </div>
            
            {{-- Page Content --}}
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer class="py-4 px-6 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-center text-sm text-gray-600 dark:text-gray-400">
            <p>&copy; {{ date('Y') }} Ndindy School. Tous droits réservés. 
                <span class="mx-2">•</span>
                <span id="serverTime" class="font-mono"></span>
            </p>
        </footer>
    </div>
</div>

{{-- SCRIPTS --}}
<script>
    // Toggle Sidebar
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('toggleSidebar');
    const texts = document.querySelectorAll('.sidebar-text');
    
    if (toggle) {
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('w-64');
            sidebar.classList.toggle('w-20');
            texts.forEach(t => t.classList.toggle('hidden'));
        });
    }

    // Dark Mode Toggle
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = themeToggle ? themeToggle.querySelector('i') : null;
    const themeText = themeToggle ? themeToggle.querySelector('.sidebar-text') : null;
    
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            if (document.documentElement.classList.contains('dark')) {
                themeIcon.className = 'fas fa-sun mr-2';
                themeText.textContent = 'Mode clair';
                localStorage.setItem('theme', 'dark');
            } else {
                themeIcon.className = 'fas fa-moon mr-2';
                themeText.textContent = 'Mode sombre';
                localStorage.setItem('theme', 'light');
            }
        });
    }

    // Charger le thème sauvegardé
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
        if (themeIcon) themeIcon.className = 'fas fa-sun mr-2';
        if (themeText) themeText.textContent = 'Mode clair';
    }

    // Notifications Dropdown
    const notificationBtn = document.getElementById('notificationBtn');
    const notificationDropdown = document.getElementById('notificationDropdown');
    
    if (notificationBtn) {
        notificationBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            notificationDropdown.classList.toggle('hidden');
        });
    }

    // User Menu Dropdown
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');
    
    if (userMenuBtn) {
        userMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('hidden');
        });
    }

    // Fermer les dropdowns en cliquant ailleurs
    document.addEventListener('click', (e) => {
        if (notificationBtn && !notificationBtn.contains(e.target) && notificationDropdown && !notificationDropdown.contains(e.target)) {
            notificationDropdown.classList.add('hidden');
        }
        if (userMenuBtn && !userMenuBtn.contains(e.target) && userDropdown && !userDropdown.contains(e.target)) {
            userDropdown.classList.add('hidden');
        }
    });

    // Date et heure en temps réel
    function updateDateTime() {
        const now = new Date();
        const dateTimeElement = document.getElementById('currentDateTime');
        const serverTimeElement = document.getElementById('serverTime');
        
        if (dateTimeElement) {
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const formatted = now.toLocaleDateString('fr-FR', options);
            dateTimeElement.textContent = formatted;
        }
        
        if (serverTimeElement) {
            const timeString = now.toLocaleTimeString('fr-FR');
            serverTimeElement.textContent = timeString;
        }
    }
    
    // Mettre à jour toutes les secondes
    if (document.getElementById('currentDateTime') || document.getElementById('serverTime')) {
        setInterval(updateDateTime, 1000);
        updateDateTime();
    }

    // Animation pour les cartes de statistiques
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observer les cartes de statistiques
    document.addEventListener('DOMContentLoaded', () => {
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    });
</script>

{{-- Scripts spécifiques à la page --}}
@stack('scripts')

</body>
</html>