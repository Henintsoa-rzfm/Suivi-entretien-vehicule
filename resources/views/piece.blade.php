@extends('layouts.app')
@section('content')
<br>
    <h3>Fiche Pièce numero {{$piece->id}}</h3>
    <br><p>Piece : {{$piece->Piece}}</p>
    <p>Prix Unitaire : {{$piece->Prix}}</p>
@endsection
