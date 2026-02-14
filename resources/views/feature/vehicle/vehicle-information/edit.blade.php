@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/create.css')}}">

<body id="totalite" class="bg-dark text-dark">
    <div class="container bg-light bloc" style="align-content: center!important">

        <header class="topbar">
            <h2 style="font-size:18px; font-weight:600;">➕ Modifier un véhicule</h2>
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
                    <form class="form-sample" method="POST" action="{{ route('vehicules.update', $vehicule->id) }}">
                        @csrf
                        @method('PATCH')

                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                            @endforeach
                        @endif

                        <div class="row">
                            <h4 class="card-title text-primary col-md-11">Véhicule numéro {{ $vehicule->id }}</h4>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary btn-circle rounded-circle">
                                    Modifier
                                </button>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Immatriculation</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Plaque d'immatriculation"
                                               name="PlaqueImmatric" value="{{ $vehicule->PlaqueImmatric }}"
                                               @if (!Auth::user()->admin) readonly @endif />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Véhicule</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Véhicule"
                                               name="Vehicule" value="{{ $vehicule->Vehicule }}"
                                               @if (!Auth::user()->admin) readonly @endif />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Consommation</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" placeholder="Consommation"
                                               name="Consommation" value="{{ $vehicule->Consommation }}"
                                               @if (!Auth::user()->admin) readonly @endif />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Energie</label>
                                    <div class="col-sm-9">
                                        @if (Auth::user()->admin)
                                            <select class="form-control" name="Energie">
                                                <option value="Essence" {{ $vehicule->Energie == 'Essence' ? 'selected' : '' }}>Essence</option>
                                                <option value="Diesel" {{ $vehicule->Energie == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                            </select>
                                        @else
                                            <input type="text" class="form-control" value="{{ $vehicule->Energie }}" readonly />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Puissance (Ch)</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" placeholder="Puissance"
                                               name="CV" value="{{ $vehicule->CV }}"
                                               @if (!Auth::user()->admin) readonly @endif />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Kilométrage</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" placeholder="Kilométrage actuel"
                                               name="KMActuel" value="{{ $vehicule->KMActuel }}" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Mise en circulation</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="AnneeMenCirc"
                                               value="{{ $vehicule->AnneeMenCirc }}"
                                               @if (!Auth::user()->admin) readonly @endif />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label>Date Entrée</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="DateEntree"
                                               value="{{ $vehicule->DateEntree }}"
                                               @if (!Auth::user()->admin) readonly @endif />
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

@endsection
