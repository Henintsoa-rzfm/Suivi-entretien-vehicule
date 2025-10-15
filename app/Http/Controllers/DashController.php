<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Panne;
use App\Models\DPanne;
use App\Models\Nombre;
use App\Models\PieceN;
use App\Models\Visite;
use App\Models\Vehicule;
use App\Models\Assurance;
use App\Models\Equipement;
use App\Models\Intervention;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $mverina = DB::table('d_pannes')->join('pannes', 'd_pannes.panne_id', '=', 'pannes.id')->select('TypePanne')->groupBy('d_pannes.panne_id')->orderBy('panne_id', 'DESC')->Limit(1)->get();
        $panneMve = DB::table('d_pannes')->join('pannes', 'd_pannes.panne_id', '=', 'pannes.id')->select('TypePanne')->groupBy('d_pannes.panne_id')->orderBy('panne_id', 'DESC')->get();
        $user = Auth::user();
        $andro = Carbon::now();
        // $o = date('d', strtotime($andro));
        $o = $andro->day;
        $pannes = DPanne::all()->count();
        $todayPanne = DPanne::where('DatePanne', '=', $o)->count();
        $vehicules = Vehicule::count();
        $piecens = PieceN::count();
        $pns = Panne::count();
        $visites = Visite::count();
        // $vfaire = DB::table('visites')->where('DateLimite');
        $assurances = Assurance::count();
        $nbE = DB::table('vehicules')->where("Energie", "Essence")->count();
        $nbD = DB::table('vehicules')->where("Energie", "Diesel")->count();
        $interventions = Intervention::count();
        $entretiens = Equipement::count();
        $nombres = Nombre::count();
        $intE = DB::table('interventions')->whereIn('Validation',['En attente'])->count();
        $special = DB::table('vehicules')
        ->join('contenirs', 'vehicules.id', 'contenirs.vehicule_id') 
        ->join('equipements','equipements.id','contenirs.equipement_id') 
        ->whereRaw('vehicules.KMActuel-contenirs.dernierKM >= equipements.kilometrageMax')
        ->select('vehicules.*', 'contenirs.designation')
        ->count('vehicules.id');

        return view('dash', [
            
            
            'vehicules' => $vehicules,
            'pns' => $pns,
            'nbE' => $nbE,
            'nbD' => $nbD,
            'pannes' =>$pannes,
            'andro' => $andro,
            'todayPanne' => $todayPanne,
            'o' => $o,
            'interventions' => $interventions,
            'entretiens' => $entretiens,
            'piecens' => $piecens,
            'visites' => $visites,
            'nombres' => $nombres,
            'assurances' => $assurances,
            'user' => $user,
            'mverina' => $mverina,
            'panneMve' => $panneMve,
            'special' => $special,
            'intE' => $intE
            // 'vfaire' => $vfaire
        ]);
    }
}
