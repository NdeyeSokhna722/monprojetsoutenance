<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center">
                    <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-2 text-xl font-bold text-gray-800">Ndindy School</span>
                </a>
                
                {{-- Menu desktop --}}
                <div class="hidden md:ml-6 md:flex md:space-x-8">
                    <a href="{{ url('/') }}" 
                       class="{{ request()->is('/') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Accueil
                    </a>
                    <a href="{{ url('/catalogue') }}" 
                       class="{{ request()->is('catalogue*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Catalogue
                    </a>
                    <a href="{{ url('/about') }}" 
                       class="{{ request()->is('about*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Qui sommes-nous
                    </a>
                    <a href="{{ url('/contact') }}" 
                       class="{{ request()->is('contact*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Contact
                    </a>
                </div>
            </div>
            
            {{-- Boutons droite --}}
            <div class="flex items-center space-x-4">
                <a href="{{ url('/login') }}" 
                   class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                </a>
                
                {{-- Lien vers l'admin si connecté --}}
                @auth
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                    <i class="fas fa-cogs mr-2"></i>Admin
                </a>
                @endauth
            </div>
        </div>
        
        {{-- Menu mobile (optionnel) --}}
        <div class="md:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ url('/') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Accueil</a>
                <a href="{{ url('/catalogue') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Catalogue</a>
                <a href="{{ url('/about') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Qui sommes-nous</a>
                <a href="{{ url('/contact') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Contact</a>
            </div>
        </div>
    </div>
</nav>