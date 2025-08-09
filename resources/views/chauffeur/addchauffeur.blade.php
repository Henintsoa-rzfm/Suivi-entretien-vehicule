@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Ajouter un nouveau chauffeur</h2>
        <br>
        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('chauffeurs.store')}}"><br>
                @csrf
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-11">Chauffeur numero {{ $chauffeurNextId }}</h4>
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
                      <label class="col-sm-3 col-form-label">Matricule</label>
                      <div class="col-sm-9">
                        <input type="text" id="det" data-inputask="'mask' : '999999'" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" maxlength="6" minlength ="6" class="form-control rounded bg-light text-dark" placeholder="ex : 679845" name="MatrCh"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nom du chauffeur</label>
                      <div class="col-sm-9">
                        <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="ex: NOM Prénoms" name="Chauffeur"/>
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