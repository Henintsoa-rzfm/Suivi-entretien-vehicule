<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;
use App\Http\Controllers\PanneController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\DPanneController;
use App\Http\Controllers\NombreController;
use App\Http\Controllers\PapierController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\PieceNSController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\ContenirController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\DetenteurController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\MecanicienController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\IntervenirEntretienController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/dashboard', function () {  
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dash', [DashController::class, 'index'])
    ->middleware('auth')
    ->name('dash');
// Route::get('/dash', [DashController::class, 'index'])->name('dash');

// Route::get('/special', [SpecialController::class, 'index'])->name('special');

Route::get('/vehicules', [VehiculeController::class, 'index'])->name('principal');
Route::get('/vehicules/create', [VehiculeController::class, 'create'])->name('vehicules.create');
Route::post('/vehicules/create', [VehiculeController::class, 'store'])->name('vehicules.store');
Route::get('/vehicules/{id}', [VehiculeController::class, 'show'])->name('vehicules.show');
Route::get('/vehicules/{id}/edit', [VehiculeController::class, 'edit'])->name('vehicules.edit');
Route::patch('/vehicules/{id}', [VehiculeController::class, 'update'])->name('vehicules.update');
Route::delete('/vehicules/{id}', [VehiculeController::class, 'destroy'])->name('vehicules.destroy');

Route::get('/personnels', [PersonnelController::class, 'index'])->name('personnel');

Route::get('/detenteurs', [DetenteurController::class, 'index'])->name('detenteurs');
Route::get('/detenteurs/create', [DetenteurController::class, 'create'])->name('detenteurs.create');
Route::post('/detenteurs/create', [DetenteurController::class, 'store'])->name('detenteurs.store');
Route::get('/detenteurs/{id}', [DetenteurController::class, 'show'])->name('detenteurs.show');
Route::get('/detenteurs/{id}/edit', [DetenteurController::class, 'edit'])->name('detenteurs.edit');
Route::patch('/detenteurs/{id}', [DetenteurController::class, 'update'])->name('detenteurs.update');
Route::delete('/detenteurs/{id}', [DetenteurController::class, 'destroy'])->name('detenteurs.destroy');

Route::get('/chauffeurs', [ChauffeurController::class, 'index'])->name('chauffeurs');
Route::get('/chauffeurs/create', [ChauffeurController::class, 'create'])->name('chauffeurs.create');
Route::post('/chauffeurs/create', [ChauffeurController::class, 'store'])->name('chauffeurs.store');
Route::get('/chauffeurs/{id}', [ChauffeurController::class, 'show'])->name('chauffeurs.show');
Route::get('/chauffeurs/{id}/edit', [ChauffeurController::class, 'edit'])->name('chauffeurs.edit');
Route::patch('/chauffeurs/{id}', [ChauffeurController::class, 'update'])->name('chauffeurs.update');
Route::delete('/chauffeurs/{id}', [ChauffeurController::class, 'destroy'])->name('chauffeurs.destroy');

Route::get('/dpannes', [DPanneController::class, 'index'])->name('dpannes');
Route::get('/dpannes/create', [DPanneController::class, 'create'])->name('dpannes.create');
Route::post('/dpannes/create', [DPanneController::class, 'store'])->name('dpannes.store');
Route::get('/dpannes/{id}', [DPanneController::class, 'show'])->name('dpannes.show');
Route::get('/dpannes/{id}/edit', [DPanneController::class, 'edit'])->name('dpannes.edit');
Route::patch('/dpannes/{id}', [DPanneController::class, 'update'])->name('dpannes.update');
Route::delete('/dpannes/{id}', [DPanneController::class, 'destroy'])->name('dpannes.destroy');

Route::get('/papier', [PapierController::class, 'index'])->name('papier');

Route::get('/assurances', [AssuranceController::class, 'index'])->name('assurances');
Route::get('/assurances/create', [AssuranceController::class, 'create'])->name('assurances.create');
Route::post('/assurances/create', [AssuranceController::class, 'store'])->name('assurances.store');
Route::get('/assurances/{id}', [AssuranceController::class, 'show'])->name('assurances.show');
Route::get('/assurances/{id}/edit', [AssuranceController::class, 'edit'])->name('assurances.edit');
Route::patch('/assurances/{id}', [AssuranceController::class, 'update'])->name('assurances.update');
Route::delete('/assurances/{id}', [AssuranceController::class, 'destroy'])->name('assurances.destroy');

Route::get('/visites', [VisiteController::class, 'index'])->name('visites');
Route::get('/visites/create', [VisiteController::class, 'create'])->name('visites.create');
Route::post('/visites/create', [visiteController::class, 'store'])->name('visites.store');
Route::get('/visites/{id}', [VisiteController::class, 'show'])->name('visites.show');
Route::get('/visites/{id}/edit', [VisiteController::class, 'edit'])->name('visites.edit');
Route::patch('/visites/{id}', [VisiteController::class, 'update'])->name('visites.update');
Route::delete('/visites/{id}', [VisiteController::class, 'destroy'])->name('visites.destroy');

Route::get('/mecaniciens', [MecanicienController::class, 'index'])->name('mecaniciens');
Route::get('/mecaniciens/create', [MecanicienController::class, 'create'])->name('mecaniciens.create');
Route::post('/mecaniciens/create', [MecanicienController::class, 'store'])->name('mecaniciens.store');
Route::get('/mecaniciens/{id}', [MecanicienController::class, 'show'])->name('mecaniciens.show');
Route::get('/mecaniciens/{id}/edit', [MecanicienController::class, 'edit'])->name('mecaniciens.edit');
Route::patch('/mecaniciens/{id}', [MecanicienController::class, 'update'])->name('mecaniciens.update');
Route::delete('/mecaniciens/{id}', [MecanicienController::class, 'destroy'])->name('mecaniciens.destroy');

Route::get('/pannes/create', [PanneController::class, 'create'])->name('pannes.create');
Route::post('/pannes/create', [PanneController::class, 'store'])->name('pannes.store');

Route::get('/interventions', [InterventionController::class, 'index'])->name('interventions');
Route::get('/interventions/create', [InterventionController::class, 'create'])->name('interventions.create');
Route::post('/interventions/create', [InterventionController::class, 'store'])->name('interventions.store');
Route::get('/interventions/{id}', [InterventionController::class, 'show'])->name('interventions.show');
Route::get('/interventions/{id}/edit', [InterventionController::class, 'edit'])->name('interventions.edit');
Route::patch('/interventions/{id}', [InterventionController::class, 'update'])->name('interventions.update');
Route::delete('/interventions/{id}', [InterventionController::class, 'destroy'])->name('interventions.destroy');

Route::get('/nombres', [NombreController::class, 'index'])->name('nombres');
Route::get('/nombres/create', [NombreController::class, 'create'])->name('nombres.create');
Route::post('/nombres/create', [NombreController::class, 'store'])->name('nombres.store');
Route::get('/nombres/{id}', [NombreController::class, 'show'])->name('nombres.show');
Route::get('/nombres/{id}/edit', [NombreController::class, 'edit'])->name('nombres.edit');
Route::patch('/nombres/{id}', [NombreController::class, 'update'])->name('nombres.update');
Route::delete('/nombres/{id}', [NombreController::class, 'destroy'])->name('nombres.destroy');

Route::get('/pieces', [PieceController::class, 'index'])->name('pieces');
Route::get('/pieces/create', [PieceController::class, 'create'])->name('pieces.create');
Route::post('/pieces/create', [PieceController::class, 'store'])->name('pieces.store');
Route::get('/pieces/{id}', [PieceController::class, 'show'])->name('pieces.show');
Route::get('/pieces/{id}/edit', [PieceController::class, 'edit'])->name('pieces.edit');
Route::patch('/pieces/{id}', [PieceController::class, 'update'])->name('pieces.update');
Route::delete('/pieces/{id}', [PieceController::class, 'destroy'])->name('pieces.destroy');

Route::get('/contenirs', [ContenirController::class, 'index'])->name('contenirs');
Route::get('/contenirs/create', [ContenirController::class, 'create'])->name('contenirs.create');
Route::post('/contenirs/create', [ContenirController::class, 'store'])->name('contenirs.store');
Route::get('/contenirs/{id}', [ContenirController::class, 'show'])->name('contenirs.show');
Route::get('/contenirs/{id}/edit', [ContenirController::class, 'edit'])->name('contenirs.edit');
Route::patch('/contenirs/{id}', [ContenirController::class, 'update'])->name('contenirs.update');
Route::delete('/contenirs/{id}', [ContenirController::class, 'destroy'])->name('contenirs.destroy');

Route::get('/addinterventionsE/create', [IntervenirEntretienController::class, 'create'])->name('interventionsE.create');
Route::post('/addinterventionsE/create', [IntervenirEntretienController::class, 'store'])->name('interventionsE.store');

Route::get('/equipements/create', [EquipementController::class, 'create'])->name('equipements.create');
Route::post('/equipements/create', [EquipementController::class, 'store'])->name('equipements.store');

Route::get('/piecens/create', [PieceNSController::class, 'create'])->name('piecens.create');
Route::post('/piecens/create', [PieceNSController::class, 'store'])->name('piecens.store');


require __DIR__.'/auth.php';
