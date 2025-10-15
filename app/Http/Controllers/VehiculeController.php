<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contenir;
use App\Models\Vehicule;
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
                        ->select('vehicules.*')
                        // ->whereNotIn('Vehicule',['Passat'])
                        ->orderBy('created_at', 'asc')
                        ->get(); 
        
        $user = Auth::user();
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
            'nbV' => $nbV,
            'nbE' => $nbE,
            'nbD' => $nbD,
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
        $max =  DB::table('vehicules')->max('id');

        return view('addvehicule',[
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

        return view('editVehicule', [
            'vehicule' =>$vehicule,
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
