@extends('layouts.app')
@section('content')
<body class="text-dark">
    <style>
    .blo{display: block}
    .bli{display: block; margin: 20px}
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
        
        <div style="position: fixed; top:0px; opacity:0.1;">
            <img src="{{asset('images/preview.jpg')}}" alt="">
        </div>


    </section><br><br>

    <h3 class="text-center">Fiche du mecanicien numero {{$mecanicien->id}}</h3>
        <br><br>
            <div style="border: 1px solid black; padding:10px; display:flex; justify-content:space-around">
                <p>Matricule : {{$mecanicien->MatrMeca}}</p>
                <p>Mécanicien : {{$mecanicien->Mecanicien}}</p>
            </div>
        
        <br><br>
        <p>La liste de tous les interventions accomplis et à faire pour Monsieur {{$mecanicien->Mecanicien}} :</p>
        <table style="border: 1px solid grey" class="table table-bordered bg bg-light text-center">
            <thead>
                <th>Nature</th>
                <th>Debut</th>
                <th>Fin</th>
                <th>Véhicule</th>
                <th>Panne</th>
                <th>Réparation</th>
                <th>Etat</th>
            </thead>
            <tbody class="text-dark">
        <tr>
        @forelse ($mecanicien->interventions as $intervention)
            <td>{{$intervention->nature}}</td>
            <td>{{date('d M Y' , strtotime($intervention->DateIntervention))}}</td>
            <td>{{date('d M Y' , strtotime($intervention->DateLimite))}}</td>
            <td>{{$intervention->Vehicule->PlaqueImmatric}}</td>
            <td>{{$intervention->Panne}}</td>
            <td>{{$intervention->Validation}}</td>
            <td>
                @if ($daty < $intervention->DateIntervention AND $intervention->Validation == 'En attente')
                    <span style="color:"><label class="badge badge-danger">En attente</label></span>
                </a>
                @endif
                
                @if ($daty < $intervention->DateIntervention AND $intervention->Validation == 'Validée')
                <a style="text-decoration:none" href="{{route('interventions.show', ['id' => $intervention->id])}}">
                    <span style="color:"><label class="badge badge-primary">Date fixée</label></span>
                </a>
                @endif

                @if($daty >= $intervention->DateIntervention AND $daty <= $intervention->DateLimite AND $intervention->Validation == 'En attente') 
                <span style="color:"><label class="badge badge-danger">A reporter</label></span> 
                @endif

                @if($daty >= $intervention->DateIntervention AND $daty > $intervention->DateLimite AND $intervention->Validation == 'En attente') 
                <span style="color:"><label class="badge badge-danger">A reporter</label></span> 
                @endif

                @if($daty >= $intervention->DateIntervention AND $daty <= $intervention->DateLimite AND $intervention->Validation == 'Validée') 
                <span style="color: blue">
                <label class="badge badge-warning">En cours</label>
                </span> 
                @endif

                @if($daty > $intervention->DateLimite AND $intervention->Validation == 'Validée') 
                <span style="color: blue">
                <label class="badge badge-success">Terminée</label>
                </span> 
                @endif
            </td>
        </tr>
        @empty
        
        @endforelse
    </tbody>
    </table><br>
</div>
</body>
@endsection
