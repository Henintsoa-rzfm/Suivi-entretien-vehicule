@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark"><br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Ajouter un type de panne</h2><br>
        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('pannes.store')}}"><br>
                @csrf
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif                
                <div class="row">
                  <h4 class="card-title text-primary col-md-11">Type Panne numero {{ $max + 1 }}</h4>
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
                      <label class="col-sm-3 col-form-label">Type de la panne</label>
                      <div class="col-sm-9">
                        <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" placeholder="Nom de la panne" class="form-control rounded bg-light text-dark" name="TypePanne"/>
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
