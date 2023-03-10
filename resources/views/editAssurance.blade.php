@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Renouveler le contrat d'assurance</h2>
<br>

        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('assurances.update', $assurance->id)}}"><br>
                @csrf
                @method('PATCH')
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-11">Assurance numero {{ $assurance->id }}</h4>
                  <div class="col-md-1">
                    <button type="submit" class="btn btn-primary btn-circle rounded-circle">
                      <i class="fas fa-check"></i>
                    </button>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Début contrat</label>
                      <div class="col-sm-9">
                        <input id="debut" onclick="daty()" type="date" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="DateAssurance" value="{{$assurance->DateAssurance}}"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Fin du contrat</label>
                      <div class="col-sm-9">
                        <input id="fin" onclick="deuxDates()" type="date" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="Date_exp_Assurance" value="{{$assurance->Date_exp_Assurance}}"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  
                  {{-- <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Véhicule</label>
                      <div class="col-sm-9">
                        <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="vehicule_id" value="{{$assurance->Vehicule->PlaqueImmatric}}" readonly/>
                      </div>
                    </div>
                  </div> --}}
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Véhicule</label>
                      <div class="col-sm-9">
                        <select name="vehicule_id" id="" type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark">
                          @foreach ($vehicules as $vehicule)
                              <option value="{{$vehicule->id}}" @if (old('vehicule_id')== $vehicule->id || $vehicule->id == $assurance->vehicule_id)
                                selected
                              @endif>
                              {{$vehicule->PlaqueImmatric}}  
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <script>
      function deuxDates(){
        var x = document.getElementById('debut').value;
        document.getElementById('fin').min= x;
      }
    </script>
    <script>
      function daty(){
        var x = document.getElementById('fin').value;
        document.getElementById('debut').max= x;
      }
    </script>
    </body>
@endsection