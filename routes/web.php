<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\InscriptionController;    
use App\Http\Controllers\VisiteController;         
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\PreinscriptionController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

// Routes publiques (accessibles à tous)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
 Route::post('contact', [ContactController::class, 'submit'])->name('contact.submit');

 
// Routes publiques (sans authentification)
Route::prefix('preinscription')->group(function () {
    // Afficher le formulaire de pré-inscription
    Route::get('/', [PreinscriptionController::class, 'create'])
        ->name('preinscription.create');
    
    // Traiter le formulaire de pré-inscription
    Route::post('/', [PreinscriptionController::class, 'store'])
        ->name('preinscription.store');
    
    // Page de confirmation
    Route::get('/confirmation', [PreinscriptionController::class, 'confirmation'])
        ->name('preinscription.confirmation');
});

// OU version simplifiée
Route::get('/inscription', [PreinscriptionController::class, 'create'])
    ->name('inscription');
Route::post('/inscription', [PreinscriptionController::class, 'store'])
    ->name('inscription.store');

// AJOUTEZ CES DEUX NOUVELLES ROUTES :
Route::get('/inscription', [InscriptionController::class, 'index'])->name('inscription');
Route::get('/visite', [VisiteController::class, 'index'])->name('visite');

// Autres routes utiles
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/confidentialite', function () {
    return view('confidentialite');
})->name('confidentialite');
/*
|--------------------------------------------------------------------------
| ROUTES AUTHENTIFIÉES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
Route::middleware(['auth'])->group(function () {
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');
    
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
    
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.mark-all-read');
    
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');
    
    Route::delete('/notifications/clear-all', [NotificationController::class, 'clearAll'])
        ->name('notifications.clear-all');
    
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])
        ->name('notifications.unread-count');
});
    // routes/web.php
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');  

    // CRUD
    Route::resource('users', UserController::class);
    Route::resource('enseignants', EnseignantController::class);
    Route::resource('etudiants', EtudiantController::class);
    Route::get('/etudiants/export', [EtudiantController::class, 'export'])->name('etudiants.export');
    Route::resource('classes', ClasseController::class);
    Route::put('/classes/{class}', [ClasseController::class, 'update'])->name('classes.update');
    Route::resource('matieres', MatiereController::class);
    Route::resource('notes', NoteController::class);
    
Route::middleware(['auth'])->group(function () {
    // Route pour afficher le formulaire
    Route::get('/attendances', [AttendanceController::class, 'index'])
        ->name('attendances.index');
    
    // Route pour enregistrer les présences
    Route::post('/attendances', [AttendanceController::class, 'store'])
        ->name('attendances.store');
});


          Route::resource('timetables', TimetableController::class);
    Route::get('timetables/classes/{classe}', [TimetableController::class, 'byClass'])->name('timetables.byClass');
    Route::get('timetables/teachers/{teacher}', [TimetableController::class, 'byTeacher'])->name('timetables.byTeacher');
        // Pour les administrateurs
    Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');

    
// Pour l'aide (accessible à tous les utilisateurs connectés)
Route::get('/help', [HomeController::class, 'help'])->name('help')->middleware('auth');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});



   // Routes pour le calendrier
Route::middleware(['auth'])->group(function () { 
     Route::get('/calendrier', [CalendrierController::class, 'index'])->name('calendrier.index');
    
    // API pour les événements
    Route::get('/calendrier/events', [CalendrierController::class, 'getEventsByMonth']);
    Route::get('/calendrier/stats', [CalendrierController::class, 'getStats']);
    
    // CRUD événements
    Route::post('/calendrier', [CalendrierController::class, 'store']);
    Route::get('/calendrier/{id}/edit', [CalendrierController::class, 'edit']);
    Route::put('/calendrier/{id}', [CalendrierController::class, 'update']);
    Route::delete('/calendrier/{id}', [CalendrierController::class, 'destroy']);
});
    // Messages
    Route::resource('messages', MessageController::class)->except(['edit', 'update', 'destroy']);
    
    // Rapports
    Route::get('/rapports', [RapportController::class, 'index'])->name('rapports.index');
    // Si vous voulez ajouter d'autres routes pour les rapports :
    Route::get('/rapports/export', [RapportController::class, 'export'])->name('rapports.export');

});
