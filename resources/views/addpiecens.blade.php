{{-- @extends('layouts.app')
@section('content')
      <form class="card-body" id="formako" method="POST" action="{{route('piecens.store')}}">
        @csrf   
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" style="color: black">{{ $error }}</div>
            @endforeach
        @endif    
        <div class="container">
          <h1>Saisie de la pièce pour entretien</h1>
          <h5 class="m-0 font-weight-bold text-dark">Piece numero {{ $max + 1 }}</h5>
            <hr>                  
          <div class="row">
            <style>
              label{font-size: 18px;}
            </style>
              <input style="border: 1px solid grey" class="col col-xxxl-12 form-control form-control-lg" type="text" name="NomPiece" aria-label=".form-control-lg example" placeholder="Désignation">
              <label for="equipement_id">Entretien :</label>
              <select style="background:none; border:1px solid grey" class="col col-xxxl-6 form-select-lg form-control" aria-label=".form-select-lg example" name="equipement_id">
                @foreach ($equipements as $equipement)
                  <option selected value="{{$equipement->id}}">{{$equipement->designation}}</option>    
                @endforeach
              </select>
            </div><br>
            <input type="submit" value="Enregistrer" class="btn MonBouton">
     	
           </div>	<br>
      </div>  
    </form>	
</div>
@endsection --}}



@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Ajouter une pièce nécessaire à un entretien</h2>
<br>

        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('piecens.store')}}"><br>
                @csrf
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-11">Pièce numero {{ $max + 1 }}</h4>
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
                        <label class="col-sm-3 col-form-label">Nom de la Pièce</label>
                        <div class="col-sm-9">
                          <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark"  placeholder="Désignation" name="NomPiece"/>
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
              </form>
            </div>
          </div>
        </div>
    </div>
    </body>
@endsection
