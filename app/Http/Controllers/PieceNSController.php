<?php

namespace App\Http\Controllers;

// use App\Models\PieceN;
use App\Models\PieceNS;
use App\Models\Equipement;
use Illuminate\Http\Request;

class PieceNSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {        
        $pieceN = PieceNS::all();
        $equipements = Equipement::all();
        $max = PieceNS::max('id');

        return view('addpiecens',[
            'pieceN' => $pieceN,
            'equipements' => $equipements,
            'max' => $max
        ]);
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'NomPiece' => 'required',
            'equipement_id' => 'required'
        ]);

        PieceNS::create($validateData);

        return redirect('/equipements/create');
        // ->with('success', 'Voiture enregistrée avec succès')
    }    //
}
