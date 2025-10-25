<?php

namespace App\Services;

use App\Repositories\VehiculeRepository;

class VehiculeService
{
    protected readonly VehiculeRepository $vehiculeRepository;

    public function __construct(VehiculeRepository $vehiculeRepository)
    {
        $this->vehiculeRepository = $vehiculeRepository;
    }

    public function getDashboardStats(): array
    {
        return [
            'vehiclesCount' => $this->vehiculeRepository->countVehicles(),
            'alertVehiclesCount' => $this->vehiculeRepository->countAlertVehicles(),
            'essenceVehiclesCount' => $this->vehiculeRepository->countEssenceVehicles(),
            'dieselVehiclesCount' => $this->vehiculeRepository->countDieselVehicles(),
        ];
    }

    public function getNextVehicleId() : int
    {
        $maxId = $this->vehiculeRepository->getLastVehicleId() ?? 0;
        return $maxId + 1;
    }
}
