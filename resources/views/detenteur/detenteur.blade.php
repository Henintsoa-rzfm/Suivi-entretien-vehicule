@extends('layouts.app')
@section('content')
<body>
            
        <style>
        .blo{display: block}
        .bli{display: block}
        .bla{display: block}
        section{display: flex; justify-content: space-between}
        .masary{width: 100px; height:auto}
        .Masary{width: 150px; height:auto}
        </style>
    <div class="container text-dark">
        <img style="position: fixed; top:200px; opacity:0.05;" src="{{asset('images/pers.jpg')}}" alt="" width="1000px">
        
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
        <br>
        <h3 class="text-center">Fiche du détenteur numero {{$detenteur->id}}</h3><br><br>
        <div style="border: 1px solid black; padding:10px; display:flex; justify-content:space-around">
            <p>Matricule : {{$detenteur->MatrDetenteur}}</p>
            <p>Detenteur : {{$detenteur->Detenteur}}</p>
            <p>Poste : {{$detenteur->Poste}}</p>
        </div>
    </div>

</body>
@endsection
