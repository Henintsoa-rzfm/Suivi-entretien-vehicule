<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Models\Contenir;
use App\Models\Vehicule;
use App\Repositories\VehiculeRepository;
use App\Services\VehiculeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        // $this->authorize('viewAny', Vehicule::class);
        $vehicules = $vehiculesRepository->getAllVehicles();

        $user = Auth::user();
        $stats = $this->vehiculeService->getDashboardStats();
        $eq = Contenir::count();

        return view('feature.vehicle.vehicle-information.vehicules', [
            'vehicules' => $vehicules,
            'vehiclesCount' => $stats['vehiclesCount'],
            'alertVehiclesCount' => $stats['alertVehiclesCount'],
            'essenceVehiclesCount' => $stats['essenceVehiclesCount'],
            'dieselVehiclesCount' => $stats['dieselVehiclesCount'],
            'dieselVehiclePercentage' => $stats['dieselVehiclePercentage'],
            'essenceVehiclePercentage' => $stats['essenceVehiclePercentage'],
            'user' => $user,
            'eq' => $eq,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Vehicule::class);
        $max = $this->vehiculeService->getNextVehicleId();

        return view('feature.vehicle.vehicle-information.create', [
            'max' => $max,
        ]);
    }

    public function store(StoreVehicleRequest $request)
    {
            Vehicule::create($request->validated());

            return redirect('/vehicules');
    }

    public function show($id)
    {
        $vehicule = Vehicule::findOrfail($id);
        $date1 = Carbon::now();

        return view('feature.vehicle.vehicle-information.vehicule', [
            'vehicule' => $vehicule,
            'date1' => $date1,
        ]);
    }

    public function edit($id)
    {
        $vehicule = Vehicule::findOrfail($id);

        return view('feature.vehicle.vehicle-information.edit', [
            'vehicule' => $vehicule,
        ]);
    }

    public function update(UpdateVehicleRequest $request, $id)
    {
            $validateData = $request->validated();
            Vehicule::whereId($id)->update($validateData);

            return redirect('/vehicules');
    }

    public function destroy($id)
    {
        $vehicule = Vehicule::findOrfail($id);
        $vehicule->delete();

        return redirect('/vehicules');
    }
}
