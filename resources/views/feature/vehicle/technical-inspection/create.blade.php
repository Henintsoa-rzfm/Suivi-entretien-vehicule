@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Ajouter un contrat de visite technique</h2>
    <br>

        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('visites.store')}}"><br>
                @csrf
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-11">Visite numero {{ $max + 1 }}</h4>
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
                      <label class="col-sm-3 col-form-label">Durée de validité du</label>
                      <div class="col-sm-9">
                        <input id="debut" type="date" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" onclick="daty()" class="form-control rounded bg-light text-dark" name="DateVisite"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">au</label>
                      <div class="col-sm-9">
                        <input type="date" id="fin" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" onclick="deuxDates()" class="form-control rounded bg-light text-dark" name="Date_exp_Visite"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
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
      var y = document.getElementById('fin').value;
      document.getElementById('debut').max= y;
    }
  </script>
    <script>
      // function kaly()
      // {
      // function addDaysToDate(date, days){
      //     var res = new Date(date);
      //     res.setDate(res.getDate() + days);
      //     return res;
      //   }
      //   var x = document.getElementById('debut').value;
      //   var y = addDaysToDate(x, 365);
      //   var f = y.toLocaleDateString();
      //   document.getElementById('fin').value = f;
      // }
    </script>
    </body>
    @endsection
