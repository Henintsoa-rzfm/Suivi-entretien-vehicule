@extends('layouts.app')
@section('content')    
<div class="container MonT">
<div class="op">
  <p class="display-6 text-dark">Pannes rencontrées</p>
  <div class="mesbout">
      <a href="{{route('dpannes.create')}}" class="header_img btn btn-primary btn-circle rounded-circle">
          <i class="fas fa-add"></i>
      </a>
      <button type="submit" class="btn btn-secondary btn-circle rounded-circle rounded-circle" id="hide">
          <i class="fas fa-search"></i>
      </button>
  </div>   
</div>
<section class="container">
  <div class="row">
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">
                    @if ($nbP > 0)
                    100%
                    @else
                      0  
                    @endif
                  </h3>
                  <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-dark ">
                  {{-- <span class="mdi mdi-arrow-top-right icon-item"></span> --}}
                </div>
              </div>
            </div>
            <h6 class="text-secondary font-weight-normal">Nombre de pannes: {{ $nbP }}</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0 text-warning">
                    @if ($mois>0)
                        {{round(($mois*100)/$nbP, 2)}} %
                    @else
                        0
                    @endif
                  </h3>
                  <p class="text-success ml-2 mb-0 font-weight-medium">{{--(100 * $nbE)/ $nbV--}}</p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-dark">
                  {{-- <span class="mdi mdi-arrow-top-right icon-item"></span> --}}
                </div>
              </div>
            </div>
            <h6 class="text-secondary font-weight-normal">Panne de ce mois : {{$mois}}</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0 text-primary">
                    @if ($semaine>0)
                        {{round(($semaine*100)/$nbP, 2)}} %
                    @else
                        0 %
                    @endif
                  </h3>
                  <p class="text-danger ml-2 mb-0 font-weight-medium">{{--(100 * $nbD)/ $nbV--}}</p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-dark">
                  {{-- <span class="mdi mdi-arrow-bottom-left icon-item"></span> --}}
                </div>
              </div>
            </div>
            <h6 class="text-secondary font-weight-normal">Panne de cette semaine : {{$semaine}}</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0 text-danger">
                    @if ($jours>0)
                        {{round(($jours*100)/$nbP, 2)}} %
                    @else
                        0 %
                    @endif
                  </h3>
                  <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-dark">
                  {{-- <span class="mdi mdi-arrow-top-right icon-item"></span> --}}
                </div>
              </div>
            </div>
            <h6 class="text-secondary font-weight-normal">Panne de ce jours : {{$jours}}</h6>
          </div>
        </div>
      </div>
    </div>
</section><br>
<!--  -->
  <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-description">  <code class="text-light" style="font-size: 17px">La liste des pannes</code>
          </p>
          <div class="table-responsive">
            <style> #myInput{display: none; width: 100%; height: 50px;padding: 20px; border-radius: 5px}</style>
            <input style="background:none; border:1px solid lightgrey; color:white" type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher">
         
            <table class="text-center table table-hover" id="myTable">
              <thead>
                  <tr class="tet">
                      <th class="text-light fontweight-bold">Plaque d'Immatriculation</th>
                      <th class="text-light fontweight-bold">Vehicule</th>
                      <th class="text-light fontweight-bold">Panne</th>
                      <th class="text-light fontweight-bold">Date de la panne</th>
                      <th class="text-light fontweight-bold"></th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($dpannes as $dpanne)
                <tr>
                    <style>
                        td a{color: white!important};
                    </style>
                    <td>
                        <a style="text-decoration:none" href="{{route('dpannes.show', ['id' => $dpanne->id])}}">{{$dpanne->PlaqueImmatric}}</a>
                    </td>
                    <td>
                        <a style="text-decoration:none" href="{{route('dpannes.show', ['id' => $dpanne->id])}}">{{$dpanne->Vehicule}}</a>
                    </td>
                    <td>
                        <a style="text-decoration:none" href="{{route('dpannes.show', ['id' => $dpanne->id])}}">{{$dpanne->TypePanne}}</a>
                    </td>
                    <td>
                        <a style="text-decoration:none" href="{{route('dpannes.show', ['id' => $dpanne->id])}}">{{date('d M Y', strtotime($dpanne->DatePanne))}}</a>
                    </td>
                    <td>
                        <a style="text-decoration:none" href="{{ route('dpannes.edit', $dpanne->id)}}" class="btn btn-success btn-circle">
                            <i class="fas fa-edit" style="color: white"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
      
              </tbody>

            </table>
          </div>
        </div>
      </div>
      </div>
<script type="text/javascript">
  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
  })
</script>
</div>    
@endsection