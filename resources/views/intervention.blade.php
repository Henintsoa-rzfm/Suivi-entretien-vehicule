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
<div class="container-fluid text-dark">

    <section style="position: relative">
        <div class="blo">
            <img src="{{asset('images/index.JPG')}}" alt="" class="masary" style="width: 100px">
        </div>
        <div class="bli">
            <img src="{{asset('images/rep.JPG')}}" alt="" class="Masary" style="width: 150px">
        </div>
        <div class="bla">
            <img src="{{asset('images/LogoDST.png')}}" alt="" class="masary" style="width: 90px">
        </div>
    </section><br><br>
    <section>
        <h3 class="text-center" style="margin: auto">Fiche d'intervention  numero {{$intervention->id}}</h3>
    </section>
    <br><br>
    <section style="font-size: 12pt;padding:10px">    
        <div class="blo">
            <p><u>Mécanicien :</u> Mr {{$intervention->Mecanicien->Mecanicien}}</p>
            <p><u>Véhicule :</u> {{$intervention->Vehicule->PlaqueImmatric}}</p>        
            <p><u>Nature :</u> {{$intervention->nature}}</p>        
            <p><u>Raison :</u> {{$intervention->Panne}}</p>
        </div>
        <div class="blo">
            <p><u>Début :</u> {{ date('d M Y', strtotime($intervention->DateIntervention))}}</p>
            <p><u>Fin :</u> {{date('d M Y', strtotime($intervention->DateLimite))}}</p>
            <p><u>Lieu :</u> {{$intervention->lieuIntervention}}</p>
            <p><u>Enregistré le :</u> {{date('d M Y', strtotime($intervention->created_at))}}</p>
        </div>
        <div class="bli">
            <p><u>Mise à jour du :</u> {{date('d M Y', strtotime($intervention->updated_at))}}</p>
            <p><u>Réparation :</u> {{$intervention->Validation}}</p>
            <p><u>Statut de l'intervention :</u> 
                @if ($daty < $intervention->DateIntervention AND $intervention->Validation == 'En attente')
                <a style="text-decoration:none;" href="{{route('interventions.show', ['id' => $intervention->id])}}">
                    <span style="color:black"><label class="badge badge-danger">En attente</label></span>
                </a>
                @endif
                
                @if ($daty < $intervention->DateIntervention AND $intervention->Validation == 'Validée')
                    <span style="color:"><label class="badge badge-primary">Date fixée</label></span>
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
            </p>
        </div>
    </section>
    <br><br>
    <table  class="container table table-bordered bg bg-light text-center">
        <thead>
            <th>Pièce</th>
            <th>Quantité</th>
            </thead>
           <tbody>
                @foreach ($intervention->nombres as $nombre)
                <tr>
                    <td style="background: white">{{$nombre->Piece->Piece}}</td>
                    <td style="background: white">{{$nombre->Nombre}}</td>
                </tr>
                @endforeach
            </tbody>
    </table>
    <br>
</div>
    {{-- <input type="button" value="Print me"
    onclick="openWin()" /> --}}
<script>
    function openWin() {
        myWindow = window.open("", "", "width=1024, height=768");
        myWindow.document.write("<style> .blo{display: block} .bli{display: block} .bla{display: block} section{display: flex; justify-content: space-around} .masary{width: 100px; height:auto} .Masary{width: 150px; height:auto}</style>");
        myWindow.document.write("<div class='container-fluid text-dark'> <section style='position: relative'> <div class='blo'> <img src='{{asset('images/index.JPG')}}'  class='masary' style='width: 100px'> </div> <div class='bli'> <img src='{{asset('images/rep.JPG')}}' class='Masary' style='width: 150px'> </div> <div class='bla'> <img src='{{asset('images/LogoDST.png')}}' class='masary' style='width: 90px'> </div> </section><br><br>");
        myWindow.document.write("<section><h3 class='text-center' style='margin: auto'; font-family:sans-serif>Fiche d'intervention  numero {{$intervention->id}}</h3></section>");
        myWindow.document.write("<br><br> <section style='font-size: 12pt;padding:10px'> <div class='blo'> <p><u>Mécanicien :</u> Mr {{$intervention->Mecanicien->Mecanicien}}</p> <p><u>Véhicule :</u> {{$intervention->Vehicule->PlaqueImmatric}}</p> <p><u>Nature :</u> {{$intervention->nature}}</p>       <p><u>Raison :</u> {{$intervention->Panne}}</p></div> <div class='blo'> <p><u>Début :</u> {{ date('d M Y', strtotime($intervention->DateIntervention))}}</p> <p><u>Fin :</u> {{date('d M Y', strtotime($intervention->DateLimite))}}</p> <p><u>Lieu :</u> {{$intervention->lieuIntervention}}</p> <p><u>Enregistré le :</u> {{date('d M Y', strtotime($intervention->created_at))}}</p> </div> <div class='bli'> <p><u>Mise à jour du :</u> {{date('d M Y', strtotime($intervention->updated_at))}}</p> <p><u>Réparation :</u> {{$intervention->Validation}}</p> <p><u>Status de l'intervention :</u> @if ($daty < $intervention->DateIntervention AND $intervention->Validation == 'En attente') <a style='text-decoration:none;' href='{{route('interventions.show', ['id' => $intervention->id])}}'> <span style='color:black'><label class='badge badge-danger'>En attente</label></span> </a> @endif @if ($daty < $intervention->DateIntervention AND $intervention->Validation == 'Validée') <span style='color:'><label class='badge badge-primary'>Date fixée</label></span> @endif @if($daty >= $intervention->DateIntervention AND $daty <= $intervention->DateLimite AND $intervention->Validation == 'En attente') <span style='color:'><label class='badge badge-danger'>A reporter</label></span> @endif @if($daty >= $intervention->DateIntervention AND $daty > $intervention->DateLimite AND $intervention->Validation == 'En attente') <span style='color:''><label class='badge badge-danger'>A reporter</label></span> @endif @if($daty >= $intervention->DateIntervention AND $daty <= $intervention->DateLimite AND $intervention->Validation == 'Validée') <span style="color: blue"> <label class='badge badge-warning'>En cours</label> </span> @endif @if($daty > $intervention->DateLimite AND $intervention->Validation == 'Validée') <span style="color: blue"><label class='badge badge-success'>Terminée</label> </span> @endif </p> </div> </section> <br><br>");        
        myWindow.document.write("<table style='margin: auto; border:1px solid black; width: 900px' class='container table table-bordered bg bg-light text-center'> <thead> <th>Pièce</th> <th>Quantité</th> </thead> <tbody> @foreach ($intervention->nombres as $nombre)<tr> <td style='background: white; text-align:center'>{{$nombre->Piece->Piece}}</td> <td style='background: white; text-align:center'>{{$nombre->Nombre}}</td> </tr> @endforeach </tbody> </table> <br> </div>");
}

function resizeWin() {
  myWindow.resizeTo(300, 300);
}
</script>
@endsection
