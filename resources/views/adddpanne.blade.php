@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Ajouter une panne</h2>
<br>

        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('dpannes.store')}}"><br>
                @csrf
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-10">Panne numero {{ $max + 1 }}</h4>
                  <div class="col-md-1 ">
                    <button type="submit" class="ml-5 btn btn-primary btn-circle rounded-circle">
                      <i class="fas fa-check"></i>
                    </button>
                  </div>
                  <div class="col-md-1">
                    <a href="{{route('pannes.create')}}" class="btn btn-info btn-circle rounded-circle"><i class="fas fa-car-burst"></i></a>
                  </div>

                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Date de la panne</label>
                      <div class="col-sm-9">
                        <input type="date" onclick="dateko()" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" id="dat" name="DatePanne"/>
                      </div>
                    </div>
                    <script>
                      // function datymax()
                      // {
                      //   var b = new Date();
                      //   var f = b.getFullYear() +'-'+ b.getMonth() +'-'+ b.getDate(); 
                      //   var a = document.getElementById('dat').value = f;
                      // }
                    </script>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Véhicule</label>
                      <div class="col-sm-9">
                        <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="vehicule_id">
                          @foreach ($vehicules as $vehicule)
                            <option value="{{$vehicule->id}}">{{$vehicule->PlaqueImmatric}}</option>    
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Type de la panne</label>
                      <div class="col-sm-9">
                        <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="panne_id">
                          @foreach ($pannes as $panne)
                            <option value="{{$panne->id}}">{{$panne->TypePanne}}</option>    
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
    <script>
      // function dateko()
      // {
      //   var a = new Date();
      //   document.getElementById('#dat').value = new Date();
      //   }
    </script>
@endsection
