@extends('layouts.app')
@section('content')
<body class="text-dark">
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

    <h3 class="text-center">Fiche de visite  numero {{$visite->id}}</h3>
    <br><br>
    <div style="border: 1px solid black; padding:10px; display:flex; justify-content:space-around">
        <div class="bli">
            <p>Immatriculation : {{$visite->Vehicule->PlaqueImmatric}}</p>
            <p>Vehicule : {{$visite->Vehicule->Vehicule}}</p>
        </div>
        <div class="blo">
            <p>Puissance : {{$visite->Vehicule->CV}} ch</p>
            <p>Consommation : {{$visite->Vehicule->Consommation}} L/100</p>
        </div>
        <div class="bla">
            <p>Année de mise en circulation : {{date('d M Y', strtotime($visite->Vehicule->AnneeMenCirc))}}</p>
            <p>Date d'entrée : {{date('d M Y', strtotime($visite->DateEntree))}}</p>
            <p>Mise à jour du : {{date('d M Y', strtotime($visite->updated_at))}}</p>
            </p>
        </div>
    </div>
<br><br>
<table style="border: 1px solid grey" class="table table-bordered bg bg-light text-center">
    <thead>
        <th>Date début de la visite</th>
        <th>Date d'expiration de la visite</th>
        <th>Etat</th>
    </thead>
    <tbody class="text-dark">
        <td> {{date('d M Y', strtotime($visite->DateVisite))}}</td>
        <td> {{date('d M Y', strtotime($visite->Date_exp_Visite))}}</td>
        <td>
        @if ($andro >= \Carbon\Carbon::parse($visite->Date_exp_Visite)->subDays(15) AND $andro<$visite->Date_exp_Visite)
            <span class="badge badge-danger">Visite à faire avant le {{date('d M Y', strtotime($visite->Date_exp_Visite))}}</span>
        @endif
        @if ($andro >= $visite->Date_exp_Visite)
            <span class="badge badge-danger">Expirée</span>
        @endif
        @if($andro < $visite->Date_exp_Visite AND $andro < \Carbon\Carbon::parse($visite->Date_exp_Visite)->subDays(15))
            <span class="badge badge-primary">Expirée le {{date('d M Y', strtotime($visite->Date_exp_Visite))}}</span>
        @endif
        </td>

    </tbody>
</table>
</div>
</body>

@endsection
