@extends('layouts.app')
@section('content')    
<div class="container MonT">

    <div class="op">
        <p class="display-6" style="color: black">Véhicule</p>
        <div class="mesbout">
          @if (Auth::user()->admin)
            <a href="{{route('vehicules.create')}}" class="header_img btn btn-primary btn-circle rounded-circle">
              <i class="fas fa-add"></i>
            </a>
          @else
              
          @endif
          <button type="submit" class="btn btn-secondary btn-circle rounded-circle" id="hide">
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
                        <h3 class="mb-0 text-secondary">
                        @if ($nbV>0)
                          100%
                        @else
                            0
                        @endif
                        </h3>
                        <p class="text-primary ml-2 mb-0 font-weight-medium">  </p>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="icon icon-box-dark ">
                        <span class="mdi mdi-arrow-top-right icon-item"></span>
                      </div>
                    </div>
                  </div>
                  <h6 class="text-secondary font-weight-normal">Nombre de véhicule : {{$nbV}}</h6>
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
                          @if ($nbV>0)  
                          {{round(((100 * $nbE)/ $nbV), 2)}} %
                          @else
                              0 %
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
                  <h6 class="text-secondary font-weight-normal">Véhicules Essence : {{$nbE}}</h6>
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
                          @if ($nbV>0)  
                            {{round(((100 * $nbD)/ $nbV), 2)}} %</h3>
                          @else
                              0 %
                          @endif
                        <p class="text-danger ml-2 mb-0 font-weight-medium"></p>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="icon icon-box-dark">
                        <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                      </div>
                    </div>
                  </div>
                  <h6 class="text-secondary font-weight-normal">Véhicules Diesel : {{$nbD}}</h6>
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
                          @if ($eq>0)  
                          {{round((($special*100)/$eq), 2)}} %/{{$eq}}
                          @else
                              0 %
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
                  <h6 class="text-secondary font-weight-normal">Alertes Entretien : <span class="text-danger">{{$special}}</span> sur {{$eq}}</h6>
                </div>
              </div>
            </div>
          </div>
        
    </section><br>


  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        {{-- <h4 class="card-title">Hoverable Table</h4> --}}
        <p class="card-description">  <code class="text-light" style="font-size: 17px">La liste des véhicules</code>
        </p>
        <div class="table-responsive">
          <style> #myInput{display: none; width: 100%; height: 50px;padding: 20px; border-radius: 5px}</style>
          <input style="background:none; border:1px solid lightgrey; color:white" type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher">
       
          <table class="table table-hover text-center" id="myTable">
            <thead>
              <tr class="tet">
                <th class="text-light font-weight-bold">Immatriculation</th>
                <th class="text-light font-weight-bold">Véhicule</th>
                <th class="text-light font-weight-bold">Energie</th>
                <th class="text-light font-weight-bold">Chauffeur</th>
                <th class="text-light font-weight-bold">Detenteur</th>
                <th class="text-light font-weight-bold"></th>
            </tr>
            </thead>
            <tbody>
              @foreach ($vehicules as $vehicule)
              <tr >
                  <style>
                      td a{color: white!important};
                  </style>
                  <td><a style="text-decoration:none" href="{{route('vehicules.show', ['id' => $vehicule->id])}}">{{$vehicule->PlaqueImmatric}}</a></td>
                  <td><a style="text-decoration:none" href="{{route('vehicules.show', ['id' => $vehicule->id])}}">{{$vehicule->Vehicule}}</a></td>
                  <td><a style="text-decoration:none" href="{{route('vehicules.show', ['id' => $vehicule->id])}}">{{$vehicule->Energie}}</a></td>
                  <td><a style="text-decoration:none" href="{{route('vehicules.show', ['id' => $vehicule->id])}}">{{$vehicule->Chauffeur}}</a></td>
                  <td><a style="text-decoration:none" href="{{route('vehicules.show', ['id' => $vehicule->id])}}">{{$vehicule->Detenteur}}</a></td>
                  <td>
                      <a style="text-decoration:none" href="{{ route('vehicules.edit', $vehicule->id)}}" class="btn btn-success btn-circle">
                          <i class="fas fa-edit" style="color: white"></i>
                      </a>
                  </td>
              @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
@endsection

{{-- <form action="{{route('vehicules.destroy', $vehicule->id)}}" method="post">
                            <td>
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Etes-vous sûr de supprimé ?')" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash" style="color: white"></i>
                                </button>
                            </td>
                            </form>
                        </tr> --}}
