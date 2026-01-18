<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <!-- En-tête du profil admin -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-8 text-white mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-6">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center">
                        <span class="text-3xl font-bold text-blue-600">A</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Administrateur</h1>
                        <p class="text-blue-100">{{ auth()->user()->email ?? 'admin@gmail.com' }}</p>
                        <p class="text-blue-100 mt-2">Super Administrateur • Dernière connexion : Aujourd'hui</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 inline-block">
                        <div class="text-2xl font-bold">Niveau d'accès</div>
                        <div class="text-4xl font-bold mt-1">100%</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal en deux colonnes -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Colonne de gauche : Statistiques -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Statistiques principales -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Carte Utilisateurs -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-500 font-medium">Utilisateurs totaux</div>
                                <div class="text-3xl font-bold mt-2">24</div>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-5.197h-6m3.5 0a3.5 3.5 0 11-7 0 3.5 3.5 0 017 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center text-green-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm font-medium">2 actifs aujourd'hui</span>
                            </div>
                        </div>
                    </div>

                    <!-- Carte Enseignants -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-500 font-medium">Enseignants</div>
                                <div class="text-3xl font-bold mt-2">5</div>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="text-sm text-gray-600">
                                Charge moyenne
                                <span class="font-medium text-gray-900">1.2 élèves/ens</span>
                            </div>
                        </div>
                    </div>

                    <!-- Carte Étudiants -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-500 font-medium">Étudiants</div>
                                <div class="text-3xl font-bold mt-2">19</div>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 016.16-1.4 12.111 12.111 0 017 1.4M12 14l-6.16 3.422a12.083 12.083 0 01-6.16 1.4 12.111 12.111 0 01-7-1.4m9 5v-5"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-green-600">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">+6 ce mois</span>
                                </div>
                                <div class="text-sm font-medium text-green-600">100% actifs</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graphique Évolution des inscriptions -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Évolution des inscriptions</h3>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Période :</span>
                            <select class="border rounded-lg px-3 py-1 text-sm">
                                <option>2025</option>
                                <option>2024</option>
                                <option>2023</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Graphique simplifié -->
                    <div class="h-64 flex items-end space-x-4">
                        @php
                            $months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
                            $data = [8, 10, 12, 15, 18, 20, 22, 21, 19, 17, 19, 24];
                        @endphp
                        @foreach($months as $index => $month)
                            <div class="flex-1 flex flex-col items-center">
                                <div 
                                    class="w-full bg-gradient-to-t from-blue-500 to-blue-300 rounded-t-lg"
                                    style="height: {{ ($data[$index] / max($data)) * 200 }}px;"
                                ></div>
                                <div class="mt-2 text-sm text-gray-600">{{ $month }}</div>
                                <div class="text-sm font-semibold">{{ $data[$index] }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-center text-gray-500 text-sm">
                        Étudiants inscrits par mois
                    </div>
                </div>

                <!-- Activité récente -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Activité récente</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium">4 profils mis à jour</div>
                                    <div class="text-sm text-gray-600">Aujourd'hui</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-600">Modifications</div>
                                <div class="font-bold text-green-600">+4</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium">Nouvelles inscriptions</div>
                                    <div class="text-sm text-gray-600">Ce mois-ci</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-600">Étudiants</div>
                                <div class="font-bold text-green-600">+6</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-purple-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium">Messages envoyés</div>
                                    <div class="text-sm text-gray-600">Cette semaine</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-600">Total</div>
                                <div class="font-bold text-purple-600">23</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite : Informations admin + Actions -->
            <div class="space-y-8">
                <!-- Informations de session -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Session en cours</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Utilisateurs en ligne</span>
                            <span class="font-bold text-blue-600">7</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Moyenne par classe</span>
                            <span class="font-bold text-green-600">0.8</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Dernière activité</span>
                            <span class="font-bold">21:49</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <div class="text-sm text-gray-600 mb-2">Statut du système</div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <span class="font-medium text-green-600">Tous les services fonctionnent</span>
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Actions rapides</h3>
                    
                    <div class="space-y-3">
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <span class="font-medium">Ajouter un utilisateur</span>
                        </a>
                        
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <span class="font-medium">Gérer les classes</span>
                        </a>
                        
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <span class="font-medium">Modifier les paramètres</span>
                        </a>
                        
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </div>
                            <span class="font-medium">Voir les notifications</span>
                        </a>
                    </div>
                </div>

                <!-- Options du profil -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Mon profil</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span>Paramètres</span>
                        </a>
                        
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <span>Aide & Support</span>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition w-full text-left">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                </div>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Notification Windows -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-yellow-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.272 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <div>
                            <div class="font-medium text-yellow-800">Activer Windows</div>
                            <div class="text-sm text-yellow-600 mt-1">Accédez aux paramètres pour activer Windows.</div>
                            <a href="#" class="inline-block mt-2 text-sm font-medium text-yellow-700 hover:text-yellow-800">
                                Ouvrir les paramètres →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>