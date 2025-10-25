@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div  class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Ajouter un nouveau véhicule</h2>
<br>

        <div id="afeno" class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form  class="form-sample" method="POST" action="{{route('vehicules.store')}}"><br>
                @csrf
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-11">Véhicule numero {{ $max }}</h4>
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
                      <label class="col-sm-3 col-form-label">Immatriculation</label>
                      <div class="col-sm-9">
                        <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(148, 116, 116, 0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="ex : 3421 TAE" name="PlaqueImmatric"/>
                      </div>
                    </div>
                    <script>
                            $(document).ready(function(){
                            $("#ch").inputmask("999999");
                            $("#det").inputmask("999999");
                            $("#mec").inputmask("999999");
                          });
                    </script>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Véhicule</label>
                      <div class="col-sm-9">
                        <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="ex : Marque Modèle" name="Vehicule"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Consommation (L/100KM)</label>
                      <div class="col-sm-9">
                        <input type="number" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="ex : 9" name="Consommation"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Energie</label>
                      <div class="col-sm-9">
                        <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="Energie">
                          <option>Essence</option>
                          <option>Diesel</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Puissance (Ch)</label>
                      <div class="col-sm-9">
                        <input type="number" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Puissance, ex : 110" name="CV"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Kilométrage actuel (KM)</label>
                      <div class="col-sm-9">
                        <input type="number" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="ex : 123098" name="KMActuel"/>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Mise en circulation</label>
                      <div class="col-sm-9">
                        <input type="date" onclick="Daty()" id="debut" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="AnneeMenCirc"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Date Entrée</label>
                      <div class="col-sm-9">
                        <input type="date" onclick="deuxDates()" id="fin" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="DateEntree"/>
                      </div>
                    </div>
                  </div>
                  
                </div>
                
              </form>
            </div>
          </div>
        </div>
    </div>

</div>
    </body>
    <script>
      function deuxDates(){
        var x = document.getElementById('debut').value;
        document.getElementById('fin').min= x;
      }
</script>
<script>
      function Daty(){
        var y = document.getElementById('fin').value;
        document.getElementById('debut').max= y;
      }
</script>
@endsection