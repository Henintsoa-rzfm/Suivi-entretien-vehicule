@extends('layouts.app')
@section('content')
<body class="text-dark">
    <br>
<style>
    .blo{display: block}
    .bli{display: block;}
    .bla{display: block}
    section{display: flex; justify-content: space-between}
    .masary{width: 100px; height:auto}
    .Masary{width: 150px; height:auto}
    </style>
<div class="container">    
    <section style="position: relative">
        <div class="blo">
            <img src="{{asset('images/index.JPG')}}" alt="" class="masary">
        </div>
        <div class="bli">
            <img src="{{asset('images/rep.JPG')}}" alt="" class="Masary">
        </div>
        <div class="bla">
            <img src="{{asset('images/LogoDST.png')}}" alt="" class="masary">
        </div>
        
        <div style="position: fixed; top:100px; right:0%; opacity:0.1;">
            <img src="{{asset('images/mecas.jpg')}}"  alt="">
        </div>

    </section><br><br>
    <h3 class="text-center">Fiche de panne numero {{$dpanne->id}}</h3><br><br>
    <div style="border: 1px solid black; padding:10px; display:flex; justify-content:space-around">        
        <div class="blo">
            <p>Plaque Immatriculation : {{$dpanne->Vehicule->PlaqueImmatric}}</p>
            <p>Detenteur du véhicule : {{$dpanne->Vehicule->Detenteur->Detenteur}}</p>    
            <p>Chauffeur du véhicule : {{$dpanne->Vehicule->Chauffeur->Chauffeur}}</p>    
        </div>
        <div class="bli">
            <p>Date de la panne : {{date('d M Y', strtotime($dpanne->DatePanne))}}</p>    
            <p>Type de la panne : {{$dpanne->Panne->TypePanne}}</p>       
        </div>
    </div>
</body>
@endsection
