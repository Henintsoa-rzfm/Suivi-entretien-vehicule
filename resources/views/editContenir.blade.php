@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Renouveler un entretien</h2>
<br>

        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('contenirs.update', $contenir->id)}}"><br>
                @csrf
                @method('PATCH')
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-11">Entretien numero {{ $contenir->id }}</h4>
                  <div class="col-md-1">
                    <button type="submit" class="btn btn-primary btn-circle rounded-circle">
                      <i class="fas fa-check"></i>
                    </button>
                  </div>
                </div>
                <div style="display: flex;">
                  <p>Le kilométrage actuel du véhicule : {{$contenir->Vehicule->KMActuel}} KM;</p>
                  <p style="margin-left: 10px">Le kilométrage de l'entretien précédent : {{$contenir->dernierKM}} KM</p>  
                </div>
                <br>
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Véhicule</label>
                      <div class="col-sm-9">
                        <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="vehicule_id">
                          @foreach ($vehicules as $vehicule)
                            <option value="{{$vehicule->id}}" @if (old('vehicule_id')== $vehicule->id || $vehicule->id == $contenir->vehicule_id)
                                selected
                            @endif>{{$vehicule->PlaqueImmatric}}</option>    
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Entretien</label>
                      <div class="col-sm-9">
                        <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="equipement_id">
                          @foreach ($equipements as $equipement)
                            <option value="{{$equipement->id}}" @if (old('equipement_id') == $equipement->id || $equipement->id == $contenir->equipement_id)
                                selected
                            @endif>{{$equipement->designation}}</option>    
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                                  
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Dernier KM</label>
                      <div class="col-sm-9">
                        <input type="number" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark"  placeholder="ex : 2000" name="dernierKM" value="{{$contenir->dernierKM}}"/>
                      </div>
                    </div>  
                  </div>   
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    </body>
@endsection