@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-8 px-4">
    <div class="max-w-5xl mx-auto">
        
        {{-- EN-TÊTE --}}
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                        <i class="fas fa-bell text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Notifications</h1>
                        <p class="text-gray-600 mt-1">Toutes vos notifications en un seul endroit</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    @if($notifications->count() > 0)
                        <button onclick="markAllAsRead()" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-check-double mr-2"></i>Tout marquer comme lu
                        </button>
                        <button onclick="clearAllNotifications()" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash mr-2"></i>Tout supprimer
                        </button>
                    @endif
                </div>
            </div>
            
            {{-- STATISTIQUES --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $notifications->total() }}</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <i class="fas fa-bell text-blue-600"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Non lues</p>
                            <p class="text-2xl font-bold text-gray-900">
                                @php
                                    $unreadCount = 0;
                                    if (method_exists(Auth::user(), 'unreadNotifications')) {
                                        $unreadCount = Auth::user()->unreadNotifications()->count();
                                    }
                                @endphp
                                {{ $unreadCount }}
                            </p>
                        </div>
                        <div class="p-3 bg-red-50 rounded-lg">
                            <i class="fas fa-envelope text-red-600"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Dernière</p>
                            <p class="text-lg font-bold text-gray-900">
                                @if($notifications->count() > 0)
                                    {{ $notifications->first()->created_at->diffForHumans() }}
                                @else
                                    Jamais
                                @endif
                            </p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-lg">
                            <i class="fas fa-clock text-green-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- LISTE DES NOTIFICATIONS --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            {{-- FILTRES --}}
            <div class="bg-gray-50 px-6 py-4 border-b">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">
                            {{ $notifications->count() }} notification(s) sur {{ $notifications->total() }}
                        </span>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('notifications.index', ['filter' => 'all']) }}" 
                           class="px-3 py-1 text-sm rounded-lg {{ request('filter', 'all') == 'all' ? 'bg-blue-600 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                            Toutes
                        </a>
                        <a href="{{ route('notifications.index', ['filter' => 'unread']) }}" 
                           class="px-3 py-1 text-sm rounded-lg {{ request('filter') == 'unread' ? 'bg-blue-600 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                            Non lues
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- MESSAGE VIDE --}}
            @if($notifications->count() == 0)
                <div class="py-16 text-center">
                    <div class="text-gray-400 mb-6">
                        <i class="fas fa-bell-slash text-6xl mb-4"></i>
                        <p class="text-xl font-medium">Aucune notification</p>
                        <p class="text-sm mt-2">Vous n'avez aucune notification pour le moment.</p>
                    </div>
                    <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
                    </a>
                </div>
            @else
                {{-- LISTE --}}
                <div class="divide-y divide-gray-100">
                    @foreach($notifications as $notification)
                        @php
                            $data = $notification->data ?? [];
                            $type = $data['type'] ?? 'info';
                            $icon = $data['icon'] ?? 'fas fa-info-circle';
                            $bgColor = match($type) {
                                'success' => 'bg-green-50 border-green-200',
                                'warning' => 'bg-yellow-50 border-yellow-200',
                                'error' => 'bg-red-50 border-red-200',
                                'info' => 'bg-blue-50 border-blue-200',
                                default => 'bg-gray-50 border-gray-200'
                            };
                            $iconColor = match($type) {
                                'success' => 'text-green-600',
                                'warning' => 'text-yellow-600',
                                'error' => 'text-red-600',
                                default => 'text-blue-600'
                            };
                            $isRead = isset($notification->read_at) ? $notification->read_at : false;
                        @endphp
                        
                        <div class="p-6 hover:bg-gray-50 transition-colors {{ !$isRead ? 'bg-blue-50' : '' }}" 
                             id="notification-{{ $notification->id }}">
                            <div class="flex items-start gap-4">
                                {{-- ICÔNE --}}
                                <div class="p-3 {{ $bgColor }} rounded-xl border">
                                    <i class="{{ $icon }} {{ $iconColor }} text-lg"></i>
                                </div>
                                
                                {{-- CONTENU --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <h3 class="font-semibold text-gray-900">
                                                {{ $data['title'] ?? 'Notification' }}
                                                @if(!$isRead)
                                                    <span class="ml-2 inline-block w-2 h-2 bg-blue-600 rounded-full"></span>
                                                @endif
                                            </h3>
                                            <p class="text-sm text-gray-500 mt-1">
                                                <i class="far fa-clock mr-1"></i>
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            @if(!$isRead)
                                                <button onclick="markAsRead('{{ $notification->id }}')" 
                                                        class="p-2 text-gray-400 hover:text-green-600"
                                                        title="Marquer comme lu">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @endif
                                            <button onclick="deleteNotification('{{ $notification->id }}')" 
                                                    class="p-2 text-gray-400 hover:text-red-600"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <p class="text-gray-700 mb-3">
                                        {{ $data['message'] ?? $notification->data ?? 'Notification sans message' }}
                                    </p>
                                    
                                    @if(!empty($data['action_url']))
                                        <div class="mt-4">
                                            <a href="{{ $data['action_url'] }}" 
                                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all text-sm font-medium">
                                                <i class="fas fa-external-link-alt mr-2"></i>
                                                {{ $data['action_text'] ?? 'Voir plus' }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                {{-- PAGINATION --}}
                @if($notifications->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t">
                        {{ $notifications->links() }}
                    </div>
                @endif
            @endif
        </div>
        
        {{-- ACTIONS RAPIDES --}}
        @if($notifications->count() > 0)
            <div class="mt-8 flex justify-center gap-4">
                <button onclick="markAllAsRead()" 
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-check-double mr-2"></i>Tout marquer comme lu
                </button>
                <button onclick="clearAllNotifications()" 
                        class="px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-lg hover:from-red-700 hover:to-pink-700 transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-trash mr-2"></i>Tout supprimer
                </button>
            </div>
        @endif
    </div>
</div>

{{-- MODALE DE CONFIRMATION --}}
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="p-3 bg-red-100 rounded-full">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Confirmation</h3>
        </div>
        <p class="text-gray-600 mb-6" id="confirmMessage">
            Êtes-vous sûr de vouloir supprimer cette notification ?
        </p>
        <input type="hidden" id="notificationId">
        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                Annuler
            </button>
            <button type="button" onclick="confirmAction()" id="confirmButton" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                Confirmer
            </button>
        </div>
    </div>
</div>

{{-- SCRIPTS JS --}}
<script>
let currentAction = '';
let currentNotificationId = '';

function markAsRead(notificationId) {
    fetch(`/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mettre à jour l'affichage
            const notification = document.getElementById(`notification-${notificationId}`);
            if (notification) {
                notification.classList.remove('bg-blue-50');
                const badge = notification.querySelector('.bg-blue-600');
                if (badge) badge.remove();
                
                // Mettre à jour le bouton
                const buttons = notification.querySelectorAll('button');
                buttons.forEach(btn => {
                    if (btn.innerHTML.includes('fa-check')) {
                        btn.remove();
                    }
                });
            }
            
            // Mettre à jour le compteur
            updateUnreadCount();
            
            showNotification('Notification marquée comme lue', 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Erreur lors de la mise à jour', 'error');
    });
}

function markAllAsRead() {
    if (!confirm('Êtes-vous sûr de vouloir marquer toutes les notifications comme lues ?')) {
        return;
    }
    
    fetch(`/notifications/mark-all-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mettre à jour toutes les notifications
            document.querySelectorAll('[id^="notification-"]').forEach(notification => {
                notification.classList.remove('bg-blue-50');
                const badge = notification.querySelector('.bg-blue-600');
                if (badge) badge.remove();
                
                // Supprimer les boutons "marquer comme lu"
                notification.querySelectorAll('button').forEach(btn => {
                    if (btn.innerHTML.includes('fa-check')) {
                        btn.remove();
                    }
                });
            });
            
            // Mettre à jour le compteur
            updateUnreadCount();
            
            showNotification('Toutes les notifications ont été marquées comme lues', 'success');
        }
    });
}

function deleteNotification(notificationId) {
    currentAction = 'delete';
    currentNotificationId = notificationId;
    document.getElementById('confirmMessage').textContent = 'Êtes-vous sûr de vouloir supprimer cette notification ? Cette action est irréversible.';
    document.getElementById('confirmButton').className = 'px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700';
    document.getElementById('confirmButton').innerHTML = 'Supprimer';
    openModal();
}

function clearAllNotifications() {
    currentAction = 'clearAll';
    document.getElementById('confirmMessage').textContent = 'Êtes-vous sûr de vouloir supprimer TOUTES vos notifications ? Cette action est irréversible.';
    document.getElementById('confirmButton').className = 'px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700';
    document.getElementById('confirmButton').innerHTML = 'Tout supprimer';
    openModal();
}

function openModal() {
    document.getElementById('confirmModal').classList.remove('hidden');
    document.getElementById('confirmModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('confirmModal').classList.add('hidden');
    document.getElementById('confirmModal').classList.remove('flex');
    currentAction = '';
    currentNotificationId = '';
}

function confirmAction() {
    if (currentAction === 'delete') {
        fetch(`/notifications/${currentNotificationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const notification = document.getElementById(`notification-${currentNotificationId}`);
                if (notification) {
                    notification.remove();
                }
                updateUnreadCount();
                showNotification('Notification supprimée', 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Erreur lors de la suppression', 'error');
        });
        
    } else if (currentAction === 'clearAll') {
        fetch(`/notifications/clear-all`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Supprimer toutes les notifications de la liste
                const notificationsList = document.querySelector('.divide-y');
                if (notificationsList) {
                    notificationsList.innerHTML = `
                        <div class="py-16 text-center">
                            <div class="text-gray-400 mb-6">
                                <i class="fas fa-bell-slash text-6xl mb-4"></i>
                                <p class="text-xl font-medium">Aucune notification</p>
                                <p class="text-sm mt-2">Vous n'avez aucune notification pour le moment.</p>
                            </div>
                        </div>
                    `;
                }
                updateUnreadCount();
                showNotification('Toutes les notifications ont été supprimées', 'success');
            }
        });
    }
    
    closeModal();
}

function updateUnreadCount() {
    fetch(`/notifications/unread-count`)
        .then(response => response.json())
        .then(data => {
            // Mettre à jour le compteur dans le header si existant
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            }
            
            // Mettre à jour le compteur dans la page
            const unreadElement = document.querySelector('.unread-count');
            if (unreadElement) {
                unreadElement.textContent = data.count;
            }
        });
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium transform transition-transform duration-300 z-50`;
    
    switch(type) {
        case 'success':
            notification.classList.add('bg-green-500');
            break;
        case 'error':
            notification.classList.add('bg-red-500');
            break;
        case 'warning':
            notification.classList.add('bg-yellow-500');
            break;
        default:
            notification.classList.add('bg-blue-500');
    }
    
    notification.textContent = message;
    notification.style.transform = 'translateX(100%)';
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 10);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Initialiser les événements
document.addEventListener('DOMContentLoaded', function() {
    // Mettre à jour le compteur au chargement
    updateUnreadCount();
    
    // Ajouter des confirmations pour les liens de suppression
    document.querySelectorAll('form[action*="notifications"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cette notification ?')) {
                e.preventDefault();
            }
        });
    });
});
</script>

<style>
/* Styles pour les notifications */
.notification-item {
    transition: all 0.3s ease;
}

.notification-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Animation pour les nouvelles notifications */
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
    100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
}

.bg-blue-50 {
    animation: pulse 2s infinite;
}
</style>
@endsection