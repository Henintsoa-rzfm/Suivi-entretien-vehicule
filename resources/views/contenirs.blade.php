@extends('layouts.app')
@section('content')    
<div class="container MonT">
<div class="op">
  <p class="display-6 text-dark">Entretien</p>
  <div class="mesbout">
      <a href="{{route('contenirs.create')}}" class="header_img btn btn-primary btn-circle rounded-circle">
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
                  <h3 class="mb-0 text-secondary">
                    @if ($max>0)  
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
            <h6 class="text-secondary font-weight-normal">Nombre d'entretien : {{ $max }}</h6>
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
                    @if ($month>0)
                      {{ round(($month*100)/$max) }} %
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
            <h6 class="text-secondary font-weight-normal">Nombre d'entretiens effectués ce Mois-ci : {{$month}}</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0 text-info">
                    @if ($month>0)
                      {{ round(($day*100)/$max) }} %
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
            <h6 class="text-secondary font-weight-normal">Nombre d'entretiens effectués aujourd'hui : {{$day}}</h6>
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
                    @if ($max>0)
                      {{ round(($special*100)/$max) }} %
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
            <h6 class="text-secondary font-weight-normal">Alertes : {{$special}}</h6>
          </div>
        </div>
      </div>

    </div>
</section><br>
<!--  -->
  <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-description">  <code class="text-light" style="font-size: 17px">La liste des entretiens</code>
          </p>
          <div class="table-responsive">
            <style> #myInput{display: none; width: 100%; height: 50px;padding: 20px; border-radius: 5px}</style>
            <input style="background:none; border:1px solid lightgrey; color:white" type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher">
         
            <table class="table table-hover" id="myTable">
              <thead>
                  <tr class="tet">
                      <th class="text-light fontweight-bold" style="text-align: center">Immatriculation</th>
                      <th class="text-light fontweight-bold" style="text-align: center">Véhicule</th>
                      <th class="text-light fontweight-bold" style="text-align: center">Entretien</th>
                      <th class="text-light fontweight-bold" style="text-align: center">Dernier Kilometrage</th>
                      <th class="text-light fontweight-bold" style="text-align: center">Etat</th>
                      <th class="text-light fontweight-bold"></th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($contenirs as $contenir)
                {{-- @if ($contenir->KMActuel-$contenir->dernierKM  > $contenir->kilometrageMax) --}}

                <tr>
                    <style>
                        td a{color: white!important};
                    </style>

                    <td style="text-align: center">
                        <a style="text-decoration:none" href="{{route('contenirs.show', ['id' => $contenir->id])}}">{{$contenir->PlaqueImmatric}}</a>
                    </td>
                    <td style="text-align: center">
                        <a style="text-decoration:none" href="{{route('contenirs.show', ['id' => $contenir->id])}}">{{$contenir->Vehicule}}</a>
                    </td>
                    <td style="text-align: center">
                        <a style="text-decoration:none" href="{{route('contenirs.show', ['id' => $contenir->id])}}">{{$contenir->designation}}</a>
                    </td>
                    <td style="text-align: center">
                        <a style="text-decoration:none" href="{{route('contenirs.show', ['id' => $contenir->id])}}">{{$contenir->dernierKM}}</a>
                    </td style="text-align: center">
                    <td style="text-align: center">
                        @if ($contenir->KMActuel-$contenir->dernierKM  < $contenir->kilometrageMax AND $contenir->KMActuel-$contenir->dernierKM >= 0)
                            <span class="text-success">
                                    <i class="fas fa-check fa-lg"></i>
                            </span>
                        @endif
                        @if ($contenir->KMActuel-$contenir->dernierKM  >= $contenir->kilometrageMax AND $contenir->KMActuel-$contenir->dernierKM >= 0)
                            <span class="text-danger"><i class="fas fa-warning fa-lg"></i></span>
                        @endif
                        @if ($contenir->KMActuel-$contenir->dernierKM  <= $contenir->kilometrageMax AND $contenir->KMActuel-$contenir->dernierKM  < 0)
                        <span class="text-danger"><i class="fas fa-x fa-lg"></i></span>
                        @endif
                    </td>
                    <td style="text-align: center">
                        <a style="text-decoration:none" href="{{ route('contenirs.edit', $contenir->id)}}" class="btn btn-success btn-circle">
                            <i class="fas fa-edit" style="color: white"></i>
                        </a>
                    </td>
                </tr>
                {{-- @endif --}}
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
