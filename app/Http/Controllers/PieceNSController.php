<?php

namespace App\Http\Controllers;

use App\Models\PieceN;
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
        $pieceN = PieceN::all();
        $equipements = Equipement::all();
        $max = PieceN::max('id');

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

        PieceN::create($validateData);

        return redirect('/equipements/create');
        // ->with('success', 'Voiture enregistrée avec succès')
    }    //
}
