@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/create.css')}}">

<body id="totalite" class="bg-dark text-dark">

    <header class="topbar">
        <h2 style="font-size:18px; font-weight:600;">➕ Ajouter un véhicule</h2>
        <div class="actions">
            <a href="{{ route('principal') }}">
                <button class="btn">⬅ Retour</button>
            </a>
        </div>
    </header>
    <br>

    <div class="container bg-light bloc">

        <div id="afeno">
            <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
                <div class="card-body rounded">
                    <form class="form-sample" method="POST" action="{{ route('vehicules.store') }}">
                        @csrf

                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                            @endforeach
                        @endif

                        <div class="row">
                            <h4 class="card-title text-primary col-md-11">Véhicule numéro {{ $max }}</h4>
                            <button type="submit" class="btn">Enregistrer</button>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Immatriculation</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="ex : 3421 TAE" name="PlaqueImmatric"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Véhicule</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="ex : Marque Modèle" name="Vehicule"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Consommation (L/100KM)</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" placeholder="ex : 9" name="Consommation"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Energie</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="Energie">
                                            <option>Essence</option>
                                            <option>Diesel</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Puissance (Ch)</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" placeholder="ex : 110" name="CV"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Kilométrage actuel (KM)</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" placeholder="ex : 123098" name="KMActuel"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Mise en circulation</label>
                                    <div class="col-sm-9">
                                        <input type="date" onclick="Daty()" id="debut" class="form-control" name="AnneeMenCirc"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Date Entrée</label>
                                    <div class="col-sm-9">
                                        <input type="date" onclick="deuxDates()" id="fin" class="form-control" name="DateEntree"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

</body>

<script>
    function deuxDates(){
        var x = document.getElementById('debut').value;
        document.getElementById('fin').min = x;
    }
    function Daty(){
        var y = document.getElementById('fin').value;
        document.getElementById('debut').max = y;
    }
</script>

@endsection
