<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contenir;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\Detenteur;
use App\Models\Equipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\Console\Input\Input;

class VehiculeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $vehicules = DB::table('vehicules')
                        ->join('chauffeurs','vehicules.chauffeur_id', '=', 'chauffeurs.id' )
                        ->join('detenteurs','vehicules.detenteur_id', '=', 'detenteurs.id' )
                        ->select('vehicules.*', 'chauffeurs.Chauffeur', 'detenteurs.Detenteur')
                        // ->whereNotIn('Vehicule',['Passat'])
                        ->orderBy('created_at', 'asc')
                        ->get(); 
        $vehi = DB::table('vehicules')
                        ->join('chauffeurs','vehicules.chauffeur_id', '=', 'chauffeurs.id' )
                        ->join('detenteurs','vehicules.detenteur_id', '=', 'detenteurs.id' )
                        ->whereIn('Chauffeur',['Aucun'])->count();
        
        $user = Auth::user();
        $chauffeurs = Chauffeur::all();
        $detenteurs = Detenteur::all();
        $nbV = DB::table('vehicules')->count(); 
        $nbE = DB::table('vehicules')->where("Energie", "Essence")->count();
        $nbD = DB::table('vehicules')->where("Energie", "Diesel")->count();
        $special = DB::table('vehicules')
        ->join('contenirs', 'vehicules.id', 'contenirs.vehicule_id') 
        ->join('equipements','equipements.id','contenirs.equipement_id') 
        ->whereRaw('vehicules.KMActuel-contenirs.dernierKM >= equipements.kilometrageMax')
        ->select('vehicules.*', 'contenirs.designation')
        ->count('vehicules.id');
        $eq = Contenir::count();

        return view('vehicules', [
            'vehicules' => $vehicules,
            'chauffeurs' => $chauffeurs,
            'detenteurs' => $detenteurs,
            'nbV' => $nbV,
            'nbE' => $nbE,
            'nbD' => $nbD,
            'vehi' => $vehi,
            'user' => $user,
            'special' => $special,
            'eq' => $eq
        ]);
    }

    public function create()
    {        
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $detenteurs = Detenteur::all();
        $chauffeurs = Chauffeur::all();
        $max =  DB::table('vehicules')->max('id');

        return view('addvehicule',[
            'detenteurs' => $detenteurs,
            'chauffeurs' => $chauffeurs,
            'max' => $max
        ]);
    }
    
    public function store(Request $request)
    {
        $a = $request->DateEntree;
        $b = $request->AnneeMenCirc;
        $c = Carbon::now();

        if($a > $c || $b > $c){
            return '<h3 class="alert alert-danger" style="text-align : center; margin-top: 250px" >La date d\'entrée ou la mise en circulation à verifier</h3>';
        }else{
            $validateData = $request->validate([
                'PlaqueImmatric' => 'required|max:10',
                'Vehicule' => 'required',
                'Energie' => 'required',
                'Consommation' => 'required|numeric',
                'CV' => 'required|numeric',
                'AnneeMenCirc' => 'required',
                'DateEntree' => 'required',
                'KMActuel' => 'required|numeric',
                'detenteur_id' => 'required',
                'chauffeur_id' => 'required'
            ]);
    
            Vehicule::create($validateData);
    
            return redirect('/vehicules');
        }
    }

    public function show($id)
    {
        $vehicule = Vehicule::findOrfail($id);
        $date1 = Carbon::now();       
        return view('vehicule', [
            'vehicule' => $vehicule,
            'date1' => $date1
        ]);
    }

    public function edit($id)
    {
        $vehicule = Vehicule::findOrfail($id);
        $chauffeurs = Chauffeur::all();
        $detenteurs = Detenteur::all();

        return view('editVehicule', [
            'vehicule' =>$vehicule,
            'chauffeurs' => $chauffeurs,
            'detenteurs' => $detenteurs,
        ]);
    }
    public function update(Request $request, $id)
    {
        $a = $request->DateEntree;
        $b = $request->AnneeMenCirc;
        $c = Carbon::now();

        if($a > $c || $b > $c){
            return '<h3 class="alert alert-danger" style="text-align : center; margin-top: 250px" >La date d\'entrée ou la mise en circulation à verifier</h3>';
        }else{
        $validateData = $request->validate([
            'PlaqueImmatric' => 'required|max:10',
            'Vehicule' => 'required',
            'Energie' => 'required',
            'Consommation' => 'required|numeric',
            'CV' => 'required|numeric',
            'AnneeMenCirc' => 'required',
            'DateEntree' => 'required',
            'KMActuel' => 'required|numeric',
            'detenteur_id' => 'required',
            'chauffeur_id' => 'required'
        ]);
        
        Vehicule::whereId($id)->update($validateData);
        // dd($validateData);
        return redirect('/vehicules');
        }
    }

    public function destroy($id)
    {
        $vehicule = Vehicule::findOrfail($id);
        $vehicule->delete();

        return redirect('/vehicules');
    }

}
