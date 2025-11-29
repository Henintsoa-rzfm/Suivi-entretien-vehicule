@extends('layouts.app')

@section('content')
<header class="topbar">
    <div class="search">
        🔍 <input placeholder="Rechercher...">
    </div>
    <div class="actions">
        <button class="btn">
            @if(Auth::user()->admin)
                <a class="btn" href="{{ route('vehicules.create') }}">
                    + Nouvelle voiture
                </a>
            @endif
        </button>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
        </form>
    </div>
</header>

<div class="container py-4">

<div class="d-flex justify-content-between align-items-center mb-6">
    <h2 class="fw-semibold text-dark">Véhicules</h2>
</div>
<br>

<section class="grid">
      <div class="card">
        <div class="muted">Nombre de véhicule</div>
        <div class="value">{{$vehiclesCount}}</div>
        <div class="muted">+4% vs semaine dernière</div>
      </div>
      <div class="card">
        <div class="muted">Véhicules essence</div>
        <div class="value">{{$essenceVehiclesCount}}</div>
        <div class="muted">{{$essenceVehiclesCount*100/$vehiclesCount}} %</div>
      </div>
      <div class="card">
        <div class="muted">Véhicules diesel</div>
        <div class="value">{{$dieselVehiclesCount}}</div>
        <div class="muted">{{$dieselVehiclesCount*100/$vehiclesCount}} %</div>
      </div>
    </section>
    <br>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="muted" style="margin-bottom:8px;">Dernières interventions</div>
        <table class="table table-hover text-center align-middle mb-0">
            <thead class="table-light text-uppercase">
                <tr>
                    <th>Immatriculation</th>
                    <th>Véhicule</th>
                    <th>Energie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($vehicules as $vehicule)
                    <tr>
                        <td><a href="{{ route('vehicules.show', $vehicule->id) }}" class="text-dark text-decoration-none">{{ $vehicule->PlaqueImmatric }}</a></td>
                        <td><a href="{{ route('vehicules.show', $vehicule->id) }}" class="text-dark text-decoration-none">{{ $vehicule->Vehicule }}</a></td>
                        <td><a href="{{ route('vehicules.show', $vehicule->id) }}" class="text-dark text-decoration-none">{{ $vehicule->Energie }}</a></td>
                        <td>
                            <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="btn btn-success btn-sm rounded-circle p-2" title="Modifier">
                                <i class="fas fa-edit text-white"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
@endsection
