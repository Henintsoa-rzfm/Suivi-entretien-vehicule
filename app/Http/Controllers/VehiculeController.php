<?php

namespace App\Http\Controllers;

use App\Models\Contenir;
use App\Models\Vehicule;
use App\Repositories\VehiculeRepository;
use App\Services\VehiculeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class VehiculeController extends Controller
{
    protected readonly VehiculeService $vehiculeService;

    public function __construct(VehiculeService $vehiculeService)
    {
        $this->middleware('auth');
        $this->vehiculeService = $vehiculeService;
    }

    public function index(VehiculeRepository $vehiculesRepository)
    {
        $vehicules = $vehiculesRepository->getAllVehicles();

        $user = Auth::user();
        $stats = $this->vehiculeService->getDashboardStats();
        $eq = Contenir::count();

        return view('vehicules', [
            'vehicules' => $vehicules,
            'vehiclesCount' => $stats['vehiclesCount'],
            'alertVehiclesCount' => $stats['alertVehiclesCount'],
            'essenceVehiclesCount' => $stats['essenceVehiclesCount'],
            'dieselVehiclesCount' => $stats['dieselVehiclesCount'],
            'user' => $user,
            'eq' => $eq,
        ]);
    }

    public function create()
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $max = DB::table('vehicules')->max('id');

        return view('addvehicule', [
            'max' => $max,
        ]);
    }

    public function store(Request $request)
    {
        $a = $request->DateEntree;
        $b = $request->AnneeMenCirc;
        $c = Carbon::now();

        if ($a > $c || $b > $c) {
            return '<h3 class="alert alert-danger" style="text-align : center; margin-top: 250px" >La date d\'entrée ou la mise en circulation à verifier</h3>';
        } else {
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
            'date1' => $date1,
        ]);
    }

    public function edit($id)
    {
        $vehicule = Vehicule::findOrfail($id);

        return view('editVehicule', [
            'vehicule' => $vehicule,
        ]);
    }

    public function update(Request $request, $id)
    {
        $a = $request->DateEntree;
        $b = $request->AnneeMenCirc;
        $c = Carbon::now();

        if ($a > $c || $b > $c) {
            return '<h3 class="alert alert-danger" style="text-align : center; margin-top: 250px" >La date d\'entrée ou la mise en circulation à verifier</h3>';
        } else {
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
