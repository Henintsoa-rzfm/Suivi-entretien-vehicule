@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Ajouter une pièce à une intervention</h2>
    <br>
        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('nombres.store')}}"><br>
                @csrf
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-11">Numero {{ $max + 1 }}</h4>
                  <div class="col-md-1 ">
                    <button type="submit" class="btn btn-primary btn-circle rounded-circle">
                      <i class="fas fa-check"></i>
                    </button>
                  </div>
                  
                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Intervention</label>
                      <div class="col-sm-9">
                        <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="intervention_id">
                          @foreach ($interventions as $intervention)
                            <option value="{{$intervention->id}}">{{$intervention->id}} | {{$intervention->PlaqueImmatric}} | {{$intervention->nature}} | {{date('d M Y', strtotime($intervention->DateIntervention))}}</option>    
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Pièce</label>
                      <div class="col-sm-9">
                        <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="piece_id">
                          @foreach ($pieces as $piece)
                            <option value="{{$piece->id}}">{{$piece->Piece}}</option>    
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Quantité</label>
                      <div class="col-sm-9">
                        <input type="number" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="Nombre">
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



















{{-- @extends('layouts.app')
@section('content')
<div class="container MonT">
    <p class="display-6">Demande d'achats pièces</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-dark">Achat numero {{ $max + 1 }}</h5>
      </div>
      <style>#formako{background-color: #F7F6FB}</style>
      <form class="card-body" id="formako" method="POST" action="{{route('nombres.store')}}">
        @csrf             
          <div class="row">
            <label for="intervention_id">Intervention :</label>
            <select class="col col-xxxl-6 form-select-lg form-control" aria-label=".form-select-lg example" name="intervention_id">
              @foreach ($interventions as $intervention)
                <option value="{{$intervention->id}}">{{$intervention->nature}}</option>    
              @endforeach
            </select>

            <label for="piece_id">Pièce :</label>
            <select class="col col-xxxl-6 form-select-lg form-control" name="piece_id" aria-label="Default select example">
              @foreach ($pieces as $piece)
                <option selected value="{{$piece->id}}">{{$piece->Piece}}</option>    
              @endforeach
            </select>
            <label for="Nombre">Quantite:</label>
            <input class="col col-xxxl-12 form-control form-control-lg" type="text" name="Nombre" aria-label=".form-control-lg example">
          </div><br>	
          <input type="submit" value="Enregistrer" class="btn MonBouton">
          <a href="{{route('pieces.create')}}" class="btn MonBouton">Ajouter Pièce</a>
          </div><br>
      </div>  
    </form>	
</div>

@endsection --}}