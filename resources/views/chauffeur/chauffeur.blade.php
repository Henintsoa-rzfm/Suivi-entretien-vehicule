@extends('layouts.app')
@section('content')
<body class="text-dark">
    
<br>
<style>
    .blo{display: block}
    .bli{display: block}
    .bla{display: block}
    section{display: flex; justify-content: space-between}
    .masary{width: 100px; height:auto}
    .Masary{width: 150px; height:auto}
    </style>
<div class="container" style="position: relative">
    <img style="position: fixed; top:100px; left:500px; opacity:0.06;" src="{{asset('images/ch.jpg')}}" width="1000px" alt="">
    <section>
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
    <h3 class="text-center">Fiche du chauffeur numero {{$chauffeur->id}}</h3><br><br>
    <div style="border: 1px solid black; padding:10px; display:flex; justify-content:space-around">
        <p>Matricule : {{$chauffeur->MatrCh}}</p>
        <p>Chauffeur : {{$chauffeur->Chauffeur}}</p>
    </div>
    
</body>
@endsection
