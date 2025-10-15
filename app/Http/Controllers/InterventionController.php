<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Nombre;
use App\Models\Piece;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterventionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $interventions = DB::table('interventions')
            ->join('vehicules', 'interventions.vehicule_id', '=', 'vehicules.id')
            ->select('interventions.*', 'vehicules.PlaqueImmatric')
            ->orderBy('created_at', 'DESC')
            ->get();
        $intE = DB::table('interventions')->whereIn('Validation', ['En attente'])->count();
        $intV = DB::table('interventions')->whereIn('Validation', ['Validée'])->count();
        $rep = DB::table('interventions')
            ->where('DateLimite', '<', now())
            ->where('DateIntervention', '<', now())
            ->where('Validation', 'Validée')->count();
        $vehicules = Vehicule::all();
        $nombres = Nombre::all();
        $pieces = Piece::all();
        $nbI = Intervention::count();
        $daty = Carbon::now();

        return view('interventions', [
            'interventions' => $interventions,
            'vehicules' => $vehicules,
            'nbI' => $nbI,
            'daty' => $daty,
            'nombres' => $nombres,
            'pieces' => $pieces,
            'intE' => $intE,
            'intV' => $intV,
            'rep' => $rep,

        ]);
    }

    public function create()
    {
        $interventions = Intervention::all();
        $vehicules = Vehicule::all();
        $pieces = Piece::all();
        $max = Intervention::max('id');
        $a = Carbon::now();

        return view('addintervention', [
            'interventions' => $interventions,
            'vehicules' => $vehicules,
            'pieces' => $pieces,
            'max' => $max,
            'a' => $a,
        ]);
    }

    public function store(Request $request)
    {
        // $a = $request->DateIntervention;
        // $b = Carbon::now();
        // $d = '<div class="alert alert-danger" style="width:500px ; color:white; background:red; text-align : center; margin: auto; margin-top: 250px" ><h3>Veuillez insérer une date dans le futur</h3></div>';

        // if($a < $b)
        // {
        //     return $d;
        // }else{
        $validateData = $request->validate([
            'nature' => 'required',
            'DateIntervention' => 'required',
            'Panne' => 'required',
            'lieuIntervention' => 'required',
            'vehicule_id' => 'required',
            'DateLimite' => 'required',
            'Validation' => 'required',
        ]);

        Intervention::create($validateData);
        $validateData2 = $request->validate([
            'piece_id' => 'required',
            'intervention_id' => 'required',
            'Nombre' => 'required|numeric',
        ]);

        Nombre::create($validateData2);

        return redirect('/interventions');
        // }
    }

    public function show($id)
    {
        $intervention = Intervention::findOrfail($id);
        $daty = Carbon::now();

        return view('intervention', [
            'intervention' => $intervention,
            'daty' => $daty,
        ]);
    }

    public function edit($id)
    {
        $intervention = Intervention::findOrfail($id);
        $pieces = Piece::all();
        $vehicules = Vehicule::all();
        $max = Intervention::max('id');

        return view('editIntervention', [
            'intervention' => $intervention,
            'vehicules' => $vehicules,
            'max' => $max,
            'pieces' => $pieces,
            // 'nombre' => $nombre
        ]);
    }

    public function update(Request $request, $id)
    {
        // $a = $request->DateIntervention;
        // $b = $request->DateLimite;
        // $c = Carbon::now();
        // $d = '<h3 class="alert alert-danger" style="text-align : center; margin-top: 250px" >Il est impossible de planifier une intervention dans le passé</h3>';

        // if ($a < $c || $a < $b)
        // {
        //     return $d;
        // }else{
        $validateData = $request->validate([
            'nature' => 'required',
            'DateIntervention' => 'required',
            'Panne' => 'required',
            'lieuIntervention' => 'required',
            'vehicule_id' => 'required',
            'DateLimite' => 'required',
            'Validation' => 'required',
        ]);

        Intervention::whereId($id)->update($validateData);

        return redirect('/interventions');
        // }
    }

    public function destroy($id)
    {
        $intervention = Intervention::findOrfail($id);
        $intervention->delete();

        return redirect('/interventions');
    }
}

        // $intervention_id = $request->intervention_id;
// $piece_id = $request->piece_id;
// $Nombre = $request->Nombre;

// for ($i = 0 ; $i < count($Nombre) ; $i++ ) {
//     $validateData2 = [
//         'intervention_id' => $intervention_id[$i],
//         'piece_id' => $piece_id[$i],
//         'Nombre' => $Nombre[$i]
//     ];
//     DB::table('nombres')->insert($validateData2);
// }
// dd($validateData2);
