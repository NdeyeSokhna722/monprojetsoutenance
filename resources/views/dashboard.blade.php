@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')

{{-- TITRE avec boutons --}}
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center">
            Tableau de bord
            <span class="ml-2 w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
        </h1>
        <p class="text-gray-600">
            Aperçu général de l'établissement
        </p>
    </div>
    
    <div class="flex items-center space-x-3 mt-4 md:mt-0">
        <a href="{{ route('etudiants.create') }}" 
           class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
                  text-white rounded-lg font-medium transition-all duration-300 shadow-md hover:shadow-lg 
                  transform hover:-translate-y-0.5 flex items-center gap-2">
            <i class="fas fa-plus"></i>
            <span class="hidden sm:inline">Ajouter</span>
        </a>
    </div>
</div>

{{-- ===== CARTES STATISTIQUES ===== --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Carte Utilisateurs --}}
    <div class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 text-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-blue-100 text-sm font-medium mb-1">Utilisateurs totaux</p>
                <h3 class="text-4xl font-bold">{{ $totalUsers }}</h3>
                <div class="flex items-center mt-2 text-blue-200 text-sm">
                    <i class="fas fa-users mr-2"></i>
                    <span>{{ $totalUsers - 2 }} actifs</span>
                </div>
            </div>
            <div class="bg-blue-400/30 p-4 rounded-full">
                <i class="fas fa-users text-3xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex justify-between text-xs text-blue-200 mb-1">
                <span>Actifs</span>
                <span>{{ $totalUsers - 2 }}/{{ $totalUsers }}</span>
            </div>
            <div class="w-full bg-blue-400/50 rounded-full h-2">
                <div class="bg-white h-2 rounded-full" style="width: {{ (($totalUsers - 2) / $totalUsers) * 100 }}%"></div>
            </div>
        </div>
    </div>

    {{-- Carte Enseignants --}}
    <div class="bg-gradient-to-br from-purple-500 via-purple-600 to-purple-700 text-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-purple-100 text-sm font-medium mb-1">Enseignants</p>
                <h3 class="text-4xl font-bold">{{ $totalEnseignants }}</h3>
                <div class="flex items-center mt-2 text-purple-200 text-sm">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                    <span>{{ $availableTeachers }} disponibles</span>
                </div>
            </div>
            <div class="bg-purple-400/30 p-4 rounded-full">
                <i class="fas fa-chalkboard-teacher text-3xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex justify-between text-xs text-purple-200 mb-1">
                <span>Charge moyenne</span>
                <span>{{ round(($totalEtudiants / max($totalEnseignants, 1)), 1) }} élèves/ens</span>
            </div>
            <div class="w-full bg-purple-400/50 rounded-full h-2">
                @php
                    $ratio = min(($totalEtudiants / max($totalEnseignants * 20, 1)) * 100, 100);
                @endphp
                <div class="bg-white h-2 rounded-full" style="width: {{ $ratio }}%"></div>
            </div>
        </div>
    </div>

    {{-- Carte Étudiants --}}
    <div class="bg-gradient-to-br from-green-500 via-green-600 to-green-700 text-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-green-100 text-sm font-medium mb-1">Étudiants</p>
                <h3 class="text-4xl font-bold">{{ $totalEtudiants }}</h3>
                <div class="flex items-center mt-2 text-green-200 text-sm">
                    <i class="fas fa-user-plus mr-2"></i>
                    <span>+{{ $newStudentsThisMonth }} ce mois</span>
                </div>
            </div>
            <div class="bg-green-400/30 p-4 rounded-full">
                <i class="fas fa-user-graduate text-3xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex justify-between text-xs text-green-200 mb-1">
                <span>Actifs</span>
                <span>{{ $activePercentage }}%</span>
            </div>
            <div class="w-full bg-green-400/50 rounded-full h-2">
                <div class="bg-white h-2 rounded-full" style="width: {{ $activePercentage }}%"></div>
            </div>
        </div>
    </div>

    {{-- Carte Classes --}}
    <div class="bg-gradient-to-br from-red-500 via-red-600 to-red-700 text-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-red-100 text-sm font-medium mb-1">Classes actives</p>
                <h3 class="text-4xl font-bold">{{ $totalClasses }}</h3>
                <div class="flex items-center mt-2 text-red-200 text-sm">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ $totalClasses - 1 }} en session</span>
                </div>
            </div>
            <div class="bg-red-400/30 p-4 rounded-full">
                <i class="fas fa-school text-3xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex justify-between text-xs text-red-200 mb-1">
                <span>Moyenne/élèves</span>
                <span>{{ $averageStudentsPerClass }}</span>
            </div>
            <div class="w-full bg-red-400/50 rounded-full h-2">
                @php
                    $capacity = min(($averageStudentsPerClass / 30) * 100, 100);
                @endphp
                <div class="bg-white h-2 rounded-full" style="width: {{ $capacity }}%"></div>
            </div>
        </div>
    </div>

</div>

{{-- ===== DEUXIÈME SECTION : GRAPHIQUES ET ACTIVITÉ ===== --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    {{-- Graphique Évolution --}}
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow border border-gray-200">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-900">
                Évolution des inscriptions
            </h3>
            <div class="flex items-center space-x-2">
                <button class="px-3 py-1 text-sm rounded-lg bg-blue-100 text-blue-700">
                    {{ date('Y') }}
                </button>
            </div>
        </div>
        <div class="h-64">
            <canvas id="chartEtudiants"></canvas>
        </div>
    </div>

    {{-- Activité récente --}}
    <div class="bg-white rounded-2xl p-6 shadow border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">
            Activité récente
        </h3>
        <div class="space-y-4">
            @if($recentActivity['new_students'] > 0)
            <div class="flex items-center p-3 rounded-lg bg-blue-50 border border-blue-100">
                <div class="p-2 rounded-lg bg-blue-100 text-blue-600">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium">{{ $recentActivity['new_students'] }} nouvel{{ $recentActivity['new_students'] > 1 ? 's' : '' }} étudiant{{ $recentActivity['new_students'] > 1 ? 's' : '' }}</p>
                    <p class="text-xs text-gray-500">Inscrits aujourd'hui</p>
                </div>
                <span class="text-xs text-gray-400">Aujourd'hui</span>
            </div>
            @endif
            
            @if($recentActivity['new_teachers'] > 0)
            <div class="flex items-center p-3 rounded-lg bg-green-50 border border-green-100">
                <div class="p-2 rounded-lg bg-green-100 text-green-600">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium">{{ $recentActivity['new_teachers'] }} nouvel{{ $recentActivity['new_teachers'] > 1 ? 's' : '' }} enseignant{{ $recentActivity['new_teachers'] > 1 ? 's' : '' }}</p>
                    <p class="text-xs text-gray-500">Ajoutés aujourd'hui</p>
                </div>
                <span class="text-xs text-gray-400">Aujourd'hui</span>
            </div>
            @endif
            
            @if($recentActivity['updated_profiles'] > 0)
            <div class="flex items-center p-3 rounded-lg bg-yellow-50 border border-yellow-100">
                <div class="p-2 rounded-lg bg-yellow-100 text-yellow-600">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium">{{ $recentActivity['updated_profiles'] }} profil{{ $recentActivity['updated_profiles'] > 1 ? 's' : '' }} mis{{ $recentActivity['updated_profiles'] > 1 ? '' : '' }} à jour</p>
                    <p class="text-xs text-gray-500">Modifications aujourd'hui</p>
                </div>
                <span class="text-xs text-gray-400">Aujourd'hui</span>
            </div>
            @endif
            
            <div class="flex items-center p-3 rounded-lg bg-purple-50 border border-purple-100">
                <div class="p-2 rounded-lg bg-purple-100 text-purple-600">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium">Tableau de bord</p>
                    <p class="text-xs text-gray-500">Mise à jour en temps réel</p>
                </div>
                <span class="text-xs text-gray-400">Maintenant</span>
            </div>
        </div>
    </div>

</div>

{{-- ===== TROISIÈME SECTION : STATS ET PERFORMANCE ===== --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Taux de réussite --}}
    <div class="bg-white rounded-2xl p-6 shadow border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-900 mb-6">
            Taux de réussite
        </h3>
        <div class="flex items-center justify-center">
            <div class="relative w-48 h-48">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center">
                        @php
                            $successRate = min(($activePercentage + 80) / 2, 100);
                        @endphp
                        <div class="text-4xl font-bold text-gray-900">{{ round($successRate) }}%</div>
                        <div class="text-sm text-gray-500">Moyenne générale</div>
                    </div>
                </div>
                <canvas id="successChart" width="192" height="192"></canvas>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-6">
            <div class="text-center p-3 rounded-lg bg-green-50">
                <div class="text-2xl font-bold text-green-600">85%</div>
                <div class="text-sm text-gray-600">Bac</div>
            </div>
            <div class="text-center p-3 rounded-lg bg-blue-50">
                <div class="text-2xl font-bold text-blue-600">94%</div>
                <div class="text-sm text-gray-600">Brevet</div>
            </div>
        </div>
    </div>

    {{-- Performance par matière --}}
    <div class="bg-white rounded-2xl p-6 shadow border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-900 mb-6">
            Performance par matière
        </h3>
        <div class="space-y-4">
            @foreach($matieres as $matiere)
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="font-medium">{{ $matiere['nom'] }}</span>
                    <span class="text-gray-600">{{ number_format($matiere['moyenne'], 1) }}/20</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    @php
                        $width = min(($matiere['moyenne'] / 20) * 100, 100);
                    @endphp
                    <div class="h-2 rounded-full {{ $matiere['couleur'] }}" style="width: {{ $width }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Prochaines échéances --}}
    <div class="bg-white rounded-2xl p-6 shadow border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-900 mb-6">
            Prochaines échéances
        </h3>
        <div class="space-y-4">
            @foreach($upcomingEvents as $event)
            <div class="flex items-center justify-between p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full {{ $event['couleur'] }} mr-3"></div>
                    <div>
                        <p class="font-medium">{{ $event['titre'] }}</p>
                        <p class="text-sm text-gray-500">{{ $event['date'] }}</p>
                    </div>
                </div>
                <button class="p-2 hover:bg-gray-200 rounded-lg transition-colors">
                    <i class="fas fa-ellipsis-h text-gray-400"></i>
                </button>
            </div>
            @endforeach
        </div>
        <a href="{{ route('calendrier.index') }}" class="w-full mt-6 py-3 text-center text-blue-600 hover:text-blue-700 font-medium rounded-lg border border-blue-200 hover:bg-blue-50 transition-colors block">
            Voir tout le calendrier
        </a>
    </div>

</div>

{{-- ===== TABLEAU DES ÉTUDIANTS ===== --}}
<div class="bg-white rounded-2xl shadow overflow-hidden mb-8 border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-semibold text-gray-900">
                Derniers étudiants inscrits
            </h3>
            <p class="text-sm text-gray-500">
                {{ count($lastEtudiants) }} sur {{ $totalEtudiants }} étudiants
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('etudiants.create') }}" 
               class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-medium transition-all duration-300 text-sm flex items-center gap-2">
                <i class="fas fa-plus"></i>
                <span class="hidden sm:inline">Ajouter</span>
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        Étudiant
                    </th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        Contact
                    </th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        Classe
                    </th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        Date
                    </th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($lastEtudiants as $etudiant)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-4 px-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                {{ substr($etudiant->prenom, 0, 1) }}{{ substr($etudiant->nom, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">
                                    {{ $etudiant->prenom }} {{ $etudiant->nom }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    #{{ str_pad($etudiant->id, 5, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-sm text-gray-900">{{ $etudiant->email }}</div>
                        <div class="text-sm text-gray-500">{{ $etudiant->telephone ?? 'Non renseigné' }}</div>
                    </td>
                    <td class="py-4 px-6">
                        @if($etudiant->classe)
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-school mr-2"></i>
                                {{ $etudiant->classe->nom }}
                            </div>
                        @else
                            <span class="text-gray-500">N/A</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-sm text-gray-900">{{ $etudiant->created_at->format('d/m/Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $etudiant->created_at->diffForHumans() }}</div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('etudiants.show', $etudiant) }}" 
                               class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
                               title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('etudiants.edit', $etudiant) }}" 
                               class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" 
                               title="Éditer">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('etudiants.destroy', $etudiant) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" 
                                        title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="text-sm text-gray-500">
            Affichage de 1 à {{ min(count($lastEtudiants), 8) }} sur {{ $totalEtudiants }} étudiants
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('etudiants.index') }}" 
               class="px-3 py-1 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-gray-900 transition-colors">
                Voir tous les étudiants →
            </a>
        </div>
    </div>
</div>

{{-- ===== STATS RAPIDES ===== --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white rounded-xl p-4 text-center">
        <div class="text-2xl font-bold">{{ $averageStudentsPerClass }}</div>
        <div class="text-xs text-gray-300 mt-1">Étudiants/classe</div>
    </div>
    <div class="bg-gradient-to-r from-blue-800 to-blue-900 text-white rounded-xl p-4 text-center">
        <div class="text-2xl font-bold">{{ $activePercentage }}%</div>
        <div class="text-xs text-blue-300 mt-1">Étudiants actifs</div>
    </div>
    <div class="bg-gradient-to-r from-green-800 to-green-900 text-white rounded-xl p-4 text-center">
        <div class="text-2xl font-bold">{{ round($averageAge, 1) }}</div>
        <div class="text-xs text-green-300 mt-1">Âge moyen</div>
    </div>
    <div class="bg-gradient-to-r from-purple-800 to-purple-900 text-white rounded-xl p-4 text-center">
        <div class="text-2xl font-bold">{{ $totalClasses * 8 }}</div>
        <div class="text-xs text-purple-300 mt-1">Heures/semaine</div>
    </div>
</div>

{{-- Scripts Graphiques --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique Évolution des inscriptions
        const ctx1 = document.getElementById('chartEtudiants');
        if (ctx1) {
            new Chart(ctx1.getContext('2d'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                        label: 'Étudiants inscrits',
                        data: {!! json_encode($studentsPerMonth) !!},
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#374151'
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            },
                            ticks: {
                                color: '#374151'
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            },
                            ticks: {
                                color: '#374151'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Graphique Taux de réussite (Doughnut)
        const ctx2 = document.getElementById('successChart');
        if (ctx2) {
            @php
                $successRate = min(($activePercentage + 80) / 2, 100);
            @endphp
            new Chart(ctx2.getContext('2d'), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [{{ $successRate }}, {{ 100 - $successRate }}],
                        backgroundColor: ['#10b981', '#e5e7eb'],
                        borderWidth: 0,
                        circumference: 180,
                        rotation: 270
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    }
                }
            });
        }

        // Animation des nombres (compteurs)
        const counters = document.querySelectorAll('h3.text-4xl');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/\D/g, ''));
            if (!isNaN(target)) {
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 16);
            }
        });
    });
</script>

@endsection