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
            <div style="position: fixed; top:200px; left:600px;opacity:0.06;">
                <img src="{{asset('images/az.jpg')}}" alt="">
            </div>
        </section>

    <h3 class="text-center">Fiche d'Assurance  numero {{$assurance->id}}</h3>
    <br><br>
    <div style="border: 1px solid black; padding:10px; display:flex; justify-content:space-around">
        <div class="bli">
            <p>Immatriculation : {{$assurance->Vehicule->PlaqueImmatric}}</p>
            <p>Vehicule : {{$assurance->Vehicule->Vehicule}}</p>
        </div>
        <div class="blo">
            <p>Puissance : {{$assurance->Vehicule->CV}} ch</p>
            <p>Consommation : {{$assurance->Vehicule->Consommation}} L/100</p>
        </div>
        <div class="bla">
            <p>Année de mise en circulation : {{date('d M Y', strtotime($assurance->Vehicule->AnneeMenCirc))}}</p>
            <p>Date d'entrée : {{date('d M Y', strtotime($assurance->DateEntree))}}</p>
            <p>Mise à jour du : {{date('d M Y', strtotime($assurance->updated_at))}}</p>
            </p>
        </div>
    </div>
<br><br>
<table style="border: 1px solid grey" class="table table-bordered bg bg-light text-center">
    <thead>
        <th>Date début du contrat d'assurance</th>
        <th>Date d'expiration du contrat d'assurance</th>
        <th>Etat</th>
    </thead>
    <tbody class="text-dark">
        <td> {{date('d M Y', strtotime($assurance->DateAssurance))}}</td>
        <td> {{date('d M Y', strtotime($assurance->Date_exp_Assurance))}}</td>
        <td>
            @if ($andro >= \Carbon\Carbon::parse($assurance->Date_exp_Assurance)->subDays(15) AND $andro<$assurance->Date_exp_Assurance)
            <span class="badge badge-danger">Assurance à faire avant le {{date('d M Y', strtotime($assurance->Date_exp_Assurance))}}</span>
            @endif
            @if ($andro >= $assurance->Date_exp_Assurance)
                <span class="badge badge-danger">Expirée</span>
            @endif
            @if($andro < $assurance->Date_exp_Assurance AND $andro < \Carbon\Carbon::parse($assurance->Date_exp_Assurance)->subDays(15))
                <span class="badge badge-primary">Expirée le {{date('d M Y', strtotime($assurance->Date_exp_Assurance))}}</span>
            @endif
        </td>

    </tbody>
</table>
</div>
</body>

@endsection
