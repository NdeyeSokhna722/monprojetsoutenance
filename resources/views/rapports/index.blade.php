@extends('layouts.app')

@section('title', 'Rapports et Statistiques')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .chart-container {
            position: relative;
            height: 320px;
            width: 100%;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
        .export-btn {
            transition: all 0.2s ease;
        }
        .export-btn:hover {
            transform: scale(1.05);
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-4 py-6">
    <!-- En-tête avec filtres -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Tableau de Bord Analytique</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">
                Analysez les performances et les tendances de votre établissement
            </p>
        </div>
        
        <div class="mt-4 md:mt-0 flex flex-col md:flex-row items-start md:items-center space-y-3 md:space-y-0 md:space-x-4">
            <!-- Filtres de période -->
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">Période :</span>
                <select id="periodFilter" 
                        class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                               focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                               dark:bg-gray-700 dark:text-white text-sm">
                    <option value="today">Aujourd'hui</option>
                    <option value="week" selected>Cette semaine</option>
                    <option value="month">Ce mois</option>
                    <option value="quarter">Ce trimestre</option>
                    <option value="year">Cette année</option>
                    <option value="custom">Personnalisée</option>
                </select>
            </div>
            
            <!-- Boutons d'export -->
            <div class="flex space-x-2">
                <button id="exportPdf" 
                        class="export-btn px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg 
                               flex items-center text-sm font-medium">
                    <i class="fas fa-file-pdf mr-2"></i> PDF
                </button>
                <button id="exportExcel" 
                        class="export-btn px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg 
                               flex items-center text-sm font-medium">
                    <i class="fas fa-file-excel mr-2"></i> Excel
                </button>
                <button id="refreshData" 
                        class="export-btn px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg 
                               flex items-center text-sm font-medium">
                    <i class="fas fa-sync-alt mr-2"></i> Actualiser
                </button>
            </div>
        </div>
    </div>

    <!-- Filtres personnalisés (masqués par défaut) -->
    <div id="customFilters" class="hidden mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Date de début
                </label>
                <input type="date" id="startDate" 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                              focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                              dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Date de fin
                </label>
                <input type="date" id="endDate" 
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                              focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                              dark:bg-gray-700 dark:text-white">
            </div>
            <div class="flex items-end">
                <button id="applyCustomFilter" 
                        class="w-full px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white 
                               rounded-lg font-medium">
                    Appliquer
                </button>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-orange-500">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Étudiants</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalEtudiants ?? 0 }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                            <i class="fas fa-arrow-up mr-1"></i> 12%
                        </span>
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">vs mois dernier</span>
                    </div>
                </div>
                <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900">
                    <i class="fas fa-user-graduate text-orange-600 dark:text-orange-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Enseignants</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalEnseignants ?? 0 }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                            <i class="fas fa-arrow-up mr-1"></i> 5%
                        </span>
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">vs mois dernier</span>
                    </div>
                </div>
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                    <i class="fas fa-chalkboard-teacher text-blue-600 dark:text-blue-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-green-500">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Classes</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalClasses ?? 0 }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                            <i class="fas fa-plus mr-1"></i> 3
                        </span>
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">nouvelles cette année</span>
                    </div>
                </div>
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                    <i class="fas fa-school text-green-600 dark:text-green-400 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Utilisateurs</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalUsers ?? 0 }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs px-2 py-1 rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                            <i class="fas fa-arrow-up mr-1"></i> 8%
                        </span>
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">vs mois dernier</span>
                    </div>
                </div>
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                    <i class="fas fa-users text-purple-600 dark:text-purple-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Section des graphiques -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Graphique 1: Évolution des inscriptions -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Évolution des inscriptions</h2>
                <div class="flex space-x-2">
                    <button class="chart-type-btn active px-3 py-1 text-sm bg-orange-600 text-white rounded-lg" 
                            data-chart="line" data-target="inscriptionsChart">
                        Ligne
                    </button>
                    <button class="chart-type-btn px-3 py-1 text-sm text-gray-700 dark:text-gray-300 
                                   hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg" 
                            data-chart="bar" data-target="inscriptionsChart">
                        Barres
                    </button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="inscriptionsChart"></canvas>
            </div>
        </div>

        <!-- Graphique 2: Répartition par genre -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Répartition par genre</h2>
                <select id="genderClassFilter" 
                        class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                               focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                               dark:bg-gray-700 dark:text-white text-sm">
                    <option value="all">Toutes les classes</option>
                    @foreach($classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="chart-container">
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        <!-- Graphique 3: Taux de présence -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Taux de présence moyenne</h2>
                <span class="text-2xl font-bold text-green-600">94.5%</span>
            </div>
            <div class="chart-container">
                <canvas id="presenceChart"></canvas>
            </div>
        </div>

        <!-- Graphique 4: Répartition des notes -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Distribution des notes</h2>
                <select id="subjectFilter" 
                        class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                               focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                               dark:bg-gray-700 dark:text-white text-sm">
                    <option value="all">Toutes les matières</option>
                    <option value="math">Mathématiques</option>
                    <option value="french">Français</option>
                    <option value="science">Sciences</option>
                </select>
            </div>
            <div class="chart-container">
                <canvas id="gradesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tableaux détaillés -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Tableau des classes -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Classes et effectifs</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Classe
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Étudiants
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Remplissage
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($classes as $classe)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-orange-100 dark:bg-orange-900 
                                                    flex items-center justify-center">
                                            <span class="font-bold text-orange-600 dark:text-orange-400">
                                                {{ substr($classe->nom, 0, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $classe->nom }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $classe->enseignant->nom ?? 'Non attribué' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $classe->etudiants_count }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Max: 30</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                    <div class="bg-green-600 h-2.5 rounded-full" 
                                         style="width: {{ min(100, ($classe->etudiants_count / 30) * 100) }}%">
                                    </div>
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ number_format(($classe->etudiants_count / 30) * 100, 1) }}%
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-orange-600 hover:text-orange-900 dark:text-orange-400 
                                                   dark:hover:text-orange-300 mr-3">
                                    <i class="fas fa-chart-bar"></i>
                                </a>
                                <a href="#" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 
                                                   dark:hover:text-blue-300 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-green-600 hover:text-green-900 dark:text-green-400 
                                                   dark:hover:text-green-300">
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                <i class="fas fa-inbox text-4xl mb-4"></i>
                                <p>Aucune classe disponible</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                <a href="#" class="text-orange-600 hover:text-orange-800 dark:text-orange-400 
                                   font-medium text-sm">
                    Voir toutes les classes →
                </a>
            </div>
        </div>

        <!-- Tableau des performances -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Top 5 des classes performantes</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Classe
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Moyenne
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Évolution
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Rang
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @php
                            $topClasses = [
                                ['nom' => 'Terminale A', 'moyenne' => 16.5, 'evolution' => '+2.3%', 'rang' => 1],
                                ['nom' => '1ère B', 'moyenne' => 15.8, 'evolution' => '+1.7%', 'rang' => 2],
                                ['nom' => 'Terminale C', 'moyenne' => 15.2, 'evolution' => '+0.9%', 'rang' => 3],
                                ['nom' => '2nde A', 'moyenne' => 14.7, 'evolution' => '+1.2%', 'rang' => 4],
                                ['nom' => '1ère A', 'moyenne' => 14.3, 'evolution' => '-0.5%', 'rang' => 5],
                            ];
                        @endphp
                        @foreach($topClasses as $topClasse)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $topClasse['nom'] }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900 dark:text-white">
                                    {{ $topClasse['moyenne'] }}/20
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ strpos($topClasse['evolution'], '+') !== false ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                    {{ $topClasse['evolution'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($topClasse['rang'] == 1)
                                    <i class="fas fa-trophy text-yellow-500 text-xl mr-2"></i>
                                    @elseif($topClasse['rang'] == 2)
                                    <i class="fas fa-medal text-gray-400 text-xl mr-2"></i>
                                    @elseif($topClasse['rang'] == 3)
                                    <i class="fas fa-medal text-orange-600 text-xl mr-2"></i>
                                    @else
                                    <span class="text-gray-500 dark:text-gray-400 text-sm mr-2">
                                        #{{ $topClasse['rang'] }}
                                    </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Résumé et KPI -->
    <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-xl shadow-lg p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="text-white text-4xl font-bold mb-2">{{ $totalEtudiants ?? 0 }}</div>
                <div class="text-orange-100 text-sm">Étudiants inscrits</div>
            </div>
            <div class="text-center">
                <div class="text-white text-4xl font-bold mb-2">94.5%</div>
                <div class="text-orange-100 text-sm">Taux de présence moyen</div>
            </div>
            <div class="text-center">
                <div class="text-white text-4xl font-bold mb-2">15.2/20</div>
                <div class="text-orange-100 text-sm">Moyenne générale</div>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'export -->
<div id="exportModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-md w-full">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Exporter les rapports</h3>
                <button id="closeExportModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Format d'export
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="export-format-btn p-4 border-2 border-red-300 dark:border-red-700 
                                      bg-red-50 dark:bg-red-900/20 rounded-lg text-center"
                                data-format="pdf">
                            <i class="fas fa-file-pdf text-2xl text-red-600 dark:text-red-400 mb-2"></i>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">PDF</p>
                        </button>
                        <button class="export-format-btn p-4 border-2 border-green-300 dark:border-green-700 
                                      bg-green-50 dark:bg-green-900/20 rounded-lg text-center"
                                data-format="excel">
                            <i class="fas fa-file-excel text-2xl text-green-600 dark:text-green-400 mb-2"></i>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Excel</p>
                        </button>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Période
                    </label>
                    <select id="exportPeriod" 
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                                   focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                                   dark:bg-gray-700 dark:text-white">
                        <option value="current">Période actuelle</option>
                        <option value="month">Ce mois</option>
                        <option value="year">Cette année</option>
                        <option value="all">Toutes les données</option>
                    </select>
                </div>
                
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button id="startExport" 
                            class="w-full px-5 py-3 bg-orange-600 hover:bg-orange-700 text-white 
                                   font-medium rounded-lg transition flex items-center justify-center">
                        <i class="fas fa-download mr-2"></i>
                        <span>Générer le rapport</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
// Données pour les graphiques
const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
const inscriptionsData = [45, 52, 48, 65, 72, 78, 85, 92, 88, 95, 102, 110];

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les graphiques
    initCharts();
    
    // Événements des filtres
    setupEventListeners();
    
    // Initialiser Flatpickr pour les dates
    flatpickr("#startDate, #endDate", {
        dateFormat: "Y-m-d",
        locale: "fr"
    });
});

function initCharts() {
    // 1. Graphique des inscriptions (évolution)
    const inscriptionsCtx = document.getElementById('inscriptionsChart').getContext('2d');
    window.inscriptionsChart = new Chart(inscriptionsCtx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Inscriptions',
                data: inscriptionsData,
                borderColor: 'rgb(249, 115, 22)',
                backgroundColor: 'rgba(249, 115, 22, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgb(249, 115, 22)',
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 20
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // 2. Graphique de répartition par genre
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    window.genderChart = new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: ['Masculin', 'Féminin'],
            datasets: [{
                data: [65, 35],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(249, 115, 22, 0.8)'
                ],
                borderWidth: 2,
                borderColor: 'rgba(255, 255, 255, 0.8)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    formatter: (value) => {
                        return value + '%';
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // 3. Graphique de présence
    const presenceCtx = document.getElementById('presenceChart').getContext('2d');
    window.presenceChart = new Chart(presenceCtx, {
        type: 'bar',
        data: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven'],
            datasets: [{
                label: 'Taux de présence (%)',
                data: [95, 92, 96, 94, 98],
                backgroundColor: 'rgba(16, 185, 129, 0.7)',
                borderColor: 'rgb(16, 185, 129)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // 4. Graphique de distribution des notes
    const gradesCtx = document.getElementById('gradesChart').getContext('2d');
    window.gradesChart = new Chart(gradesCtx, {
        type: 'radar',
        data: {
            labels: ['Maths', 'Français', 'Sciences', 'Histoire', 'Anglais', 'Sport'],
            datasets: [{
                label: 'Moyenne par matière',
                data: [16.5, 14.2, 15.8, 13.5, 12.9, 17.2],
                backgroundColor: 'rgba(139, 92, 246, 0.2)',
                borderColor: 'rgb(139, 92, 246)',
                pointBackgroundColor: 'rgb(139, 92, 246)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(139, 92, 246)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    angleLines: {
                        display: true
                    },
                    suggestedMin: 0,
                    suggestedMax: 20,
                    ticks: {
                        stepSize: 5
                    }
                }
            }
        }
    });
}

function setupEventListeners() {
    // Filtre de période
    document.getElementById('periodFilter').addEventListener('change', function(e) {
        if (e.target.value === 'custom') {
            document.getElementById('customFilters').classList.remove('hidden');
        } else {
            document.getElementById('customFilters').classList.add('hidden');
            // Charger les données pour la période sélectionnée
            loadDataForPeriod(e.target.value);
        }
    });

    // Appliquer le filtre personnalisé
    document.getElementById('applyCustomFilter').addEventListener('click', function() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        
        if (!startDate || !endDate) {
            alert('Veuillez sélectionner les deux dates');
            return;
        }
        
        loadCustomPeriodData(startDate, endDate);
    });

    // Boutons de changement de type de graphique
    document.querySelectorAll('.chart-type-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const chartType = this.dataset.chart;
            const targetChart = this.dataset.target;
            
            // Mettre à jour l'état actif
            this.parentElement.querySelectorAll('.chart-type-btn').forEach(b => {
                b.classList.remove('active', 'bg-orange-600', 'text-white');
                b.classList.add('text-gray-700', 'dark:text-gray-300', 
                              'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            });
            
            this.classList.add('active', 'bg-orange-600', 'text-white');
            this.classList.remove('text-gray-700', 'dark:text-gray-300', 
                                'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            
            // Changer le type de graphique
            if (targetChart === 'inscriptionsChart' && window.inscriptionsChart) {
                window.inscriptionsChart.config.type = chartType;
                window.inscriptionsChart.update();
            }
        });
    });

    // Boutons d'export
    document.getElementById('exportPdf').addEventListener('click', showExportModal);
    document.getElementById('exportExcel').addEventListener('click', showExportModal);
    
    // Actualiser les données
    document.getElementById('refreshData').addEventListener('click', function() {
        this.classList.add('animate-spin');
        setTimeout(() => {
            this.classList.remove('animate-spin');
            // Simuler un rechargement des données
            loadDataForPeriod(document.getElementById('periodFilter').value);
            showToast('Données actualisées', 'success');
        }, 1000);
    });

    // Modal d'export
    document.getElementById('closeExportModal').addEventListener('click', hideExportModal);
    
    // Format d'export
    document.querySelectorAll('.export-format-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.export-format-btn').forEach(b => {
                b.classList.remove('border-orange-500', 'border-2');
            });
            this.classList.add('border-orange-500', 'border-2');
        });
    });

    // Démarrer l'export
    document.getElementById('startExport').addEventListener('click', function() {
        const format = document.querySelector('.export-format-btn.border-orange-500')?.dataset.format || 'pdf';
        const period = document.getElementById('exportPeriod').value;
        
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Génération...';
        this.disabled = true;
        
        // Simuler l'export
        setTimeout(() => {
            hideExportModal();
            this.innerHTML = '<i class="fas fa-download mr-2"></i> Générer le rapport';
            this.disabled = false;
            
            showToast(`Rapport ${format.toUpperCase()} généré avec succès`, 'success');
            
            // Simuler le téléchargement
            const link = document.createElement('a');
            link.href = '#';
            link.download = `rapport_${period}_${new Date().toISOString().split('T')[0]}.${format}`;
            link.click();
        }, 2000);
    });
}

// Fonctions utilitaires
function loadDataForPeriod(period) {
    // Simuler le chargement des données
    showToast(`Chargement des données pour ${period}...`, 'info');
    
    setTimeout(() => {
        // Mettre à jour les graphiques avec de nouvelles données
        const newData = generateRandomData(12);
        window.inscriptionsChart.data.datasets[0].data = newData;
        window.inscriptionsChart.update();
        
        showToast('Données mises à jour', 'success');
    }, 1000);
}

function loadCustomPeriodData(startDate, endDate) {
    showToast(`Chargement des données du ${startDate} au ${endDate}...`, 'info');
    
    setTimeout(() => {
        // Simuler des données personnalisées
        const customData = generateRandomData(8);
        window.inscriptionsChart.data.labels = ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7', 'Sem 8'];
        window.inscriptionsChart.data.datasets[0].data = customData;
        window.inscriptionsChart.update();
        
        showToast('Données personnalisées chargées', 'success');
    }, 1500);
}

function generateRandomData(count) {
    return Array.from({length: count}, () => Math.floor(Math.random() * 100) + 20);
}

function showExportModal() {
    document.getElementById('exportModal').classList.remove('hidden');
    document.getElementById('exportModal').classList.add('flex');
}

function hideExportModal() {
    document.getElementById('exportModal').classList.add('hidden');
    document.getElementById('exportModal').classList.remove('flex');
}

function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium ${
        type === 'success' ? 'bg-green-500' :
        type === 'error' ? 'bg-red-500' :
        type === 'warning' ? 'bg-yellow-500' :
        'bg-blue-500'
    }`;
    toast.textContent = message;
    toast.style.zIndex = '9999';
    
    document.body.appendChild(toast);
    
    setTimeout(() => toast.remove(), 3000);
}

// Fermer modals au clic extérieur
document.addEventListener('click', function(e) {
    if (e.target.id === 'exportModal') {
        hideExportModal();
    }
});
</script>
@endpush
@endsection