@extends('layouts.app')
@section('content')   
<br>
<style>
.ton{font-weight: bold}
</style>
<div class="container text-dark" style="position: relative">
    <div class="row">
      <section class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card bg-dark">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-white"></h3>
                        <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="icon icon-box-dark">
                        <span class="mdi mdi-arrow-top-right icon-item"></span>
                      </div>
                    </div>
                  </div>
                  <h6 class="text-secondary font-weight-normal">Membres du personnel</h6>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card bg-dark">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-secondary">{{$vehicules}}</h3>
                        <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="icon icon-box-dark">
                        <span class="mdi mdi-arrow-top-right icon-item"></span>
                      </div>
                    </div>
                  </div>
                  <h6 class="text-secondary font-weight-normal">Véhicules</h6>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body bg-dark">
                  <div class="row">
                    <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-light">
                        @if (isset($pannes))
                          {{$pannes}}
                        @else
                            0
                        @endif
                        </h3>
                        <p class="text-danger ml-2 mb-0 font-weight-medium"></p>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="icon icon-box-dark">
                        <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                      </div>
                    </div>
                  </div>
                  <h6 class="text-secondary font-weight-normal">Pannes enregistrées</h6>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body bg-dark">
                  <div class="row">
                    <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-light">
                          @if (isset($interventions))
                            {{$interventions}}
                          @else
                              0
                          @endif
                        </h3>
                        <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="icon icon-box-dark ">
                        <span class="mdi mdi-arrow-top-right icon-item"></span>
                      </div>
                    </div>
                  </div>
                  <h6 class="text-secondary font-weight-normal">Interventions</h6>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <section class="container">
              <div class="row">
                  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-dark">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                              <h3 class="mb-0 text-danger">
                                @if (isset($intE))
                                  {{$intE}}
                                @else
                                    0
                                @endif
                            
                              </h3>
                              <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="icon icon-box-dark ">
                              <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                          </div>
                        </div>
                        <h6 class="text-secondary font-weight-normal">Intervention(s) en attente</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-dark">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                              <h3 class="mb-0 text-light">
                                @if (isset($vehicules))
                                  <span class="text-warning">{{$special}}</span>
                                @else
                                    0
                                @endif
                            
                              </h3>
                              <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="icon icon-box-dark">
                              <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                          </div>
                        </div>
                        <h6 class="text-secondary font-weight-normal">Alertes (Entretien à faire)</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body bg-dark">
                        <div class="row">
                          <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                              <h3 class="mb-0 text-light">
                                @if (isset($pns))
                                  {{$pns}}
                                @else
                                    0
                                @endif
                              </h3>
                              <p class="text-danger ml-2 mb-0 font-weight-medium"></p>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="icon icon-box-dark">
                              <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                            </div>
                          </div>
                        </div>
                        <h6 class="text-secondary font-weight-normal">Types de Panne enregistrés
                          {{-- <p>Panne le plus fréquent :  --}}
                            {{-- {{$mverina}} --}}
                          {{-- </p> --}}
                        </h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body bg-dark">
                        <div class="row">
                          <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                              <h3 class="mb-0 text-light">
                                @if (isset($nombres))
                                  {{$nombres}}
                                @else
                                    0
                                @endif
                              </h3>
                              <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="icon icon-box-dark ">
                              <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                          </div>
                        </div>
                        <h6 class="text-secondary font-weight-normal">Pièces liées à des interventions</h6>
                      </div>
                    </div>
                  </div>
                </div>
          

          <div class="row">
            <div class="col-12">
              <div class="card bg-dark">
                <div class="card-body bg-dark">
                  <h4 class="card-title">Statistiques</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <h6 class="text-secondary">Le personnel</h6>
                      <div class="table-responsive bg-dark">
                        <table class="table text-light bg-dark">
                          <tbody>
                            <tr>
                              <td class="text-light">
                                <i class="fas fa-users"></i>
                              </td>
                              <td>Nombre de personnel</td>
                              <td class="text-right">
                                {{-- @if (isset($chauffeurs) OR isset($mecaniciens) OR isset($detenteurs)) --}}
                                    {{-- {{$chauffeurs + $detenteurs + $mecaniciens}} --}}
                                {{-- @endif --}}
                              </td>
                              <td class="text-right font-weight-medium"> 100% </td>
                            </tr>
                            <tr>
                              <td class="text-primary">
                                <i class="fas fa-user"></i>
                              </td>
                              <td>Nombre des détenteurs</td>
                              <td class="text-right">
                                
                                    0
                                </td>
                              <td class="text-right font-weight-medium"> 
                                
                              </td>
                            </tr>
                            <tr>
                              <td class="text-warning">
                                <i class="fas fa-user"></i>
                              </td>
                              <td>Nombres des Chauffeurs</td>
                              <td class="text-right">  
                                    0
                              </td>
                              <td class="text-right font-weight-medium">
                                
                              </td>
                            </tr>
                            <tr>
                              <td class="text-secondary">
                                <i class="fas fa-user"></i>
                              </td>
                              <td>Nombre des mécaniciens</td>
                              <td class="text-right">
                                
                              </td>
                              <td class="text-right font-weight-medium">
                                
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    {{-- <p class="text-light">{{$panneMve}}</p> --}}
                    <div class="col-md-6">
                      <h6 class="text-secondary">Les papiers des véhicules</h6>
                      <div class="table-responsive">
                        <table class="table text-light">
                          <tbody>
                            <tr>
                              <td class="text-light">
                                <i class="fas fa-book"></i>
                              </td>
                              <td>Total des visites et assurances enregistées</td>
                              <td class="text-right">
                                @if (isset($visites) OR isset($assurances))
                                {{$visites + $assurances}}
                                @else
                                    0
                                @endif
                              </td>
                              <td class="text-right font-weight-medium"> 100% </td>
                            </tr>
                            <tr>
                              <td class="text-muted">
                                <i class="fas fa-book"></i>
                              </td>
                              <td>Visites techniques enregistées</td>
                              <td class="text-right">
                                @if (isset($visites))
                                {{$visites}}
                                @else
                                    0
                                @endif
                              </td>
                              <td class="text-right font-weight-medium">
                                @if (($visites + $assurances) > 0)
                                  {{round(($visites*100)/($visites + $assurances))}}%
                                @endif
                              </td>
                            </tr>
                            <tr>
                              <td class="text-info">
                                <i class="fas fa-book"></i>
                              </td>
                              <td>Nombre de Contrat d'assurance</td>
                              <td class="text-right">
                                @if (isset($assurances))
                                  {{$assurances}}
                                @else
                                    0
                                @endif
                              </td>
                              <td class="text-right font-weight-medium">
                                @if (($visites + $assurances) > 0)
                                  {{round(($assurances*100)/($visites + $assurances))}}%
                                @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    


      </section><br>
  </div>
  <br>
    
  </div>


<style> 
  .card1 img{height: 195px;}
  .ity{margin: auto}
    .card1 {
      /* Add shadows to create the "card" effect */
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width: 300px;
      margin: auto
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
