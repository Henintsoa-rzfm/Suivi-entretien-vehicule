<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Panne;
use App\Models\DPanne;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DPanneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $dpannes = DB::table('d_pannes')
        ->join('vehicules','d_pannes.vehicule_id', '=', 'vehicules.id' )
        ->join('pannes','d_pannes.panne_id', '=', 'pannes.id' )
        ->select('d_pannes.*', 'vehicules.PlaqueImmatric', 'vehicules.Vehicule','pannes.TypePanne' )
        ->orderBy('created_at', 'DESC')
        // ->whereNotIn('Chauffeur',['Aucun'])
        ->get();
        $mois = DPanne::whereMonth('DatePanne', '=' , Carbon::now()->month)->count();
        $semaine = DPanne::whereBetween('DatePanne', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->get()->count();
        $jours = DPanne::whereDay('DatePanne', '=' , Carbon::now()->day)->count();
        $pannes = Panne::all();
        $vehicules = Vehicule::all();
        $nbP = DPanne::count();
        $isa = Panne::max('id');
        
        return view('dpannes', [
            'dpannes' => $dpannes,
            'pannes' => $pannes,
            'vehicules' => $vehicules,
            'nbP' => $nbP,
            'mois' => $mois,
            'semaine' => $semaine,
            'jours' => $jours,
            'isa' => $isa
        ]);
    }

    public function create()
    {
        $dpannes = DPanne::all();
        $pannes = Panne::all();
        $vehicules = Vehicule::all();
        $max = DPanne::max('id');
        $d = Carbon::now();
        
        return view('addDPanne',[
            'dpannes' => $dpannes,
            'pannes' => $pannes,
            'vehicules' => $vehicules,
            'max' => $max,
            'd' => $d
        ]);
    }
    
    public function store(Request $request)
    {
        $z = $request->DatePanne;
        $y = Carbon::now(); 
        $e = '<h3 class="alert alert-danger" style="text-align : center; margin-top: 250px" >Il est impossible d\'entrer une panne dans le Futur</h3>';
        if ($z > $y){
            return $e;
        }else{
            $validateData = $request->validate([
                'vehicule_id' => 'required',
                'panne_id' => 'required',
                'DatePanne' => 'required',
                ]);
    
            DPanne::create($validateData);
    
            return redirect('/dpannes');
        
        }
    }

    public function show($id)
    {
        $dpanne = DPanne::findOrfail($id);

        return view('dpanne', [
            'dpanne' => $dpanne,
        ]);
    }

    public function edit($id)
    {
        $dpanne = DPanne::findOrfail($id);
        $vehicules = Vehicule::all();
        $pannes = Panne::all();
        $max = DB::table('d_pannes')->max('id');
        $date1 = Carbon::now();        
        
        return view('editDPanne', [
            'dpanne' => $dpanne,
            'vehicules' => $vehicules,
            'pannes' => $pannes,
            'max' => $max,
            'date1' => $date1
         ]);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'vehicule_id' => 'required',
            'panne_id' => 'required',
            'DatePanne' => 'required',
        ]);

        DPanne::whereId($id)->update($validateData);
        return redirect('/dpannes');
    }

    public function destroy($id)
    {
        $dpanne =DPanne::findOrfail($id);
        $dpanne->delete();

        return redirect('/dpannes');
    }
    
}
