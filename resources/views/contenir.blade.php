@extends('layouts.app')
@section('content')
<style>
    .blo{display: block}
    .bli{display: block}
    .bla{display: block}
    section{display: flex; justify-content: space-around}
    .masary{width: 100px; height:auto}
    .Masary{width: 150px; height:auto}
</style>
<br>
<div class="container text-dark">
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
    <h3 class="text-center">Fiche d'entretien  numero {{$contenir->id}}</h3><br><br>
    <section {{--style="border: 1px solid black; padding:10px; display:flex; justify-content:space-around"--}}>
        <div class="blo">
            <p>Immatriculation : {{$contenir->Vehicule->PlaqueImmatric}}</p>
            <p>Vehicule : {{$contenir->Vehicule->Vehicule}}</p>    
            <p>Energie : {{$contenir->Vehicule->Energie}}</p>    
            <p>Kilometrage Actuel: {{$contenir->Vehicule->KMActuel}} KM</p>
        </div>
        <div class="bli">
            <p> Chauffeur: Mr {{$contenir->Vehicule->Chauffeur->Chauffeur}}</p>
            <p> Detenteur: Mr/Mme {{$contenir->Vehicule->Detenteur->Detenteur}}</p>
            <p> Poste du Detenteur: {{$contenir->Vehicule->Detenteur->Poste}}</p>
        </div>
        <div class="bla">
            <p> Enregistrement du : {{date('d M Y', strtotime($contenir->created_at))}}</p>
            <p> Mise à jour du : {{date('d M Y', strtotime($contenir->updated_at))}}</p>
        </div>
    </section><br><br>
    <table style="border: 1px solid grey" class="table table-bordered bg bg-light text-center">
        <thead>
            <th>Révision</th>
            <th>Kilométrage max</th>
            <th>KM dernier entretien</th>
            <th>Kilométrage relatif</th>
            <th>Pièce</th>
            <th>Etat</th>
        </thead>
           <tbody>
                <td style="background: white">{{$contenir->Equipement->designation}}</td>
                <td style="background: white">{{$contenir->Equipement->kilometrageMax}} KM</td>
                <td style="background: white">{{$contenir->dernierKM}} KM</td>
                <td style="background: white">
                    @if ($contenir->Vehicule->KMActuel-$contenir->dernierKM < 0)
                        <span style="color: red">{{  'Revérifiez vos calculs' }}</span>                    
                    @else
                        {{$contenir->Vehicule->KMActuel-$contenir->dernierKM}} KM
                    @endif
                </td>
                <td style="background: white">
                    @if ($contenir->Vehicule->KMActuel-$contenir->dernierKM < $contenir->Equipement->kilometrageMax)
                    <span style="color: darkgreen">{{ 'Aucune' }}</span>
                    @else
                        @forelse ($contenir->Equipement->piece_n_ss as $piece)
                            {{$piece->NomPiece}},
                            @empty
                        @endforelse</td>    
                    @endif
            
                </td>

                <td style="background: white">
                    @if ($contenir->Vehicule->KMActuel-$contenir->dernierKM  < $contenir->Equipement->kilometrageMax AND $contenir->Vehicule->KMActuel-$contenir->dernierKM >= 0)
                        <span style="color: blue">{{ 'Normal' }}</span>
                    @endif
                    @if ($contenir->Vehicule->KMActuel-$contenir->dernierKM  >= $contenir->Equipement->kilometrageMax AND $contenir->Vehicule->KMActuel-$contenir->dernierKM >= 0)
                        <span style="color: red">{{  'Nécessite une maintenance' }}</span>
                    @endif
                    @if ($contenir->Vehicule->KMActuel-$contenir->dernierKM  <= $contenir->Equipement->kilometrageMax AND $contenir->Vehicule->KMActuel-$contenir->dernierKM < 0)
                    <span style="color: blue">{{ 'Normal' }}</span>
                    @endif
                </td>
            </tbody>
    </table>
</div>
    
@endsection
