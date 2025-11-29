<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\DPanne;
use App\Models\Equipement;
use App\Models\Intervention;
use App\Models\Nombre;
use App\Models\Panne;
use App\Models\PieceN;
use App\Models\Visite;
use App\Repositories\VehiculeRepository;
use App\Services\VehiculeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
{
    protected readonly VehiculeService $vehiculeService;

    public function __construct(VehiculeService $vehiculeService)
    {
        $this->middleware('auth');
        $this->vehiculeService = $vehiculeService;
    }

    public function index()
    {
        $mverina = DB::table('d_pannes')->join('pannes', 'd_pannes.panne_id', '=', 'pannes.id')
            ->select('TypePanne')->groupBy('d_pannes.panne_id')->orderBy('panne_id', 'DESC')->Limit(1)->get();
        $panneMve = DB::table('d_pannes')->join('pannes', 'd_pannes.panne_id', '=', 'pannes.id')
            ->select('TypePanne')->groupBy('d_pannes.panne_id')->orderBy('panne_id', 'DESC')->get();
        $user = Auth::user();
        $andro = Carbon::now();
        // $o = date('d', strtotime($andro));
        $o = $andro->day;
        $pannes = DPanne::all()->count();
        $todayPanne = DPanne::where('DatePanne', '=', $o)->count();
        $piecens = PieceN::count();
        $pns = Panne::count();
        $visites = Visite::count();
        $assurances = Assurance::count();
        $interventions = Intervention::count();
        $entretiens = Equipement::count();
        $nombres = Nombre::count();
        $intE = DB::table('interventions')->whereIn('Validation', ['En attente'])->count();
        $stats = $this->vehiculeService->getDashboardStats();

        return view('dash', [
            'vehicules' => $stats['vehiclesCount'],
            'pns' => $pns,
            'pannes' => $pannes,
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
            'alertVehiclesCount' => $stats['alertVehiclesCount'],
            'intE' => $intE,
        ]);

    }


}
