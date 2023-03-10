<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sidebars.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fontawesome/css/solid.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fontawesome/css/brands.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/side.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/search.css')}}">
</head>

    @include('partials.sidebar')

    @yield('content')

    @include('partials.footer')

</html>
<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanneController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\DPanneController;
use App\Http\Controllers\NombreController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ContenirController;
use App\Http\Controllers\PreleverController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\DetenteurController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\MecanicienController;
use App\Http\Controllers\InterventionController;

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


Route::get('/', [VehiculeController::class, 'index'])->name('principal');
Route::get('/vehicules/create', [VehiculeController::class, 'create'])->name('vehicules.create');
Route::post('/vehicules/create', [VehiculeController::class, 'store'])->name('vehicules.store');
Route::get('/vehicules/{id}', [VehiculeController::class, 'show'])->name('vehicules.show');
Route::get('/vehicules/{id}/edit', [VehiculeController::class, 'edit'])->name('vehicules.edit');
Route::patch('/vehicules/{id}', [VehiculeController::class, 'update'])->name('vehicules.update');
Route::delete('/vehicules/{id}', [VehiculeController::class, 'destroy'])->name('vehicules.destroy');

Route::get('/missions', [MissionController::class, 'index'])->name('missions');
Route::get('/missions/create', [MissionController::class, 'create'])->name('missions.create');
Route::post('/missions/create', [MissionController::class, 'store'])->name('missions.store');
Route::get('/missions/{id}', [MissionController::class, 'show'])->name('missions.show');
Route::get('/missions/{id}/edit', [MissionController::class, 'edit'])->name('missions.edit');
Route::patch('/missions/{id}', [MissionController::class, 'update'])->name('missions.update');
Route::delete('/missions/{id}', [MissionController::class, 'destroy'])->name('missions.destroy');

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

Route::get('/equipements/create', [EquipementController::class, 'create'])->name('equipements.create');
Route::post('/equipements/create', [EquipementController::class, 'store'])->name('equipements.store');

