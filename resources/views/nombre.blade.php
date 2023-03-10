@extends('layouts.app')
@section('content')
<br>
    <h3>Fiche de l'achat numero {{$nombre->id}}</h3>
    <br><p>Date de l'intervention : {{$nombre->Intervention->DateIntervention}}</p>
    <p>Nature de l'intervention : {{$nombre->Intervention->nature}} </p>
    <p>Pieces : {{$nombre->Piece->Piece}}</p>
    <p>Prix Unitaire : {{$nombre->Piece->Prix}} Ar</p>
    <p>Quantité : {{$nombre->Nombre}}</p>
    <p>Prix Total : {{$nombre->Nombre * $nombre->Piece->Prix}} Ar</p>
    <p>Immatriculation : {{$nombre->Intervention->Vehicule->PlaqueImmatric}}</p>
    <p>Vehicule : {{$nombre->Intervention->Vehicule->Vehicule}}</p>
@endsection
