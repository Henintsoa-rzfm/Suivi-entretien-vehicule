<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use App\Models\Nombre;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NombreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $nombres = DB::table('nombres')
        ->join('pieces', 'nombres.piece_id', '=', 'pieces.id' )
        ->join('interventions', 'nombres.intervention_id', '=', 'interventions.id' )
        ->select('nombres.*', 'pieces.Piece', 'interventions.nature')
        ->get();
        $pieces = Piece::all();
        $interventions = Intervention::all();
        $nbN = Nombre::count();

        return view('nombres', [
            'nombres' => $nombres,
            'pieces' => $pieces,
            'interventions' => $interventions,
            'nbN' => $nbN
        ]);
    }

    public function create()
    {        
        $nombres = Nombre::all();
        $pieces = Piece::all();
        // $interventions = Intervention::all();
        $interventions = DB::table('interventions')->join('vehicules', 'vehicules.id', 'interventions.vehicule_id')
        ->whereNotIn('Validation',['Validée'])->select('interventions.*')->select('interventions.*', 'vehicules.PlaqueImmatric')->get();
        $max = Nombre::max('id');

        return view('addnombre',[
            'nombres' => $nombres,
            'pieces' => $pieces,
            'interventions' => $interventions,
            'max' => $max
        ]);
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'piece_id' => 'required',
            'intervention_id' => 'required',
            'Nombre' => 'required|numeric'
        ]);

        Nombre::create($validateData);

        return redirect('/interventions');
        // ->with('success', 'Voiture enregistrée avec succès')
    }

    public function show($id)
    {
        $nombre = Nombre::findOrfail($id);

        return view('nombre', [
            'nombre' => $nombre
        ]);
    }

    // public function edit($id)
    // {
    // //     $nombre = Nombre::findOrfail($id);
    // //     $pieces = Piece::all();
    // //     $interventions = Intervention::all();
    
    // //     return view('editNombre', [
    // //         'nombre' => $nombre,
    // //         'pieces' => $pieces,
    // //         'interventions' => $interventions
    // //     ]);
    // // }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'piece_id' => 'required',
            'intervention_id' => 'required',
            'Nombre' => 'required|numeric'
        ]);

        Nombre::whereId($id)->update($validateData);
        return redirect('/nombres');
    }

    public function destroy($id)
    {
        $nombre = Nombre::findOrfail($id);
        $nombre->delete();

        return redirect('/nombres');
    }

}
