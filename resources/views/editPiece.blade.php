@extends('layouts.app')
@section('content')
<div class="container MonT">
    <p class="display-6">Modification d'un piece</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-dark">Piece numero {{$piece->id}}</h5>
      </div>
      <form class="card-body" method="post" action="{{route('pieces.update', $piece->id)}}">
        @csrf
        @method('PATCH')
        <div class="container-fluid maForm">
          <div class="row">
              <input class="col col-xxxl-6 form-control form-control-lg" type="text" placeholder="Piece" name="Piece" value="{{$piece->Piece}}" aria-label=".form-control-lg example">
              <input value="{{$piece->Prix}}" class="col col-xxxl-6 form-control form-control-lg" type="text" name="Prix" placeholder="Prix" aria-label=".form-control-lg example">
          </div>	
        </div><br>
       <input type="submit" value="Modifier" class="btn MonBouton">
      </div>  
    </form>	
</div>

@endsection