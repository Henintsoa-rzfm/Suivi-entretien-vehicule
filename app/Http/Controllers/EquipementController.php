<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $equipements = Equipement::all();

        return view('equipements', [
            'equipements' => $equipements
        ]);
    }

    public function create()
    {        
        $equipements = Equipement::all();
        $max = Equipement::count('id');

        return view('addequipement',[
            'equipements' => $equipements,
            'max' => $max
        ]);
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'designation' => 'required',
            'kilometrageMax' => 'required|numeric'
        ]);

        Equipement::create($validateData);

        return redirect('/contenirs/create');
    }

    public function show($id)
    {
        $equipement = Equipement::findOrfail($id);

        return view('visite', [
            'equipement' => $equipement
        ]);
    }

    public function edit($id)
    {
        $equipement = Equipement::findOrfail($id);
    
        return view('editEquipement', [
            'equipement' => $equipement
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'designation' => 'required',
            'kilometrageMax' => 'required|numeric'
        ]);

        Equipement::whereId($id)->update($validateData);
        return redirect('/equipements');
    }

    public function destroy($id)
    {
        $equipement = Equipement::findOrfail($id);
        $equipement->delete();

        return redirect('/equipements');
    }
}
