@extends('layouts.app')
@section('content')   
<br>
<style>
.Mon{justify-content: space-evenly}
.ton{font-weight: bold}
</style>
<div class="container ity text-dark">
    <div>
        <p class="display-6 text-center">Papier des véhicules</p>
    </div><br><br>
    <div class="row Mon">

        <div class="card1">
          <br>
          <img src="{{asset("images/visite2.png")}}" alt="Avatar" style="width:100%">
          <div class="container">
            <h4><b>Visite technique</b></h4>
            <p>La liste des visites techniques des véhicules dans la DST</p>
            <a href="{{route('visites')}}" class="btn MonBouton">Liste des visites</a>
          </div>
          <br>
        </div>
        <div class="card1">
          <br>
          <img src="{{asset("images/a.png")}}" alt="Avatar" style="width:100%">
          <div class="container">
            <h4><b>Assurance</b></h4>
            <p>La liste des assurances de véhicule dans la DST</p>
            <a href="{{route('assurances')}}" class="btn MonBouton">Liste des assurances</a>
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
    /* margin: auto; */
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