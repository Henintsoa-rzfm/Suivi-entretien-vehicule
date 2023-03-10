@extends('layouts.app')
      <!-- Fin sidebar -->
@section('content')    
<div class="container MonT">
    <div class="op">
        <p class="display-6">Pieces</p>
        <div class="mesbout">
            <a href="{{route('pieces.create')}}" class="header_img btn btn-primary btn-circle">
                <i class="fas fa-add"></i>
            </a>
            <button type="submit" class="btn btn-secondary btn-circle" id="hide">
                <i class="fas fa-search"></i>
            </button>  
            <a href="#" class="header_img btn btn-primary btn-circle">
                <i class="fas fa-info"></i>
            </a>
            <a href="#" class="btn btn-warning btn-circle">
                <i class="fas fa-exclamation-triangle" style="color: white"></i>
            </a>
            <a href="#" class="btn btn-danger btn-circle">
                <i class="fas fa-sign-out" style="color: white"></i>
            </a>
        </div>   
    </div>
    <section class="container">
        <div class="table-responsive">
            <table class="table table-bordered bg bg-light text-center" id="myTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="tet">
                        <th class="text-primary">Nombre de pieces</th>
                        <th class="text-success">Nombre</th>
                        <th class="text-danger">Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $nbPi }}</td>
                        <td>{{-- DB::table('vehicules')->where('Energie', 'Essence')->count(); --}}5</td>
                        <td>2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <!--  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">La liste des pieces</h5>
        </div>
        <div class="card-body">
            <style> #myInput{display: none;}</style>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="tabletitre">
                        <tr>
                            <th>Piece</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pieces as $piece)
                        <tr>
                            <style>
                                td a{color: black!important};
                            </style>
                            <td>
                                <a href="{{route('pieces.show', ['id' => $piece->id])}}">{{$piece->Piece}}</a>
                            </td>
                            <td>
                                <a href="{{ route('pieces.edit', $piece->id)}}" class="btn btn-success btn-circle">
                                    <i class="fas fa-edit" style="color: white"></i>
                                </a>
                            </td>
                            <form action="{{route('pieces.destroy', $piece->id)}}" method="post">
                            <td>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash" style="color: white"></i>
                                </button>
                            </td>
                            </form>
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