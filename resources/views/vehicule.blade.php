@extends('layouts.app')
@section('content')
{{-- <style type="text/css" media="print">@page{size: landscape;size: 21.0cm 29.7}</style> --}}
<div class="container impr" style="position: relative">
<style>
    .blo{display: block}
    .bli{display: block}
    .bla{display: block}
    section{display: flex; justify-content: space-around}
    .masary{width: 100px; height:auto}
    .Masary{width: 150px; height:auto}
</style>
<br>
<img src="{{asset('images/visite2.png')}}" alt="" style="position: fixed; top:200px;left:700px; opacity:0.2">
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
    </section><br><br>

    <h3 class="text-center text-dark">FICHE DU VEHICULE NUMERO {{ $vehicule->PlaqueImmatric}} {{-- $vehicule->id--}}</h3><hr>
    
    <section class="text-dark">
    <div class="blo">
        <br><p><u>Plaque Immatriculaion</u> : {{ $vehicule->PlaqueImmatric}}</p>
        <p><u>Véhicule</u> : {{ $vehicule->Vehicule}}</p>
        <p><u>Energie </u>  :{{ $vehicule->Energie}}</p>
        <p><u>Consommation </u> : {{ $vehicule->Consommation}} litres au 100</p>
    </div>
    <div class="bli">
        <br>
        <p><u>CV </u>  :{{$vehicule->CV}} ph</p>
        <p><u>Date Entrée </u>  :{{ date('d M Y', strtotime($vehicule->DateEntree))}}</p>
        <p><u>Kilometrage Actuel </u>  :{{ $vehicule->KMActuel}} KM</p>
    </div>
    <div class="bla">
        <p><u>Année de Mise en circulation : </u> {{ date('d M Y', strtotime($vehicule->AnneeMenCirc))}}</p>    
        <p><u>Mise à jour </u>  : {{ date('d M Y', strtotime($vehicule->updated_at))}}</p>
        <p><u>Date d'aujourd'hui </u>  : {{ date('d M Y', strtotime($date1))}}</p>
    </div>
    </section>
<hr>
<table style="border:1px solid grey" class="table table-bordered bg bg-light text-center">
    <thead>
        <th><b>Visite</b></th>
        <th><b>Assurance</b></th>
        </thead>
    <tbody>
        <td style="background: white">
            @if (isset($vehicule->Visite->Date_exp_Visite))    
                @if ($date1 >= \Carbon\Carbon::parse($vehicule->Visite->Date_exp_Visite)->subDays(15) AND $date1<$vehicule->Visite->Date_exp_Visite)
                <span class="text-danger">Visite à faire avant le {{date('d M Y', strtotime($vehicule->Visite->Date_exp_Visite))}}</span>
                @endif
                @if ($date1 >= $vehicule->Visite->Date_exp_Visite)
                    <span class="text-danger">Expirée</span>
                @endif
                @if($date1 < $vehicule->Visite->Date_exp_Visite AND $date1 < \Carbon\Carbon::parse($vehicule->Visite->Date_exp_Visite)->subDays(15))
                    <span class="">Expirée le {{date('d M Y', strtotime($vehicule->Visite->Date_exp_Visite))}}</span>                              
                @endif
            @endif 


            
        </td>
        <td style="background: white">
            @if (isset($vehicule->Assurance->Date_exp_Assurance))
                @if ($date1 >= \Carbon\Carbon::parse($vehicule->Assurance->Date_exp_Assurance)->subDays(15) AND $date1 < $vehicule->Assurance->Date_exp_Assurance)
                <span class="text-danger">Visite à faire avant le {{date('d M Y', strtotime($vehicule->Assurance->Date_exp_Assurance))}}</span>
                @endif
                @if ($date1 >= $vehicule->Assurance->Date_exp_Assurance)
                    <span class="text-danger">Expirée</span>
                @endif
                @if($date1 < $vehicule->Assurance->Date_exp_Assurance AND $date1 < \Carbon\Carbon::parse($vehicule->Assurance->Date_exp_Assurance)->subDays(15))
                    <span class="">Expirée le {{date('d M Y', strtotime($vehicule->Assurance->Date_exp_Assurance))}}</span>                              
                @endiF
            @endif
        </td>
    </tbody>
</table>    
<hr>
<p class="text-dark">Kilométrage éffectué par le véhicule: {{$vehicule->KMActuel}} Km</p>
<table style="border: 1px solid grey" class="table table-bordered bg bg-light text-center text-dark">
    <thead>
        <th>Revision</th>
        <th>KM Max</th>
        <th>KM du dernier entretien</th>
        <th>KM Relatif</th>
        <th>Piece à remplacer</th>
        <th>Etat</th>
    </thead>
    @forelse ($vehicule->equipements as $equipement)
        <tbody>
            <td style="background: white">{{$equipement->designation}}</td>
            <td style="background: white">{{$equipement->kilometrageMax}} KM</td>
            <td style="background: white">{{$equipement->pivot->dernierKM}} KM</td>
            {{-- <td>{{$vehicule->KMActuel}} KM</td> --}}
            <td style="background: white">
                @if ($vehicule->KMActuel-$equipement->pivot->dernierKM < 0)     
                    <span style="color: red">{{  'Revérifiez vos calculs' }}</span>
                @else
                    {{$vehicule->KMActuel-$equipement->pivot->dernierKM}} KM
                @endif
            </td>
            <td style="background: white">
                @if ($vehicule->KMActuel-$equipement->pivot->dernierKM < $equipement->kilometrageMax)
                    <span style="color: darkgreen">{{ 'Aucune' }}</span>
                @else
                    @forelse ($equipement->piece_n_ss as $piece)
                        {{$piece->NomPiece}},
                        @empty
                    @endforelse</td>    
                @endif
                
            <td style="background: white">
                @if ($vehicule->KMActuel-$equipement->pivot->dernierKM  < $equipement->kilometrageMax AND $vehicule->KMActuel-$equipement->pivot->dernierKM >= 0)
                <span style="color: blue">{{ 'Normal' }}</span>
                @endif
                @if ($vehicule->KMActuel-$equipement->pivot->dernierKM  >= $equipement->kilometrageMax AND $vehicule->KMActuel-$equipement->pivot->dernierKM >= 0)
                    <span style="color: red">{{  'Nécessite une maintenance' }}</span>
                @endif
                @if ($vehicule->KMActuel-$equipement->pivot->dernierKM  <= $equipement->kilometrageMax AND $vehicule->KMActuel-$equipement->pivot->dernierKM < 0)
                <span style="color: red">{{ 'Reverifiez vos calculs' }}</span>
                @endif
            </td>
            
        </tbody>
    @empty
    <p class="text-dark">Vous devez enregistrer tous les entretiens à faire sur le véhicule</p>
@endforelse
</table>
<hr>
<br>

<p class="text-dark">Les interventions subies par le véhicule :</p>
<table style="border: 1px solid grey" class="table table-bordered bg bg-light text-center text-dark">
    <thead>
        <th>Intervention</th>
        <th>Debut</th>
        <th>Fin</th>
        <th>Réparation</th>
        <th>Etat</th>
    </thead>
    @forelse ($vehicule->interventions as $intervention)
        <tbody>
            <td style="background: white">{{$intervention->nature}}</td>
            <td style="background: white">{{date('d M Y', strtotime($intervention->DateIntervention))}}</td>
            <td style="background: white">{{date('d M Y', strtotime($intervention->DateLimite))}}</td>
            <td style="background: white">{{$intervention->Validation}}</td>
            <td style="background: white">
                @if ($date1 < $intervention->DateIntervention AND $intervention->Validation == 'En attente')
                <a style="text-decoration:none" href="{{route('interventions.show', ['id' => $intervention->id])}}">
                    <span style="color:"><label class="badge badge-danger">En attente</label></span>
                </a>
                @endif
                
                @if ($date1 < $intervention->DateIntervention AND $intervention->Validation == 'Validée')
                <span style="color:"><label class="badge badge-primary">Date fixée</label></span>
                @endif

                @if($date1 >= $intervention->DateIntervention AND $date1 <= $intervention->DateLimite AND $intervention->Validation == 'En attente') 
                <span style="color:"><label class="badge badge-danger">A reporter</label></span> 
                @endif

                @if($date1 >= $intervention->DateIntervention AND $date1 > $intervention->DateLimite AND $intervention->Validation == 'En attente') 
                <span style="color:"><label class="badge badge-danger">A reporter</label></span> 
                @endif

                @if($date1 >= $intervention->DateIntervention AND $date1 <= $intervention->DateLimite AND $intervention->Validation == 'Validée') 
                <span style="color: blue">
                  <label class="badge badge-warning">En cours</label>
                </span> 
                @endif
                
                @if($date1 > $intervention->DateLimite AND $intervention->Validation == 'Validée') 
                <span style="color: blue">
                  <label class="badge badge-success">Terminée</label>
                </span>
                @endif
            </td>
        </tbody>
    @empty
    <p class="text-dark">Pas d'intervention</p>
@endforelse
</table><br>
</div>
@endsection