@extends('layouts.app')
      <!-- Fin sidebar -->
@section('content')    
<div class="container MonT">
    <div class="op">
        <p class="display-6 text-dark">Mécaniciens</p>
        <div class="mesbout">
            <a href="{{route('mecaniciens.create')}}" class="header_img btn btn-primary btn-circle rounded-circle">
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
                          @if ($nbM>0)
                              100 % 
                          @else
                              0 % 
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
                  <h6 class="text-secondary font-weight-normal">Mécaniciens : {{$nbM}}</h6>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">
                          @if ( $mois>0 )
                              {{round(($mois*100)/$nbM, 2)}} %
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
                  <h6 class="text-secondary font-weight-normal">Mécaniciens inscrits ce mois : {{$mois}}</h6>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">
                          @if ( $semaine>0 )
                              {{round(($semaine*100)/$nbM, 2)}} %
                          @else
                              0 %
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
                  <h6 class="text-secondary font-weight-normal">Mécaniciens inscrits cette semaine : {{$semaine}}</h6>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-9">
                      <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">
                          @if ( $day>0 )
                              {{round(($day*100)/$nbM, 2)}} %
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
                  <h6 class="text-secondary font-weight-normal">Mécaniciens inscrits aujourd'hui : {{$day}}</h6>
                </div>
              </div>
            </div>
          </div>
    </section><br>
    <!--  -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                {{-- <h4 class="card-title">Chauffeurs</h4> --}}
                <p class="card-description">  <code class="text-light" style="font-size: 17px">La liste des mécaniciens</code>
                </p>
                <div class="table-responsive">
                  <style> #myInput{display: none; width: 100%; height: 50px;padding: 20px; border-radius: 5px}</style>
                  <input style="background:none; border:1px solid lightgrey; color:white" type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher">
               
                  <table class="text-center table table-hover" id="myTable">
                    <thead>
                        <tr class="tet">
                            <th class="text-light font-weight-bold">Matricule</th>
                            <th class="text-light font-weight-bold">Mécanicien</th>
                            <th class="text-light font-weight-bold">inscrit le</th>
                            <th class="text-light font-weight-bold"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mecaniciens as $mecanicien)
                        <tr>
                            <style>
                                td a{color: white!important};
                            </style>
                            <td>
                                <a style="text-decoration: none" href="{{route('mecaniciens.show', ['id' => $mecanicien->id])}}">{{$mecanicien->MatrMeca}}</a>
                            </td>
                            <td>
                                <a style="text-decoration: none" href="{{route('mecaniciens.show', ['id' => $mecanicien->id])}}">{{$mecanicien->Mecanicien}}</a>
                            </td>
                            <td>
                                <a style="text-decoration: none" href="{{route('mecaniciens.show', ['id' => $mecanicien->id])}}">{{date('d M Y', strtotime($mecanicien->created_at))}}</a>
                            </td>
                            <td>
                                <a style="text-decoration: none" href="{{ route('mecaniciens.edit', $mecanicien->id)}}" class="btn btn-success btn-circle">
                                    <i class="fas fa-edit" style="color: white"></i>
                                </a>
                            </td>
                            {{-- <form action="{{route('mecaniciens.destroy', $mecanicien->id)}}" method="post">
                            <td>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash" style="color: white"></i>
                                </button>
                            </td>
                            </form> --}}
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          {{-- </div> --}}
                
            </div>
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
        })
    </script>
</div>    
@endsection