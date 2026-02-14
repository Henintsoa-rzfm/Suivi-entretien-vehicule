@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/pagination.css')}}">
<header class="topbar">
    <div class="search">
        🔍 <input placeholder="Rechercher...">
    </div>
    <div class="actions">
        @can('create', \App\Models\Vehicule::class)
            <button class="btn">
                <a class="btn" href="{{ route('vehicules.create') }}">
                    + Nouvelle voiture
                </a>
            </button>
        @endcan
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
    <div class="muted">{{$essenceVehiclePercentage}} %</div>
    </div>
    <div class="card">
    <div class="muted">Véhicules diesel</div>
    <div class="value">{{$dieselVehiclesCount}}</div>
    <div class="muted">{{$dieselVehiclePercentage}} %</div>
    </div>
</section>
    <br>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
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

        {{-- Pagination alignée au centre --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $vehicules->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

    </div>
</div>

</div>
@endsection
