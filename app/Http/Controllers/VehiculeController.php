<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Models\Vehicule;
use App\Services\VehiculeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VehiculeController extends Controller
{
    protected readonly VehiculeService $vehiculeService;

    public function __construct(VehiculeService $vehiculeService)
    {
        $this->middleware('auth');
        $this->vehiculeService = $vehiculeService;
    }

    public function index()
    {
        return view('features.vehicle.vehicle-information.vehicules', [
            'vehicules' => $this->vehiculeService->getAllVehicles(),
            'user' => Auth::user(),
            ...$this->vehiculeService->getDashboardStats()
        ]);
    }

    public function create()
    {
        $this->authorize('create', Vehicule::class);
        return view('features.vehicle.vehicle-information.create');
    }

    public function store(StoreVehicleRequest $request)
    {
        $this->vehiculeService->store($request->validated());
        return redirect()->route('principal');
    }

    public function show(int $id)
    {
        $date1 = Carbon::now();

        return view('features.vehicle.vehicle-information.vehicule', [
            'vehicule' => $this->vehiculeService->findById($id),
            'date1' => $date1,
        ]);
    }

    public function edit(int $id)
    {
        return view('features.vehicle.vehicle-information.edit', [
            'vehicule' => $this->vehiculeService->findById($id),
        ]);
    }

    public function update(UpdateVehicleRequest $request, int $id)
    {
        $this->vehiculeService->update($request->validated(), $id);
        return redirect()->route('principal');
    }

    public function destroy(int $id)
    {
        $this->vehiculeService->destroy($id);
        return redirect()->route('principal');
    }
}
