<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Contenir;
use App\Models\Vehicule;
use App\Models\Equipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContenirController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $contenirs = DB::table('contenirs')
        ->join('vehicules', 'contenirs.vehicule_id', '=', 'vehicules.id' )
        ->join('equipements', 'contenirs.equipement_id', '=', 'equipements.id' )
        ->select('contenirs.*', 'vehicules.PlaqueImmatric', 'vehicules.Vehicule', 'vehicules.KMActuel','equipements.designation','equipements.kilometrageMax')
        ->get();
        $equipements = Equipement::all();
        $vehicules = Vehicule::all();
        $max = Contenir::count('id');
        $month = Contenir::whereMonth('created_at','=', now()->month, 'OR', 'updated_at', '=', now()->month )->count();
        $day = Contenir::whereDay('created_at','=', now()->day , 'OR', 'updated_at', '=', now()->day)->count();
        $week = Contenir::whereBetween('updated_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->get()->count();
        $special = DB::table('vehicules')
        ->join('contenirs', 'vehicules.id', 'contenirs.vehicule_id') 
        ->join('equipements','equipements.id','contenirs.equipement_id') 
        ->whereRaw('vehicules.KMActuel-contenirs.dernierKM >= equipements.kilometrageMax')
        ->select('vehicules.*', 'contenirs.designation')
        ->count('vehicules.id');

        return view('contenirs', [
            'contenirs' => $contenirs,
            'equipements' => $equipements,
            'vehicules' => $vehicules,
            'max' => $max,
            'month' => $month,
            'week' => $week,
            'day' => $day,
            'special' => $special
        ]);
    }

    public function create()
    {
        $contenirs = Contenir::all();
        $equipements = Equipement::all();
        $vehicules = Vehicule::all();
        $max = Contenir::count('id');
        
        return view('addcontenir',[
            'contenirs' => $contenirs,
            'equipements' => $equipements,
            'vehicules' => $vehicules,
            'max' => $max
        ]);
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'equipement_id' => 'required|unique:contenirs,equipement_id,null,null,vehicule_id,'. $request->vehicule_id,
            'vehicule_id' => 'required',
            'dernierKM' => 'required|numeric'
        ]);

        Contenir::create($validateData);

        return redirect('/contenirs');
        // ->with('success', 'Voiture enregistrée avec succès')
    }

    public function show($id)
    {
        $contenir = Contenir::findOrfail($id);

        return view('contenir', [
            'contenir' => $contenir
        ]);
    }

    public function edit($id)
    {
        $contenir = Contenir::findOrfail($id);
        $vehicules = Vehicule::all();
        $equipements = Equipement::all();
    
        return view('editContenir', [
            'contenir' => $contenir,
            'vehicules' => $vehicules,
            'equipements' => $equipements
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'equipement_id' => 'required',
            'vehicule_id' => 'required',
            'dernierKM' => 'required|numeric'
        ]);
        Contenir::whereId($id)->update($validateData);
        return redirect('/contenirs');
    }

    public function destroy($id)
    {
        $contenir = Contenir::findOrfail($id);
        $contenir->delete();

        return redirect('/contenirs');
    }
    
}
