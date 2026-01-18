@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-orange-50 to-amber-50 min-h-screen py-8 px-4">
    <div class="max-w-7xl mx-auto">
        
        {{-- EN-TÊTE --}}
        <div class="mb-10">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-r from-orange-500 to-amber-500 rounded-xl shadow-lg">
                        <i class="fas fa-calendar-check text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Gestion des présences</h1>
                        <p class="text-gray-600 mt-1">Séance du {{ now()->format('d/m/Y') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="bg-white rounded-lg p-3 shadow-sm border">
                        <p class="text-sm text-gray-600">Total étudiants</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $etudiants->count() }}</p>
                    </div>
                </div>
            </div>
            
            {{-- STATISTIQUES --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">À marquer</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $etudiants->count() }}</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Classes</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $etudiants->unique('classe_id')->count() }}</p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-lg">
                            <i class="fas fa-chalkboard-teacher text-green-600"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Dernière mise à jour</p>
                            <p class="text-lg font-bold text-gray-900">Aujourd'hui</p>
                        </div>
                        <div class="p-3 bg-purple-50 rounded-lg">
                            <i class="fas fa-history text-purple-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORMULAIRE --}}
        <form method="POST" action="{{ route('attendances.store') }}" id="attendance-form">
            @csrf
            
            {{-- AJOUTER UN CHAMP DATE SI NÉCESSAIRE --}}
            <input type="hidden" name="date" value="{{ now()->toDateString() }}">
            
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                {{-- EN-TÊTE TABLEAU --}}
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-white">Liste des étudiants</h2>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-gray-300">Présent</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <span class="text-sm text-gray-300">Absent</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TABLEAU --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">N°</th>
                                <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Étudiant</th>
                                <th class="py-4 px-6 text-left text-sm font-semibold text-gray-700">Classe</th>
                                <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Statut</th>
                                <th class="py-4 px-6 text-center text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($etudiants as $index => $etudiant)
                                <tr class="hover:bg-gray-50 transition-colors" data-student-id="{{ $etudiant->id }}">
                                    <td class="py-4 px-6 text-gray-600 font-medium">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-amber-400 rounded-full flex items-center justify-center text-white font-bold">
                                                {{ substr($etudiant->prenom, 0, 1) }}{{ substr($etudiant->nom, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $etudiant->prenom }} {{ $etudiant->nom }}</p>
                                                <p class="text-sm text-gray-500">{{ $etudiant->email ?? '—' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-chalkboard mr-2"></i>
                                            {{ $etudiant->classe->nom ?? 'Non assigné' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center space-x-6">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" 
                                                       name="attendance[{{ $etudiant->id }}]" 
                                                       value="present" 
                                                       class="hidden peer"
                                                       @if(old('attendance.'.$etudiant->id, 'present') == 'present') checked @endif>
                                                <div class="w-10 h-10 rounded-full border-2 border-gray-300 peer-checked:border-green-500 peer-checked:bg-green-50 flex items-center justify-center transition-all hover:scale-110">
                                                    <i class="fas fa-check text-gray-400 peer-checked:text-green-600"></i>
                                                </div>
                                                <span class="ml-2 text-sm text-gray-600 peer-checked:text-green-600">Présent</span>
                                            </label>
                                            
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" 
                                                       name="attendance[{{ $etudiant->id }}]" 
                                                       value="absent" 
                                                       class="hidden peer"
                                                       @if(old('attendance.'.$etudiant->id) == 'absent') checked @endif>
                                                <div class="w-10 h-10 rounded-full border-2 border-gray-300 peer-checked:border-red-500 peer-checked:bg-red-50 flex items-center justify-center transition-all hover:scale-110">
                                                    <i class="fas fa-times text-gray-400 peer-checked:text-red-600"></i>
                                                </div>
                                                <span class="ml-2 text-sm text-gray-600 peer-checked:text-red-600">Absent</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <button type="button" 
                                                class="note-btn p-2 text-gray-400 hover:text-orange-600 transition-colors"
                                                data-student="{{ $etudiant->id }}"
                                                data-name="{{ $etudiant->prenom }} {{ $etudiant->nom }}">
                                            <i class="fas fa-sticky-note"></i>
                                            <span class="text-xs ml-1">Note</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center">
                                        <div class="text-gray-400">
                                            <i class="fas fa-users-slash text-4xl mb-4"></i>
                                            <p class="text-lg">Aucun étudiant trouvé</p>
                                            <p class="text-sm mt-2">Ajoutez des étudiants pour gérer les présences</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($etudiants->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t">
                    {{ $etudiants->links() }}
                </div>
                @endif
            </div>

            {{-- NOTES MODALE --}}
            <div id="noteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
                <div class="bg-white rounded-2xl max-w-md w-full p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Ajouter une note</h3>
                        <button type="button" onclick="closeNoteModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <p class="text-gray-600 mb-2">Pour : <span id="studentName" class="font-semibold"></span></p>
                    <textarea id="noteText" 
                              class="w-full h-32 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                              placeholder="Note optionnelle (ex: retard, maladie, etc.)"></textarea>
                    <input type="hidden" id="currentStudentId">
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeNoteModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Annuler
                        </button>
                        <button type="button" onclick="saveNote()" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>

            {{-- ACTIONS --}}
            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-sm text-gray-600">
                    <p><i class="fas fa-info-circle mr-2"></i>Tous les champs sont obligatoires</p>
                </div>
                <div class="flex gap-3">
                    <button type="button" 
                            onclick="markAll('present')"
                            class="px-6 py-3 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors font-medium">
                        <i class="fas fa-check-circle mr-2"></i>Tout marquer présent
                    </button>
                    <button type="button" 
                            onclick="markAll('absent')"
                            class="px-6 py-3 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors font-medium">
                        <i class="fas fa-times-circle mr-2"></i>Tout marquer absent
                    </button>
                    <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-orange-600 to-amber-600 text-white rounded-lg hover:from-orange-700 hover:to-amber-700 transition-all shadow-lg hover:shadow-xl font-bold">
                        <i class="fas fa-save mr-2"></i>Enregistrer les présences
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPTS JS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des boutons de note
    document.querySelectorAll('.note-btn').forEach(button => {
        button.addEventListener('click', function() {
            const studentId = this.dataset.student;
            const studentName = this.dataset.name;
            openNoteModal(studentId, studentName);
        });
    });

    // Initialiser les champs de notes cachés
    @foreach($etudiants as $etudiant)
        if (!document.querySelector(`input[name="notes[{{ $etudiant->id }}]"]`)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `notes[{{ $etudiant->id }}]`;
            input.id = `note-{{ $etudiant->id }}`;
            document.getElementById('attendance-form').appendChild(input);
        }
    @endforeach
});

function openNoteModal(studentId, studentName) {
    document.getElementById('studentName').textContent = studentName;
    document.getElementById('currentStudentId').value = studentId;
    
    // Charger la note existante
    const noteInput = document.getElementById(`note-${studentId}`);
    document.getElementById('noteText').value = noteInput ? noteInput.value : '';
    
    document.getElementById('noteModal').classList.remove('hidden');
    document.getElementById('noteModal').classList.add('flex');
}

function closeNoteModal() {
    document.getElementById('noteModal').classList.add('hidden');
    document.getElementById('noteModal').classList.remove('flex');
}

function saveNote() {
    const studentId = document.getElementById('currentStudentId').value;
    const note = document.getElementById('noteText').value;
    
    // Mettre à jour le champ caché
    let noteInput = document.getElementById(`note-${studentId}`);
    if (!noteInput) {
        noteInput = document.createElement('input');
        noteInput.type = 'hidden';
        noteInput.name = `notes[${studentId}]`;
        noteInput.id = `note-${studentId}`;
        document.getElementById('attendance-form').appendChild(noteInput);
    }
    noteInput.value = note;
    
    // Mettre à jour l'icône du bouton
    const noteBtn = document.querySelector(`.note-btn[data-student="${studentId}"]`);
    if (noteBtn && note.trim()) {
        noteBtn.innerHTML = '<i class="fas fa-sticky-note text-orange-600"></i><span class="text-xs ml-1 text-orange-600">Noté</span>';
    }
    
    closeNoteModal();
}

function markAll(status) {
    document.querySelectorAll(`input[type="radio"][value="${status}"]`).forEach(radio => {
        radio.checked = true;
        // Déclencher l'événement change pour mettre à jour le style
        radio.dispatchEvent(new Event('change', { bubbles: true }));
    });
    
    // Afficher une notification
    const message = status === 'present' 
        ? 'Tous les étudiants ont été marqués comme présents' 
        : 'Tous les étudiants ont été marqués comme absents';
    
    showNotification(message, status === 'present' ? 'green' : 'red');
}

function showNotification(message, color) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium transform transition-transform duration-300 z-50 bg-${color}-500`;
    notification.textContent = message;
    notification.style.transform = 'translateX(100%)';
    
    document.body.appendChild(notification);
    
    // Animation d'entrée
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 10);
    
    // Supprimer après 3 secondes
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}
</script>

<style>
/* Styles supplémentaires pour améliorer l'UX */
input[type="radio"]:checked + div {
    transform: scale(1.1);
}

.peer:checked ~ span {
    font-weight: 600;
}

/* Animation pour les lignes du tableau */
tr {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endsection