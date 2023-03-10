<?php

namespace App\Http\Controllers;

use App\Models\Panne;
use App\Models\Piece;
use App\Models\Nombre;
use App\Models\Vehicule;
use App\Models\Mecanicien;
use App\Models\Intervention;
use Illuminate\Http\Request;

class IntervenirEntretienController extends Controller
{
    
    public function create()
    {        
        $interventions = Intervention::all();
        $pannes = Panne::all();
        $mecaniciens = Mecanicien::all();
        $vehicules = Vehicule::all();
        $pieces = Piece::all();
        $max = Intervention::max('id');


        return view('addintervenirE',[
            'interventions' => $interventions,
            'pannes' => $pannes,
            'mecaniciens' => $mecaniciens,
            'vehicules' => $vehicules,
            'pieces' => $pieces,
            'max' => $max
            ]);
    }
    
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nature' => 'required',
            'DateIntervention' => 'required',
            'Durée' => 'required',
            'lieuIntervention' => 'required',
            'panne_id' => 'required',
            'mecanicien_id' => 'required',
            'vehicule_id' => 'required',
            'DateLimite' => 'required',
            'Validation' => 'required'
        ]);

        Intervention::create($validateData);
        
        $validateData2 = $request->validate([
            'piece_id' => 'required',
            'intervention_id' => 'required',
            'Nombre' => 'required'
        ]);

        Nombre::create($validateData2);

        return redirect('/interventions');
    }


}
