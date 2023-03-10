@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Ajouter un entretien</h2>
<br>

        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('contenirs.store')}}"><br>
                @csrf
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-10">Entretien numero {{ $max + 1 }}</h4>
                  <div class="col-md-1">
                    <button type="submit" class="ml-5 btn btn-primary btn-circle rounded-circle">
                      <i class="fas fa-check"></i>
                    </button>
                  </div>
                  <div class="col-md-1">
                    <a href="{{route('equipements.create')}}" class="btn btn-secondary btn-circle rounded-circle"><i class="mdi mdi-car-wash"></i></a>
                  </div>
                </div>
                <br>
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Véhicule</label>
                      <div class="col-sm-9">
                        <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="vehicule_id">
                          @foreach ($vehicules as $vehicule)
                            <option selected value="{{$vehicule->id}}">{{$vehicule->PlaqueImmatric}}</option>    
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
                            <option selected value="{{$equipement->id}}">{{$equipement->designation}}</option>    
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
                        <input type="number" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark"  placeholder="ex : 20034" name="dernierKM"/>
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
