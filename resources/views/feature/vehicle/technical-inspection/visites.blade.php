 @extends('layouts.app')
 <!-- Fin sidebar -->
@section('content')    
<div class="container MonT">
<div class="op">
   <p class="display-6 text-dark">Visite technique</p>
   <div class="mesbout">
       <a href="{{route('visites.create')}}" class="header_img btn btn-primary btn-circle rounded-circle">
           <i class="fas fa-add"></i>
       </a>
       <button type="submit" class="btn btn-secondary btn-circle rounded-circle rounded-circle" id="hide">
           <i class="fas fa-search"></i>
       </button>
   </div>   
</div>
<section class="container">
   <div class="row">
       <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
         <div class="card">
           <div class="card-body">
             <div class="row">
               <div class="col-9">
                 <div class="d-flex align-items-center align-self-start">
                   <h3 class="mb-0">
                   @if ($max>0)
                    100%
                   @else
                    0   
                   @endif 
                   </h3>
                   <p class="text-primary ml-2 mb-0 font-weight-medium"></p>
                 </div>
               </div>
               <div class="col-3">
                 <div class="icon icon-box-dark ">
                   <span class="mdi mdi-arrow-top-right icon-item"></span>
                 </div>
               </div>
             </div>
             <h6 class="text-secondary font-weight-normal">Visite technique : {{ $max }}</h6>
           </div>
         </div>
       </div>
       <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
         <div class="card">
           <div class="card-body">
             <div class="row">
               <div class="col-9">
                 <div class="d-flex align-items-center align-self-start">
                   <h3 class="mb-0 text-warning">
                    @if ($exp>0)  
                    {{round(((100 * $exp)/ $max), 2)}} %</h3>
                    @else
                        0 %
                    @endif
                   </h3>
                   <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                 </div>
               </div>
               <div class="col-3">
                 <div class="icon icon-box-dark">
                   <span class="mdi mdi-arrow-top-right icon-item"></span>
                 </div>
               </div>
             </div>
             <h6 class="text-secondary font-weight-normal">Nombre de visite expirée : {{$exp}}</h6>
           </div>
         </div>
       </div>
       <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
         <div class="card">
           <div class="card-body">
             <div class="row">
               <div class="col-9">
                 <div class="d-flex align-items-center align-self-start">
                   <h3 class="mb-0 text-success">
                    @if ($exp>0)  
                    {{round(((100 * $dv)/ $max), 2)}} %</h3>
                    @else
                        0 %
                    @endif
                   </h3>
                   <p class="text-danger ml-2 mb-0 font-weight-medium"></p>
                 </div>
               </div>
               <div class="col-3">
                 <div class="icon icon-box-dark">
                   <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                 </div>
               </div>
             </div>
             <h6 class="text-secondary font-weight-normal">Nombre de visite valide : {{$dv}}</h6>
           </div>
         </div>
       </div>
       <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
         <div class="card">
           <div class="card-body">
             <div class="row">
               <div class="col-9">
                 <div class="d-flex align-items-center align-self-start">
                   <h3 class="mb-0 text-info">
                    @if ($max > 0)
                        @if ($nbV >= $max)
                          {{round((($nbV-$max)*100)/$nbV)}} %
                        @else
                          {{round((($max-$nbV)*100)/$nbV)}} %
                        @endif
                    @else
                        0 
                    @endif
                   </h3>
                   <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                 </div>
               </div>
               <div class="col-3">
                 <div class="icon icon-box-dark ">
                   <span class="mdi mdi-arrow-top-right icon-item"></span>
                 </div>
               </div>
             </div>
             <h6 class="text-secondary font-weight-normal">
              Véhicules sans contrat de visite : 
              @if ($nbV >= $max)
                {{$nbV - $max}} sur {{$nbV}}
              @else
                {{$max - $nbV}} sur {{$nbV}} 
              @endif
            </h6>
           </div>
         </div>
       </div>
     </div>
</section><br>
<!--  -->
   <div class="col-lg-12 grid-margin stretch-card">
       <div class="card">
         <div class="card-body">
           <p class="card-description">  <code class="text-light" style="font-size: 17px">La liste des visites</code>
           </p>
           <div class="table-responsive">
             <style> #myInput{display: none; width: 100%; height: 50px;padding: 20px; border-radius: 5px}</style>
             <input style="background:none; border:1px solid lightgrey; color:white" type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher">
          
             <table class="text-center table table-hover" id="myTable">
               <thead>
                   <tr class="tet">
                       <th class="text-light font-weight-bold">Date de la visite</th>
                       <th class="text-light font-weight-bold">Date d'éxpiration de la visite</th>
                       <th class="text-light font-weight-bold">Véhicule</th>
                       <th class="text-light font-weight-bold">Etat</th>
                       <th class="text-light font-weight-bold"></th>
                    </tr>
               </thead>
               <tbody>
                @foreach ($visites as $visite)
                <tr>
                    <style>
                        td a{color: white!important};
                    </style>
                    <td>
                        <a style="text-decoration:none" href="{{route('visites.show', ['id' => $visite->id])}}">{{date('d M Y', strtotime($visite->DateVisite))}}</a>
                    </td>
                    <td>
                        <a style="text-decoration:none" href="{{route('visites.show', ['id' => $visite->id])}}">{{date('d M Y', strtotime($visite->Date_exp_Visite))}}</a>
                    </td>
                    <td>
                        <a style="text-decoration:none" href="{{route('visites.show', ['id' => $visite->id])}}">{{$visite->PlaqueImmatric}}</a>
                    </td>
                    
                    <td>
                      {{-- {{\Carbon\Carbon::parse($visite->Date_exp_Visite)->subDays(15)}} --}}
                      @if ($andro >= \Carbon\Carbon::parse($visite->Date_exp_Visite)->subDays(15) AND $andro<$visite->Date_exp_Visite)
                          <span class="badge badge-danger">Visite à faire avant le {{date('d M Y', strtotime($visite->Date_exp_Visite))}}</span>
                      @endif
                      @if ($andro >= $visite->Date_exp_Visite)
                          <span class="badge badge-danger">Expirée</span>
                      @endif
                      @if($andro < $visite->Date_exp_Visite AND $andro < \Carbon\Carbon::parse($visite->Date_exp_Visite)->subDays(15))
                          <span class="badge badge-primary">Expirée le {{date('d M Y', strtotime($visite->Date_exp_Visite))}}</span>                              
                      @endif
                    </td>
                    <td>
                        <a style="text-decoration:none" href="{{ route('visites.edit', $visite->id)}}" class="btn btn-success btn-circle">
                            <i class="fas fa-edit" style="color: white"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>

             </table>
           </div>
         </div>
       </div>
       </div>
<script type="text/javascript">
   $('#myModal').on('shown.bs.modal', function () {
   $('#myInput').trigger('focus')
   })
</script>
</div>    
@endsection