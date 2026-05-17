@extends('layouts.app')
@section('content')    
<div class="container MonT">
<div class="op">
  <p class="display-6 text-dark">Contrat d'assurances</p>
  <div class="mesbout">
      <a href="{{route('assurances.create')}}" class="header_img btn btn-primary btn-circle rounded-circle">
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
                    @if ($max>0)
                    100%
                   @else
                    0   
                   @endif 
                  </h3>
                  <p class="text-dark ml-2 mb-0 font-weight-medium"></p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-dark ">
                  {{-- <span class="mdi mdi-arrow-top-right icon-item"></span> --}}
                </div>
              </div>
            </div>
            <h6 class="text-secondary font-weight-normal">Contrat d'assurances : {{ $max }}</h6>
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
                   @if ($exp>0)  
                    {{round(((100 * $exp)/ $max), 2)}} %</h3>
                   @else
                        0 %
                   @endif</h3>
                  <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-dark">
                  {{-- <span class="mdi mdi-arrow-top-right icon-item"></span> --}}
                </div>
              </div>
            </div>
            <h6 class="text-secondary font-weight-normal">Contrat expirée : {{$exp}}</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0 text-secondary">
                    @if ($exp>0)  
                    {{round(((100 * $da)/ $max), 2)}} %</h3>
                   @else
                        0 %
                   @endif</h3>
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
            <h6 class="text-secondary font-weight-normal">Contrat valide : {{$da}}</h6>
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
                    @if ($max > 0)
                        @if ($nbV >= $max)
                          {{round((($nbV-$max)*100)/$nbV)}} %
                        @else
                          {{round((($max-$nbV)*100)/$nbV)}} %
                        @endif
                    @else
                        0
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
            <h6 class="text-secondary font-weight-normal">
              Véhicule sans contrat d'assurance : 
              @if ($nbV >= $max)
                {{$nbV - $max}} sur {{$nbV}}
              @else
                {{$max - $nbV}} sur {{$nbV}} 
              @endif
            </h6>
          </div>
        </div>
      </div>
    </div>
</section><br>
<!--  -->
  <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-description">  <code class="text-light" style="font-size: 17px">La liste des contrats d'assurance</code>
          </p>
          <div class="table-responsive">
            <style> #myInput{display: none; width: 100%; height: 50px;padding: 20px; border-radius: 5px}</style>
            <input style="background:none; border:1px solid lightgrey; color:white" type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher">
         
            <table class="text-center table table-hover" id="myTable">
              <thead>
                  <tr class="tet">
                      <th class="text-light font-weight-bold">Date Assurance</th>
                      <th class="text-light font-weight-bold">Date d'éxpiration de l'assurance</th>
                      <th class="text-light font-weight-bold">Véhicule</th>
                      <th class="text-light font-weight-bold">Contrat d'assurance</th>
                      <th class="text-light font-weight-bold"></th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($assurances as $assurance)
                <tr>
                    <style>
                        td a{color: white!important};
                    </style>
                    <td>
                        <a style="text-decoration:none" href="{{route('assurances.show', ['id' => $assurance->id])}}">{{date('d M Y', strtotime($assurance->DateAssurance))}}</a>
                    </td>
                    <td>
                        <a style="text-decoration:none" href="{{route('assurances.show', ['id' => $assurance->id])}}">{{date('d M Y', strtotime($assurance->Date_exp_Assurance))}}</a>
                    </td>
                    <td>
                        <a style="text-decoration:none" href="{{route('assurances.show', ['id' => $assurance->id])}}">{{$assurance->PlaqueImmatric}}</a>
                    </td>
                    <td>
                      @if ($andro >= \Carbon\Carbon::parse($assurance->Date_exp_Assurance)->subDays(15) AND $andro<$assurance->Date_exp_Assurance)
                          <span class="badge badge-danger">Assurance à faire avant le {{date('d M Y', strtotime($assurance->Date_exp_Assurance))}}</span>
                      @endif
                      @if ($andro >= $assurance->Date_exp_Assurance)
                          <span class="badge badge-danger">Expirée</span>
                      @endif
                      @if($andro < $assurance->Date_exp_Assurance AND $andro < \Carbon\Carbon::parse($assurance->Date_exp_Assurance)->subDays(15))
                          <span class="badge badge-primary">Expirée le {{date('d M Y', strtotime($assurance->Date_exp_Assurance))}}</span>                              
                      @endif
                      {{-- @if ($andro >= $assurance->Date_exp_Assurance)
                          <span class="badge badge-danger">Expirée</span>
                      @else
                        <span class="badge badge-primary">Expirée le {{date('d M Y', strtotime($assurance->Date_exp_Assurance))}}</span>
                      @endif --}}
                    </td>
                  </td>
                    <td>
                        <a style="text-decoration:none" href="{{ route('assurances.edit', $assurance->id)}}" class="btn btn-success btn-circle">
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