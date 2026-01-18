@extends('layouts.app')

@section('title', 'Calendrier')

@section('content')
<div class="container-fluid px-4 py-6">
    <!-- En-tête -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Calendrier Scolaire</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">
                Gérez les événements, cours, examens et réunions
            </p>
        </div>
        
        <div class="mt-4 md:mt-0 flex space-x-3">
            <!-- Bouton création événement -->
            <button id="createEventBtn" 
                    class="flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                <span>Nouvel événement</span>
            </button>
            
            <!-- Filtres -->
            <div class="relative">
                <button id="filterBtn" 
                        class="flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg transition">
                    <i class="fas fa-filter mr-2"></i>
                    <span>Filtrer</span>
                </button>
                
                <!-- Dropdown filtres -->
                <div id="filterDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-10">
                    <div class="p-3">
                        <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Type d'événement</h6>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="event-type-filter" value="cours" checked>
                                <span class="ml-2 text-sm">Cours</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="event-type-filter" value="examen" checked>
                                <span class="ml-2 text-sm">Examens</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="event-type-filter" value="réunion" checked>
                                <span class="ml-2 text-sm">Réunions</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="event-type-filter" value="événement" checked>
                                <span class="ml-2 text-sm">Événements</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 mr-4">
                    <i class="fas fa-calendar-day text-blue-600 dark:text-blue-300"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Aujourd'hui</p>
                    <p class="text-xl font-bold" id="statsToday">{{ $todayEvents }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 mr-4">
                    <i class="fas fa-calendar-week text-green-600 dark:text-green-300"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Cette semaine</p>
                    <p class="text-xl font-bold" id="statsWeek">{{ $weekEvents }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 mr-4">
                    <i class="fas fa-chalkboard-teacher text-purple-600 dark:text-purple-300"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Mes événements</p>
                    <p class="text-xl font-bold" id="statsMyEvents">{{ $myEvents ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 mr-4">
                    <i class="fas fa-file-alt text-red-600 dark:text-red-300"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Examens</p>
                    <p class="text-xl font-bold" id="statsExams">{{ $examEvents }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendrier -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <!-- En-tête du calendrier -->
        <div class="border-b border-gray-200 dark:border-gray-700 p-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div class="flex items-center space-x-4 mb-4 md:mb-0">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        <span id="calendarMonth">Mois</span> <span id="calendarYear">2024</span>
                    </h2>
                    <div class="flex space-x-2">
                        <button id="prevMonth" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button id="todayBtn" class="px-3 py-2 text-sm bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg">
                            Aujourd'hui
                        </button>
                        <button id="nextMonth" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center space-x-2">
                    <button id="viewMonth" class="px-4 py-2 text-sm font-medium bg-orange-600 text-white rounded-lg">
                        Mois
                    </button>
                    <button id="viewWeek" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        Semaine
                    </button>
                    <button id="viewDay" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        Jour
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Grille du calendrier -->
        <div class="p-4">
            <!-- En-tête des jours -->
            <div class="grid grid-cols-7 mb-4">
                <div class="text-center font-medium text-gray-500 dark:text-gray-400 p-2">Dim</div>
                <div class="text-center font-medium text-gray-500 dark:text-gray-400 p-2">Lun</div>
                <div class="text-center font-medium text-gray-500 dark:text-gray-400 p-2">Mar</div>
                <div class="text-center font-medium text-gray-500 dark:text-gray-400 p-2">Mer</div>
                <div class="text-center font-medium text-gray-500 dark:text-gray-400 p-2">Jeu</div>
                <div class="text-center font-medium text-gray-500 dark:text-gray-400 p-2">Ven</div>
                <div class="text-center font-medium text-gray-500 dark:text-gray-400 p-2">Sam</div>
            </div>
            
            <!-- Jours du mois -->
            <div id="calendarGrid" class="grid grid-cols-7 gap-1">
                <!-- Les jours seront générés par JavaScript -->
            </div>
        </div>
    </div>

    <!-- Événements à venir (liste) -->
    <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Événements à venir</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="upcomingEventsList">
            @forelse($upcomingEvents as $event)
            <div class="event-card bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-{{ 
                $event->type === 'examen' ? 'red' : 
                ($event->type === 'cours' ? 'blue' : 
                ($event->type === 'réunion' ? 'green' : 'orange')) 
            }}-500" data-event-id="{{ $event->id }}">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $event->title }}</h4>
                        <div class="flex items-center mt-2 text-sm text-gray-600 dark:text-gray-400">
                            <i class="far fa-clock mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($event->start)->format('d/m/Y H:i') }}</span>
                            @if($event->end)
                            <span class="mx-2">-</span>
                            <span>{{ \Carbon\Carbon::parse($event->end)->format('H:i') }}</span>
                            @endif
                        </div>
                    </div>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ 
                        $event->type === 'examen' ? 'red' : 
                        ($event->type === 'cours' ? 'blue' : 
                        ($event->type === 'réunion' ? 'green' : 'orange')) 
                    }}-100 text-{{ 
                        $event->type === 'examen' ? 'red' : 
                        ($event->type === 'cours' ? 'blue' : 
                        ($event->type === 'réunion' ? 'green' : 'orange')) 
                    }}-800">
                        {{ ucfirst($event->type) }}
                    </span>
                </div>
                
                @if($event->description)
                <p class="mt-3 text-gray-600 dark:text-gray-400 text-sm">{{ Str::limit($event->description, 100) }}</p>
                @endif
                
                <div class="mt-4 flex justify-end space-x-2">
                    <button class="edit-event-btn px-3 py-1 text-sm text-blue-600 hover:text-blue-800" 
                            data-event-id="{{ $event->id }}">
                        <i class="far fa-edit mr-1"></i> Modifier
                    </button>
                    <button class="delete-event-btn px-3 py-1 text-sm text-red-600 hover:text-red-800"
                            data-event-id="{{ $event->id }}">
                        <i class="far fa-trash-alt mr-1"></i> Supprimer
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-10" id="noEventsMessage">
                <i class="fas fa-calendar-times text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
                <p class="text-gray-500 dark:text-gray-400">Aucun événement à venir</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal pour événement -->
<div id="eventModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <!-- En-tête modal -->
            <div class="flex justify-between items-center mb-6">
                <h3 id="modalTitle" class="text-xl font-bold text-gray-900 dark:text-white">Nouvel événement</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Formulaire -->
            <form id="eventForm">
                @csrf
                <input type="hidden" id="eventId" name="id">
                
                <!-- Titre -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Titre *
                    </label>
                    <input type="text" id="title" name="title" required
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                                  focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                                  dark:bg-gray-700 dark:text-white transition">
                </div>
                
                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                                     focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                                     dark:bg-gray-700 dark:text-white transition"></textarea>
                </div>
                
                <!-- Dates -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Début *
                        </label>
                        <input type="datetime-local" id="start_date" name="start_date" required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                                      dark:bg-gray-700 dark:text-white transition">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Fin
                        </label>
                        <input type="datetime-local" id="end_date" name="end_date"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                                      dark:bg-gray-700 dark:text-white transition">
                    </div>
                </div>
                
                <!-- Type et couleur -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Type *
                        </label>
                        <select id="type" name="type" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                                       focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                                       dark:bg-gray-700 dark:text-white transition">
                            <option value="cours">Cours</option>
                            <option value="examen">Examen</option>
                            <option value="réunion">Réunion</option>
                            <option value="événement">Événement</option>
                            <option value="vacances">Vacances</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Couleur
                        </label>
                        <div class="flex items-center">
                            <input type="color" id="color" name="color" value="#3b82f6"
                                   class="w-10 h-10 p-1 border border-gray-300 dark:border-gray-600 rounded-lg 
                                          dark:bg-gray-700 cursor-pointer">
                            <span id="colorValue" class="ml-3 text-sm text-gray-600 dark:text-gray-400">#3b82f6</span>
                        </div>
                    </div>
                </div>
                
                <!-- Visibilité -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_public" value="1"
                               class="mr-2 rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            Événement public (visible par tous)
                        </span>
                    </label>
                </div>
                
                <!-- Boutons -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" id="cancelBtn"
                            class="px-5 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 
                                   dark:hover:text-white font-medium">
                        Annuler
                    </button>
                    <button type="submit"
                            class="px-5 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium 
                                   rounded-lg transition flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        <span id="submitBtnText">Créer</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts JavaScript -->
@push('scripts')
<script>
// Variables globales
let currentDate = new Date();
let currentView = 'month';

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Charger le calendrier
    renderCalendar();
    
    // Événements
    document.getElementById('createEventBtn').addEventListener('click', openCreateModal);
    document.getElementById('filterBtn').addEventListener('click', toggleFilterDropdown);
    document.getElementById('prevMonth').addEventListener('click', prevMonth);
    document.getElementById('nextMonth').addEventListener('click', nextMonth);
    document.getElementById('todayBtn').addEventListener('click', goToToday);
    document.getElementById('viewMonth').addEventListener('click', () => switchView('month'));
    document.getElementById('viewWeek').addEventListener('click', () => switchView('week'));
    document.getElementById('viewDay').addEventListener('click', () => switchView('day'));
    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('cancelBtn').addEventListener('click', closeModal);
    document.getElementById('color').addEventListener('input', updateColorValue);
    document.getElementById('eventForm').addEventListener('submit', handleFormSubmit);
    
    // Fermer modals au clic extérieur
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#filterDropdown') && !e.target.closest('#filterBtn')) {
            document.getElementById('filterDropdown').classList.add('hidden');
        }
        
        if (e.target.id === 'eventModal') {
            closeModal();
        }
    });
    
    // Déléguer les événements pour les boutons dynamiques
    document.addEventListener('click', function(e) {
        // Bouton modifier
        if (e.target.closest('.edit-event-btn')) {
            const eventId = e.target.closest('.edit-event-btn').dataset.eventId;
            openEditModal(eventId);
        }
        
        // Bouton supprimer
        if (e.target.closest('.delete-event-btn')) {
            const eventId = e.target.closest('.delete-event-btn').dataset.eventId;
            deleteEvent(eventId);
        }
        
        // Bouton ajouter événement sur un jour
        if (e.target.closest('.add-event-day')) {
            const day = e.target.closest('.add-event-day').dataset.day;
            openCreateModalWithDate(day);
        }
        
        // Clic sur un événement dans le calendrier
        if (e.target.closest('.event-item')) {
            const eventId = e.target.closest('.event-item').dataset.eventId;
            openEditModal(eventId);
        }
    });
});

// Fonctions du calendrier
function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const monthNames = [
        'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
        'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
    ];
    
    // Mettre à jour l'en-tête
    document.getElementById('calendarMonth').textContent = monthNames[month];
    document.getElementById('calendarYear').textContent = year;
    
    // Calculer les jours
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const daysInMonth = lastDay.getDate();
    const startingDay = firstDay.getDay();
    
    // Générer la grille
    const grid = document.getElementById('calendarGrid');
    grid.innerHTML = '';
    
    // Jours vides au début
    for (let i = 0; i < startingDay; i++) {
        grid.appendChild(createDayElement('', true));
    }
    
    // Jours du mois
    for (let day = 1; day <= daysInMonth; day++) {
        const dayDate = new Date(year, month, day);
        const isToday = isSameDay(dayDate, new Date());
        grid.appendChild(createDayElement(day, false, isToday));
    }
    
    // Charger les événements pour ce mois
    loadEventsForMonth(year, month + 1);
}

function createDayElement(day, empty = false, isToday = false) {
    const div = document.createElement('div');
    div.className = `min-h-24 p-2 border border-gray-200 dark:border-gray-700 ${
        empty ? 'bg-gray-50 dark:bg-gray-900' : 'bg-white dark:bg-gray-800'
    }`;
    
    if (!empty) {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth() + 1;
        const dateStr = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
        
        div.innerHTML = `
            <div class="flex justify-between items-start">
                <span class="text-sm font-medium ${
                    isToday 
                    ? 'bg-orange-600 text-white rounded-full w-6 h-6 flex items-center justify-center' 
                    : 'text-gray-900 dark:text-white'
                }">
                    ${day}
                </span>
                <button class="add-event-day text-gray-400 hover:text-orange-600" 
                        data-day="${day}"
                        title="Ajouter un événement">
                    <i class="fas fa-plus text-xs"></i>
                </button>
            </div>
            <div class="mt-2 space-y-1" id="events-day-${dateStr}">
                <!-- Événements seront ajoutés ici -->
            </div>
        `;
    }
    
    return div;
}

// Navigation calendrier
function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

function goToToday() {
    currentDate = new Date();
    renderCalendar();
}

function switchView(view) {
    currentView = view;
    
    // Mettre à jour les boutons actifs
    document.getElementById('viewMonth').className = 
        view === 'month' 
        ? 'px-4 py-2 text-sm font-medium bg-orange-600 text-white rounded-lg'
        : 'px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg';
    
    document.getElementById('viewWeek').className = 
        view === 'week'
        ? 'px-4 py-2 text-sm font-medium bg-orange-600 text-white rounded-lg'
        : 'px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg';
    
    document.getElementById('viewDay').className = 
        view === 'day'
        ? 'px-4 py-2 text-sm font-medium bg-orange-600 text-white rounded-lg'
        : 'px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg';
    
    // TODO: Implémenter le changement de vue
    showToast(`Vue ${view} - À implémenter`, 'info');
}

// Modals
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Nouvel événement';
    document.getElementById('submitBtnText').textContent = 'Créer';
    document.getElementById('eventId').value = '';
    document.getElementById('eventForm').reset();
    document.getElementById('color').value = '#3b82f6';
    document.getElementById('colorValue').textContent = '#3b82f6';
    document.getElementById('eventForm').querySelector('[name="is_public"]').checked = false;
    
    // Date par défaut (aujourd'hui)
    const now = new Date();
    const localDateTime = now.toISOString().slice(0, 16);
    document.getElementById('start_date').value = localDateTime;
    
    // Date de fin (1 heure après)
    const endDate = new Date(now.getTime() + 60 * 60 * 1000);
    document.getElementById('end_date').value = endDate.toISOString().slice(0, 16);
    
    document.getElementById('eventModal').classList.remove('hidden');
    document.getElementById('eventModal').classList.add('flex');
}

function openCreateModalWithDate(day) {
    openCreateModal();
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth() + 1;
    const dateStr = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}T09:00`;
    document.getElementById('start_date').value = dateStr;
    
    // Date de fin (2 heures après)
    const endDate = new Date(dateStr);
    endDate.setHours(endDate.getHours() + 2);
    document.getElementById('end_date').value = endDate.toISOString().slice(0, 16);
}

function openEditModal(eventId) {
    fetch(`/calendrier/${eventId}/edit`)
        .then(response => {
            if (!response.ok) throw new Error('Non autorisé');
            return response.json();
        })
        .then(event => {
            document.getElementById('modalTitle').textContent = 'Modifier événement';
            document.getElementById('submitBtnText').textContent = 'Modifier';
            document.getElementById('eventId').value = event.id;
            document.getElementById('title').value = event.title;
            document.getElementById('description').value = event.description || '';
            document.getElementById('type').value = event.type;
            document.getElementById('color').value = event.color || '#3b82f6';
            document.getElementById('colorValue').textContent = event.color || '#3b82f6';
            
            if (event.is_public) {
                document.getElementById('eventForm').querySelector('[name="is_public"]').checked = true;
            }
            
            // Formater les dates (utiliser 'start' et 'end' de la base de données)
            const startDate = new Date(event.start);
            const endDate = event.end ? new Date(event.end) : null;
            
            document.getElementById('start_date').value = formatDateTimeForInput(startDate);
            if (endDate) {
                document.getElementById('end_date').value = formatDateTimeForInput(endDate);
            }
            
            document.getElementById('eventModal').classList.remove('hidden');
            document.getElementById('eventModal').classList.add('flex');
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Erreur lors du chargement', 'error');
        });
}

function closeModal() {
    document.getElementById('eventModal').classList.add('hidden');
    document.getElementById('eventModal').classList.remove('flex');
}

// Form submission
function handleFormSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    const isEdit = !!data.id;
    
    const url = isEdit ? `/calendrier/${data.id}` : '/calendrier';
    const method = isEdit ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            showToast(result.message, 'success');
            closeModal();
            
            // Ajouter l'événement au calendrier
            if (result.event) {
                addEventToCalendar(result.event);
                updateEventStats();
            }
        } else {
            showToast(result.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Erreur lors de l\'enregistrement', 'error');
    });
}

// Suppression
function deleteEvent(eventId) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) return;
    
    fetch(`/calendrier/${eventId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            showToast('Événement supprimé', 'success');
            
            // Supprimer du calendrier
            document.querySelectorAll(`[data-event-id="${eventId}"]`).forEach(el => {
                el.remove();
            });
            
            // Supprimer de la liste
            const eventCard = document.querySelector(`.event-card[data-event-id="${eventId}"]`);
            if (eventCard) {
                eventCard.remove();
                
                // Vérifier si la liste est vide
                const eventsList = document.getElementById('upcomingEventsList');
                if (eventsList.children.length === 0) {
                    eventsList.innerHTML = `
                        <div class="col-span-3 text-center py-10" id="noEventsMessage">
                            <i class="fas fa-calendar-times text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
                            <p class="text-gray-500 dark:text-gray-400">Aucun événement à venir</p>
                        </div>
                    `;
                }
            }
            
            updateEventStats();
        } else {
            showToast(result.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Erreur lors de la suppression', 'error');
    });
}

// Fonction pour charger les événements d'un mois
function loadEventsForMonth(year, month) {
    fetch(`/calendrier/events?year=${year}&month=${month}`)
        .then(response => response.json())
        .then(events => {
            events.forEach(event => {
                displayEventInCalendar(event);
            });
        })
        .catch(error => console.error('Error loading events:', error));
}

// Fonction pour afficher un événement dans le calendrier
function displayEventInCalendar(event) {
    const eventDate = new Date(event.start);
    const dateStr = eventDate.toISOString().split('T')[0];
    const dayElement = document.getElementById(`events-day-${dateStr}`);
    
    if (dayElement) {
        // Vérifier si l'événement existe déjà
        const existingEvent = dayElement.querySelector(`[data-event-id="${event.id}"]`);
        if (existingEvent) {
            existingEvent.remove();
        }
        
        // Créer l'élément de l'événement
        const eventElement = document.createElement('div');
        eventElement.className = `event-item text-xs truncate px-2 py-1 rounded mb-1 cursor-pointer`;
        eventElement.style.backgroundColor = event.color || getColorByType(event.type);
        eventElement.style.color = getContrastColor(event.color || getColorByType(event.type));
        eventElement.textContent = event.title;
        eventElement.title = `${event.title}\n${formatTime(event.start)}${event.end ? ' - ' + formatTime(event.end) : ''}`;
        eventElement.dataset.eventId = event.id;
        
        dayElement.appendChild(eventElement);
    }
}

// Fonction pour ajouter un événement au calendrier
function addEventToCalendar(event) {
    // Afficher dans le calendrier
    displayEventInCalendar(event);
    
    // Ajouter à la liste des événements à venir si applicable
    const eventDate = new Date(event.start);
    const now = new Date();
    const weekFromNow = new Date();
    weekFromNow.setDate(now.getDate() + 7);
    
    if (eventDate >= now && eventDate <= weekFromNow) {
        addEventToUpcomingList(event);
    }
}

// Fonction pour ajouter un événement à la liste des événements à venir
function addEventToUpcomingList(event) {
    const eventsList = document.getElementById('upcomingEventsList');
    
    // Supprimer le message "Aucun événement" s'il existe
    const noEventsMessage = document.getElementById('noEventsMessage');
    if (noEventsMessage) {
        noEventsMessage.remove();
    }
    
    // Vérifier si l'événement existe déjà
    const existingCard = eventsList.querySelector(`[data-event-id="${event.id}"]`);
    if (existingCard) {
        existingCard.remove();
    }
    
    // Créer la carte d'événement
    const eventCard = document.createElement('div');
    eventCard.className = `event-card bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-${ 
        event.type === 'examen' ? 'red' : 
        (event.type === 'cours' ? 'blue' : 
        (event.type === 'réunion' ? 'green' : 'orange')) 
    }-500`;
    eventCard.dataset.eventId = event.id;
    
    const startDate = new Date(event.start);
    const endDate = event.end ? new Date(event.end) : null;
    
    eventCard.innerHTML = `
        <div class="flex justify-between items-start">
            <div>
                <h4 class="font-semibold text-gray-900 dark:text-white">${event.title}</h4>
                <div class="flex items-center mt-2 text-sm text-gray-600 dark:text-gray-400">
                    <i class="far fa-clock mr-2"></i>
                    <span>${formatDate(startDate)}</span>
                    ${endDate ? `<span class="mx-2">-</span><span>${formatTime(endDate)}</span>` : ''}
                </div>
            </div>
            <span class="px-2 py-1 text-xs font-medium rounded-full bg-${ 
                event.type === 'examen' ? 'red' : 
                (event.type === 'cours' ? 'blue' : 
                (event.type === 'réunion' ? 'green' : 'orange')) 
            }-100 text-${ 
                event.type === 'examen' ? 'red' : 
                (event.type === 'cours' ? 'blue' : 
                (event.type === 'réunion' ? 'green' : 'orange')) 
            }-800">
                ${capitalizeFirstLetter(event.type)}
            </span>
        </div>
        
        ${event.description ? `<p class="mt-3 text-gray-600 dark:text-gray-400 text-sm">${limitText(event.description, 100)}</p>` : ''}
        
        <div class="mt-4 flex justify-end space-x-2">
            <button class="edit-event-btn px-3 py-1 text-sm text-blue-600 hover:text-blue-800" 
                    data-event-id="${event.id}">
                <i class="far fa-edit mr-1"></i> Modifier
            </button>
            <button class="delete-event-btn px-3 py-1 text-sm text-red-600 hover:text-red-800"
                    data-event-id="${event.id}">
                <i class="far fa-trash-alt mr-1"></i> Supprimer
            </button>
        </div>
    `;
    
    // Insérer au début de la liste
    eventsList.insertBefore(eventCard, eventsList.firstChild);
}

// Mettre à jour les statistiques
function updateEventStats() {
    fetch('/calendrier/stats')
        .then(response => response.json())
        .then(stats => {
            document.getElementById('statsToday').textContent = stats.today;
            document.getElementById('statsWeek').textContent = stats.week;
            document.getElementById('statsMyEvents').textContent = stats.myEvents;
            document.getElementById('statsExams').textContent = stats.exams;
        })
        .catch(error => console.error('Error updating stats:', error));
}

// Utilitaires
function toggleFilterDropdown() {
    const dropdown = document.getElementById('filterDropdown');
    dropdown.classList.toggle('hidden');
}

function updateColorValue(e) {
    document.getElementById('colorValue').textContent = e.target.value;
}

function formatDateTimeForInput(date) {
    const offset = date.getTimezoneOffset() * 60000;
    return new Date(date.getTime() - offset).toISOString().slice(0, 16);
}

function isSameDay(date1, date2) {
    return date1.getDate() === date2.getDate() &&
           date1.getMonth() === date2.getMonth() &&
           date1.getFullYear() === date2.getFullYear();
}

function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium ${
        type === 'success' ? 'bg-green-500' :
        type === 'error' ? 'bg-red-500' :
        'bg-blue-500'
    }`;
    toast.textContent = message;
    toast.style.zIndex = '9999';
    
    document.body.appendChild(toast);
    
    setTimeout(() => toast.remove(), 3000);
}

function formatTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString('fr-FR', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
}

function formatDate(date) {
    return date.toLocaleDateString('fr-FR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function getColorByType(type) {
    const colors = {
        'cours': '#3b82f6',
        'examen': '#ef4444',
        'réunion': '#10b981',
        'événement': '#f59e0b',
        'vacances': '#8b5cf6',
        'autre': '#6b7280'
    };
    return colors[type] || '#3b82f6';
}

function getContrastColor(hexColor) {
    // Convertir la couleur hex en RGB
    const r = parseInt(hexColor.substr(1, 2), 16);
    const g = parseInt(hexColor.substr(3, 2), 16);
    const b = parseInt(hexColor.substr(5, 2), 16);
    
    // Calculer la luminance relative
    const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
    
    return luminance > 0.5 ? '#000000' : '#ffffff';
}

function limitText(text, limit) {
    return text.length > limit ? text.substring(0, limit) + '...' : text;
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
</script>
@endpush
@endsection