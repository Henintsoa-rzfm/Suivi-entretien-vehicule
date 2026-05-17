<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Nombre;
use App\Models\Piece;
use App\Models\User;
use App\Models\Vehicule;
use App\Services\InterventionService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public readonly InterventionService $interventions;

    public function __construct(InterventionService $interventions)
    {
        $this->middleware('auth');
        $this->interventions = $interventions;
    }

    public function index()
    {
        $vehicules = Vehicule::all();
        $nombres = Nombre::all();
        $pieces = Piece::all();
        $daty = Carbon::now();

        return view('features.intervention.intervention.interventions', [
            'interventions' => $this->interventions->getAllInterventions(),
            'vehicules' => $vehicules,
            'daty' => $daty,
            'nombres' => $nombres,
            'pieces' => $pieces,
            ...$this->interventions->getInterventionsStats(),

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

