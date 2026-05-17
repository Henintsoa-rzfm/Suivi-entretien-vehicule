@extends('layouts.app')
@section('content')
<div class="container MonT">
    <p class="display-6">Modification Achat Pièces auto</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-dark">Achat numero {{$nombre->id}}</h5>
      </div>
      <style>#formako{background-color: #F7F6FB}</style>
      <form class="card-body" id="formako" method="POST" action="{{route('nombres.update', $nombre->id)}}">
        @csrf
        @method('PATCH')             
          <div class="row">
            <label for="intervention_id">Intervention :</label>
            <select value="{{$nombre->intervention_id}}" class="col col-xxxl-6 form-select-lg form-control" aria-label=".form-select-lg example" name="intervention_id">
              @foreach ($interventions as $intervention)
                <option selected value="{{$intervention->id}}">{{$intervention->nature}}</option>    
              @endforeach
            </select>

            <label for="piece_id">Pièce :</label>
            <select value="{{$nombre->piece_id}}" class="col col-xxxl-6 form-select-lg form-control" name="piece_id" aria-label="Default select example">
              @foreach ($pieces as $piece)
                <option selected value="{{$piece->id}}">{{$piece->Piece}}</option>    
              @endforeach
            </select>
            <label for="Nombre">Quantite:</label>
            <input value="{{$nombre->Nombre}}" class="col col-xxxl-12 form-control form-control-lg" type="text" name="Nombre" aria-label=".form-control-lg example">
          </div><br>	
          <input type="submit" value="Modifier" class="btn MonBouton">
          {{-- <a href="{{route('pieces.create')}}" class="btn MonBouton">Ajouter Pièce</a> --}}
          </div><br>
      </div>  
    </form>	
</div>

@endsection