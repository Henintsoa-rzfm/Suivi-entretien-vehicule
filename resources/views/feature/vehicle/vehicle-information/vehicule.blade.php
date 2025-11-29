@extends('layouts.app')
@section('content')

{"id":"61530","variant":"standard","title":"Fiche véhicule Blade professionnelle minimaliste"}
<div class="container py-4" style="font-family: Arial, sans-serif; color:#1a1a1a;">

    <!-- Watermark -->
    <img src="{{ asset('images/visite2.png') }}" alt="" class="position-fixed" style="top:200px; left:700px; opacity:0.05; z-index:-1; width:250px; height:auto;">

    <!-- Header -->
    <h2 class="text-center mb-4" style="font-weight:600; letter-spacing:1px;">FICHE DU VEHICULE N° {{ $vehicule->PlaqueImmatric }}</h2>
    <hr style="border-top:2px solid #ccc; margin-bottom:2rem;">

    <!-- Vehicle Info -->
    <section class="d-flex justify-content-between mb-4">
        <div>
            <p><strong>Plaque Immatriculation :</strong> {{ $vehicule->PlaqueImmatric }}</p>
            <p><strong>Véhicule :</strong> {{ $vehicule->Vehicule }}</p>
            <p><strong>Energie :</strong> {{ $vehicule->Energie }}</p>
            <p><strong>Consommation :</strong> {{ $vehicule->Consommation }} L/100km</p>
        </div>
        <div>
            <p><strong>CV :</strong> {{ $vehicule->CV }} ph</p>
            <p><strong>Date d'entrée :</strong> {{ date('d M Y', strtotime($vehicule->DateEntree)) }}</p>
            <p><strong>Kilométrage actuel :</strong> {{ $vehicule->KMActuel }} KM</p>
        </div>
        <div>
            <p><strong>Année mise en circulation :</strong> {{ date('d M Y', strtotime($vehicule->AnneeMenCirc)) }}</p>
            <p><strong>Dernière mise à jour :</strong> {{ date('d M Y', strtotime($vehicule->updated_at)) }}</p>
            <p><strong>Date actuelle :</strong> {{ date('d M Y', strtotime($date1)) }}</p>
        </div>
    </section>

    <!-- Visite & Assurance -->
    <div class="row mb-5">
        <div class="col-md-6 mb-3">
            <div class="p-3 border rounded shadow-sm text-center">
                <h5 class="mb-2">Visite Technique</h5>
                @if(isset($vehicule->Visite->Date_exp_Visite))
                    @php
                        $dateVisite = \Carbon\Carbon::parse($vehicule->Visite->Date_exp_Visite);
                        $alertVisite = '';
                        if ($date1 >= $dateVisite) $alertVisite = ['Expirée', 'danger'];
                        elseif ($date1 >= $dateVisite->subDays(15)) $alertVisite = ['À renouveler bientôt', 'warning'];
                        else $alertVisite = ['Valide', 'success'];
                    @endphp
                    <span class="badge badge-{{ $alertVisite[1] }}" style="font-size:0.9rem; padding:0.5em 1em;">{{ $alertVisite[0] }}</span>
                @else
                    <span class="text-muted">Non renseignée</span>
                @endif
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="p-3 border rounded shadow-sm text-center">
                <h5 class="mb-2">Assurance</h5>
                @if(isset($vehicule->Assurance->Date_exp_Assurance))
                    @php
                        $dateAss = \Carbon\Carbon::parse($vehicule->Assurance->Date_exp_Assurance);
                        $alertAss = '';
                        if ($date1 >= $dateAss) $alertAss = ['Expirée', 'danger'];
                        elseif ($date1 >= $dateAss->subDays(15)) $alertAss = ['À renouveler bientôt', 'warning'];
                        else $alertAss = ['Valide', 'success'];
                    @endphp
                    <span class="badge badge-{{ $alertAss[1] }}" style="font-size:0.9rem; padding:0.5em 1em;">{{ $alertAss[0] }}</span>
                @else
                    <span class="text-muted">Non renseignée</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Equipements -->
    <h5 class="mb-3" style="font-weight:500;">Révisions & Équipements</h5>
    <table class="table table-hover table-sm text-center" style="border-collapse:collapse;">
        <thead class="table-light">
            <tr>
                <th>Révision</th>
                <th>KM Max</th>
                <th>Dernier KM</th>
                <th>KM Relatif</th>
                <th>Pièces à remplacer</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicule->equipements as $equipement)
                @php $kmRelatif = $vehicule->KMActuel - $equipement->pivot->dernierKM; @endphp
                <tr>
                    <td>{{ $equipement->designation }}</td>
                    <td>{{ $equipement->kilometrageMax }} KM</td>
                    <td>{{ $equipement->pivot->dernierKM }} KM</td>
                    <td>
                        @if($kmRelatif < 0)
                            <span class="text-danger">Revérifiez</span>
                        @else
                            {{ $kmRelatif }} KM
                        @endif
                    </td>
                    <td>
                        @if($kmRelatif >= $equipement->kilometrageMax)
                            @forelse($equipement->piece_n_ss as $piece)
                                {{ $piece->NomPiece }}{{ !$loop->last ? ',' : '' }}
                            @empty
                                Aucune
                            @endforelse
                        @else
                            Aucune
                        @endif
                    </td>
                    <td>
                        @if($kmRelatif < 0)
                            <span class="text-danger">Revérifiez</span>
                        @elseif($kmRelatif < $equipement->kilometrageMax)
                            <span class="text-success">Normal</span>
                        @else
                            <span class="text-warning">Maintenance nécessaire</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Aucun équipement enregistré</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- Interventions -->
    <h5 class="mt-5 mb-3" style="font-weight:500;">Interventions</h5>
    <table class="table table-hover table-sm text-center">
        <thead class="table-light">
            <tr>
                <th>Intervention</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Réparation</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicule->interventions as $intervention)
                @php
                    $status = '';
                    if($date1 < $intervention->DateIntervention && $intervention->Validation == 'En attente') $status = ['En attente','danger'];
                    elseif($date1 < $intervention->DateIntervention && $intervention->Validation == 'Validée') $status = ['Date fixée','primary'];
                    elseif($date1 >= $intervention->DateIntervention && $date1 <= $intervention->DateLimite && $intervention->Validation == 'En attente') $status = ['A reporter','danger'];
                    elseif($date1 >= $intervention->DateIntervention && $date1 <= $intervention->DateLimite && $intervention->Validation == 'Validée') $status = ['En cours','warning'];
                    elseif($date1 > $intervention->DateLimite && $intervention->Validation == 'Validée') $status = ['Terminée','success'];
                    else $status = ['A reporter','danger'];
                @endphp
                <tr>
                    <td>{{ $intervention->nature }}</td>
                    <td>{{ date('d M Y', strtotime($intervention->DateIntervention)) }}</td>
                    <td>{{ date('d M Y', strtotime($intervention->DateLimite)) }}</td>
                    <td>{{ $intervention->Validation }}</td>
                    <td>
                        <span class="badge badge-{{ $status[1] }}" style="font-size:0.85rem; padding:0.4em 0.8em;">{{ $status[0] }}</span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Aucune intervention</td></tr>
            @endforelse
        </tbody>
    </table>

</div>


<div class="container impr" style="position: relative">
<img src="{{asset('images/visite2.png')}}" alt="" style="position: fixed; top:200px;left:700px; opacity:0.2">
</div>

@endsection
