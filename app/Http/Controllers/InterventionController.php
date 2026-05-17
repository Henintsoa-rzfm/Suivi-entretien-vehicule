<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Nombre;
use App\Models\Piece;
use App\Models\User;
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

        return view('features.intervention.intervention.interventions', [
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
        $users = User::all();

        return view('features.intervention.intervention.create', [
            'interventions' => $interventions,
            'vehicules' => $vehicules,
            'pieces' => $pieces,
            'users' => $users,
            'max' => $max,
            'a' => $a,
        ]);
    }

    public function store(Request $request)
    {
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

        return redirect()->route('interventions');
        // }
    }

    public function show(int $id)
    {
        $intervention = Intervention::findOrfail($id);
        $daty = Carbon::now();

        return view('features.intervention.intervention.intervention', [
            'intervention' => $intervention,
            'daty' => $daty,
        ]);
    }

    public function edit(int $id)
    {
        $intervention = Intervention::findOrfail($id);
        $pieces = Piece::all();
        $vehicules = Vehicule::all();
        $max = Intervention::max('id');

        return view('features.intervention.intervention.edit', [
            'intervention' => $intervention,
            'vehicules' => $vehicules,
            'max' => $max,
            'pieces' => $pieces,
            // 'nombre' => $nombre
        ]);
    }

    public function update(Request $request, int $id)
    {
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

        return redirect()->route('interventions');

    }

    public function destroy(int $id)
    {
        $intervention = Intervention::findOrfail($id);
        $intervention->delete();

        return redirect()->route('interventions');
    }
}

