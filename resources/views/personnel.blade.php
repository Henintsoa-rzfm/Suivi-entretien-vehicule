@extends('layouts.app')
@section('content')   
<br>
<style>
/* .Mon{padding: 10px!important; margin: 15px!important} */
.ton{font-weight: bold}
</style>
<div class="container text-dark">
    <div class="op">
        <p class="display-6 ity">Le Personnel</p>
    </div><br><br>
    <div class="row Mon">
        <div class="card1">
          <br>
          <img src="{{asset("images/pers.JPG")}}" alt="Avatar" style="width:100%">
          <div class="container"><br>
            <h4><b>Détenteurs</b></h4>
            <p>La liste des détenteurs de véhicules dans la DST</p>
            <a href="{{route('detenteurs')}}" class="btn MonBouton">Liste des détenteurs</a>
          </div>
          <br>
        </div>

        <div class="card1">
          <br>
          <img src="{{asset("images/chauffeur.JPG")}}" alt="Avatar" style="width:100%">
          <div class="container"><br>
            <h4><b>Chauffeurs</b></h4>
            <p>La liste des chauffeurs de véhicules dans la DST</p>
            <a href="{{route('chauffeurs')}}" class="btn MonBouton">Liste des chauffeurs</a>
          </div>
          <br>
        </div>

        <div class="card1">
          <br>
          <img src="{{asset("images/meca.JPG")}}" alt="Avatar" style="width:100%">
          <div class="container"><br>
            <h4><b>Mécaniciens</b></h4>
            <p>La liste des mécaniciens au sein de la DST</p>
            <a href="{{route('mecaniciens')}}" class="btn MonBouton">Liste des mécaniciens</a>
          </div>
          <br>
        </div>
    </div>
</div>
<style> 
.card1 img{height: 195px;}
  .ity{margin: auto}
    .card1 {
      /* Add shadows to create the "card" effect */
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width: 300px;
      margin: auto
      /* margin-right: 25px; */
    }
  
    /* On mouse-over, add a deeper shadow */
    .card1:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
  
    /* Add some padding inside the card container */
    .container {
      padding: 2px 16px;
    }
  .card1 {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  border-radius: 5px; /* 5px rounded corners */
  }
  
  /* Add rounded corners to the top left and the top right corner of the image */
  img {
  border-radius: 5px 5px 0 0;
  }
  </style>
@endsection