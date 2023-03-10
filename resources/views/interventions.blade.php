@extends('layouts.app')
@section('content')    
<div class="container MonT">
<div class="op">
  <p class="display-6 text-dark">Les interventions</p>
  <div class="mesbout">
      <a href="{{route('interventions.create')}}" class="header_img btn btn-primary btn-circle rounded-circle">
          <i class="fas fa-add"></i>
      </a>
      <button type="submit" class="btn btn-secondary btn-circle rounded-circle rounded-circle" id="hide">
          <i class="fas fa-search"></i>
      </button>
      <a href="{{route('nombres.create')}}" class="header_img btn btn-info btn-circle rounded-circle">
        <i class="fas fa-wrench"></i>
      </a>
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
                  <h3 class="mb-0 text-secondary">100%</h3>
                  <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-dark ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-secondary font-weight-normal">Interventions : {{ $nbI }}</h6>
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
                  @if ($nbI> 0)
                  {{round((($intV*100)/$nbI), 2)}} %  
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
            <h6 class="text-secondary font-weight-normal">Réparation validée : {{$intV}}</h6>
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
                  @if ($nbI>0)
                    {{round((($intE*100)/$nbI), 2)}} %
                  @else
                      0 %
                  @endif
                    </h3>
                  <p class="text-danger ml-2 mb-0 font-weight-medium"></p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-dark">
                  {{-- <span class="mdi mdi-arrow-bottom-left icon-item"></span> --}}
                </div>
              </div>
            </div>
            <h6 class="text-secondary font-weight-normal">Réparation non validée : {{$intE}}</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0 text-success">
                  @if ($nbI>0)  
                    {{round((($rep*100)/$nbI), 2)}} %
                  @else
                      0 %
                  @endif
                  </h3>
                  <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-dark ">
                  {{-- <span class="mdi mdi-arrow-top-right icon-item"></span> --}}
                </div>
              </div>
            </div>
            <h6 class="text-secondary font-weight-normal">Réparation terminée : {{$rep}}</h6>
          </div>
        </div>
      </div>
    </div>
</section><br>
<!--  -->
  <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-description">  <code class="text-light" style="font-size: 17px">La liste des interventions</code>
          </p>
          <div class="table-responsive">
            <style> #myInput{display: none; width: 100%; height: 50px;padding: 20px; border-radius: 5px}</style>
            <input style="background:none; border:1px solid lightgrey; color:white" type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher">
         
            <table class="text-center table table-hover" id="myTable">
              <thead>
                  <tr class="tet">
                      <th class="text-light fontweight-bold">Nature</th>
                      <th class="text-light fontweight-bold">Début</th>
                      <th class="text-light fontweight-bold">Fin</th>
                      <th class="text-light fontweight-bold">Raison</th>
                      <th class="text-light fontweight-bold">Vehicule</th>
                      <th class="text-light fontweight-bold">Statut</th>
                      <th class="text-light fontweight-bold"></th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($interventions as $intervention)
                <tr>
                    <style>
                        td a{color: white!important};
                    </style>
                    <td><a style="text-decoration:none" href="{{route('interventions.show', ['id' => $intervention->id])}}">{{$intervention->nature}}</a></td>
                    <td><a style="text-decoration:none" href="{{route('interventions.show', ['id' => $intervention->id])}}">{{date( 'd M Y',strtotime($intervention->DateIntervention))}}</a></td>
                    <td><a style="text-decoration:none" href="{{route('interventions.show', ['id' => $intervention->id])}}">{{ date('d M Y', strtotime($intervention->DateLimite))}}</a></td>
                    <td><a style="text-decoration:none" href="{{route('interventions.show', ['id' => $intervention->id])}}">{{$intervention->Panne}}</a></td>
                    <td><a style="text-decoration:none" href="{{route('interventions.show', ['id' => $intervention->id])}}">{{$intervention->PlaqueImmatric}}</a></td>
                    <td>                                    
                        @if ($daty < $intervention->DateIntervention AND $intervention->Validation == 'En attente')
                        <a style="text-decoration:none" href="{{route('interventions.show', ['id' => $intervention->id])}}">
                            <span style="color:"><label class="badge badge-danger">En attente</label></span>
                        </a>
                        @endif
                        
                        @if ($daty < $intervention->DateIntervention AND $intervention->Validation == 'Validée')
                        <span style="color:"><label class="badge badge-primary">Date fixée</label></span>
                        @endif

                        @if($daty >= $intervention->DateIntervention AND $daty <= $intervention->DateLimite AND $intervention->Validation == 'En attente') 
                        <span style="color:"><label class="badge badge-danger">A reporter</label></span> 
                        @endif

                        @if($daty >= $intervention->DateIntervention AND $daty > $intervention->DateLimite AND $intervention->Validation == 'En attente') 
                        <span style="color:"><label class="badge badge-danger">A reporter</label></span> 
                        @endif

                        @if($daty >= $intervention->DateIntervention AND $daty <= $intervention->DateLimite AND $intervention->Validation == 'Validée') 
                        <span style="color: blue">
                          <label class="badge badge-warning">En cours</label>
                        </span> 
                        @endif

                        @if($daty > $intervention->DateLimite AND $intervention->Validation == 'Validée') 
                        <span style="color: blue">
                          <label class="badge badge-success">Terminée</label>
                        </span> 
                        @endif
                    </td>
                    <td>
                      @if ($daty > $intervention->DateLimite AND $intervention->Validation == 'Validée')
                          <i class="fas fa-square-check" style="color: white"></i>
                      @else
                        <a href="{{ route('interventions.edit', $intervention->id)}}" class="btn btn-success btn-circle">
                            <i class="fas fa-edit" style="color: white"></i>
                        </a>  
                      @endif
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