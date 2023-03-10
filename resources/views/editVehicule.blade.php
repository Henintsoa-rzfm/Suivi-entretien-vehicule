@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">
      @if (Auth::user()->admin)  
         Modifier un véhicule
      @else
        Modifier le kilométrage du véhicule {{$vehicule->PlaqueImmatric}}
      @endif
      </h2>
<br>

        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('vehicules.update', $vehicule->id)}}"><br>
                @csrf
                @method('PATCH')
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-11">Véhicule numero {{ $vehicule->id }}</h4>
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
                        <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Plaque d'immatriculation" name="PlaqueImmatric" value="{{$vehicule->PlaqueImmatric}}" @if (Auth::user()->admin ==0)
                            readonly
                        @endif/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Véhicule</label>
                      <div class="col-sm-9">
                        <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Véhicule" value="{{$vehicule->Vehicule}}" name="Vehicule" @if (Auth::user()->admin ==0)
                        readonly
                    @endif/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Consommation</label>
                      <div class="col-sm-9">
                        <input type="number" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Consommation" name="Consommation" value="{{$vehicule->Consommation}}" @if (Auth::user()->admin ==0)
                        readonly
                    @endif/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Energie</label>
                      <div class="col-sm-9">
                        @if (Auth::user()->admin)
                          <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="Energie" value="{{$vehicule->Energie}}">
                              @if (old('Energie') == 'Essence' || $vehicule->Energie == 'Essence')
                                <option selected>Essence</option>
                                <option>Diesel</option>  
                              @else      
                                <option>Essence</option>
                                <option selected>Diesel</option>
                              @endif
                            </select>                            
                        @else
                          <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Energie" value="{{$vehicule->Energie}}" name="Energie" @if (Auth::user()->admin ==0)
                          readonly
                           @endif/>
                        @endif

                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Puissance (Ch)</label>
                      <div class="col-sm-9">
                        <input type="number" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Puissance" name="CV" value="{{$vehicule->CV}}" @if (Auth::user()->admin ==0)
                        readonly
                    @endif/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Kilométrage</label>
                      <div class="col-sm-9">
                        <input type="number" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Kilométrage actuel" name="KMActuel" value="{{$vehicule->KMActuel}}"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Mise en circulation</label>
                      <div class="col-sm-9">
                        <input type="date" onclick="Daty()" id="debut" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="AnneeMenCirc" value="{{$vehicule->AnneeMenCirc}}" @if (Auth::user()->admin ==0)
                        readonly
                      @endif/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Date Entrée</label>
                      <div class="col-sm-9">
                        <input type="date" onclick="deuxDates()" id="fin" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="DateEntree" value="{{$vehicule->DateEntree}}" @if (Auth::user()->admin ==0)
                        readonly
                        @endif/>
                      </div>
                    </div>
                  </div>
                  
                </div>
                @if (Auth::user()->admin)
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Détenteur</label>
                      <div class="col-sm-9">
                        <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="detenteur_id" value="{{$vehicule->detenteur_id}}">
                          @foreach ($detenteurs as $detenteur)
                            <option value="{{$detenteur->id}}" @if (old('detenteur_id') == $detenteur->id || $detenteur->id == $vehicule->detenteur_id)
                                selected
                            @endif>{{$detenteur->Detenteur}}</option>    
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Chauffeur</label>
                      <div class="col-sm-9">
                        <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="chauffeur_id" value="{{$vehicule->chauffeur_id}}">
                          @foreach ($chauffeurs as $chauffeur)
                            <option value="{{$chauffeur->id}}" @if (old('chauffeur_id') == $chauffeur->id || $chauffeur->id == $vehicule->chauffeur_id)
                                selected
                            @endif>{{$chauffeur->Chauffeur}}</option>    
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              
                @else
                <div style="display: none">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Détenteur</label>
                        <div class="col-sm-9">
                          <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="detenteur_id" value="{{$vehicule->detenteur_id}}">
                            @foreach ($detenteurs as $detenteur)
                              <option value="{{$detenteur->id}}" @if (old('detenteur_id') == $detenteur->id || $detenteur->id == $vehicule->detenteur_id)
                                  selected
                              @endif>{{$detenteur->Detenteur}}</option>    
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
  
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Chauffeur</label>
                        <div class="col-sm-9">
                          <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="chauffeur_id" value="{{$vehicule->chauffeur_id}}">
                            @foreach ($chauffeurs as $chauffeur)
                              <option value="{{$chauffeur->id}}" @if (old('chauffeur_id') == $chauffeur->id || $chauffeur->id == $vehicule->chauffeur_id)
                                  selected
                              @endif>{{$chauffeur->Chauffeur}}</option>    
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
      
                @endif
                
              </form>
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
