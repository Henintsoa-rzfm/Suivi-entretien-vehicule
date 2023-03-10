@extends('layouts.app')
@section('content')
<body id="totalite" class="bg-dark text-dark" style="background: /*#F2F7FD*/">
    <br>
    <div class="container bg-light bloc" style="align-content: center!important">
      <h2 style="font-weight: bold" class="text-center">Planifier une intervention</h2>
<br>
{{-- {{$a}} --}}
        <div class="col-12 grid-margin bg bg-light text-dark">
          <div class="card" style="box-shadow: 5px 8px 7px 0 rgba(0,0,0,0.2); border:none">
            <div class="card-body bg bg-light rounded">
              <form class="form-sample" method="POST" action="{{route('interventions.store')}}"><br>
                @csrf
                @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" style="color: black">{{ $error }}</div>
                  @endforeach
                @endif
                
                <div class="row">
                  <h4 class="card-title text-primary col-md-10">Intervention numero {{ $max + 1 }}</h4>
                  <div class="col-md-1">
                    <button type="submit" class="ml-5 btn btn-primary btn-circle rounded-circle">
                      <i class="fas fa-check"></i>
                    </button>
                  </div>
                  <div class="col-md-1">
                    <a href="{{route('pieces.create')}}" class="btn btn-secondary btn-circle rounded-circle"><i class="fas fa-cogs"></i></a>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nature de l'intervention</label>
                      <div class="col-sm-9">
                        <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Nature" name="nature"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Lieu d'intervention</label>
                      <div class="col-sm-9">
                        <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Lieu" name="lieuIntervention"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Début</label>
                      <div class="col-sm-9">
                        <input id="debut" onclick="Daty()" type="date" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Date d'intervention" name="DateIntervention"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Fin</label>
                      <div class="col-sm-9">
                        <input id="fin" onclick="deuxDates()" type="date" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" placeholder="Fin de l'intervention" name="DateLimite"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Raison</label>
                        <div class="col-sm-9">
                          <input type="text" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark"  placeholder="Raison de l'intervention" name="Panne"/>
                        </div>
                      </div>
                    </div>                
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Intervenant</label>
                        <div class="col-sm-9">
                          <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="mecanicien_id">
                            @foreach ($mecaniciens as $mecanicien)
                              <option selected value="{{$mecanicien->id}}">{{$mecanicien->Mecanicien}}</option>    
                            @endforeach
                          </select>
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
                              <option selected value="{{$vehicule->id}}">{{$vehicule->PlaqueImmatric}}</option>    
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
                              <option selected value="{{$piece->id}}">{{$piece->Piece}}</option>    
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    
                </div>              
                <div class="row" id="pieceko">
                  <input type="text" style="display:none; box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none;" class="form-control rounded bg-light text-dark" value="{{ $max+1 }}" placeholder="" name="intervention_id" readonly/>
                  
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Quantité</label>
                      <div class="col-sm-9">
                        <input type="number" style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark"  placeholder="Quantité de la pièce" name="Nombre"/>
                      </div>
                    </div>  
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Réparation</label>
                        <div class="col-sm-9">
                          <select style="box-shadow: 2px 4px 8px 0 rgba(0,0,0,0.2); border:none" class="form-control rounded bg-light text-dark" name="Validation">
                              @if (Auth::user()->admin)
                                <option>En attente</option>
                                <option>Validée</option>
                              @else
                                <option>En attente</option>
                              @endif
                          </select>
                        </div>
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

    <script src="{{asset('js/jquery.js')}}"></script>
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
<script type="text/javascript">
  $('.repeater').on('click', '.button', function(e) {
  e.preventDefault();

  var $this = $(this),
      $repeater = $this.closest('.repeater').find('[data-repeatable]'),
      count = $repeater.length,
      $clone = $repeater.first().clone();

  $clone.find('[id]').each(function() {
      this.id = this.id + '_' + count;
  });

  $clone.find('[name]').each(function() {
      this.name = this.name + '[' + count + ']';
  });

  $clone.find('label').each(function() {
      var $this = $(this);
      $this.attr('for', $this.attr('for') + '_' + count);
  });

  $clone.insertBefore($this);
});

</script>

@endsection