<?php
use App\Http\Controllers\SystemCalendarController;
use App\Http\Livewire\Calendar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\HomeController;

// Routes pour la gestion de l'authentification
Auth::routes(['register' => true]);
Route::get('verify', [TwoFactorController::class, 'index'])->name('auth.verify');
Route::post('verify', [TwoFactorController::class, 'store'])->name('verify.store');
Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route pour les logs d'activité
Route::get('activity-logs/login/logout', [ActivityLogController::class, 'showLogs'])->name('activity-logs/login/logout');

// Route par défaut
Route::get('/', function () {
    return view('welcome');
});

// Routes pour les interventions
// Routes pour les interventions
Route::get('/interventions', [InterventionController::class, 'index'])->name('interventions.index');
Route::get('/interventions/create', [InterventionController::class, 'create'])->name('interventions.create');
Route::post('/interventions', [InterventionController::class, 'store'])->name('interventions.store');
Route::get('/interventions/{intervention}', [InterventionController::class, 'show'])->name('interventions.show');
Route::get('/interventions/{intervention}/edit', [InterventionController::class, 'edit'])->name('interventions.edit');
Route::put('/interventions/{intervention}', [InterventionController::class, 'update'])->name('interventions.update');
Route::delete('/interventions/{intervention}', [InterventionController::class, 'destroy'])->name('interventions.destroy');

// Route pour afficher le calendrier système
Route::get('/sys', [SystemCalendarController::class, 'index'])->name('systemCalendar');

// Composant Livewire pour le calendrier
Livewire::component('calendar', Calendar::class);
