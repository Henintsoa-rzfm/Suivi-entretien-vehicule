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
        $vehiclesCount = $this->vehiculeRepository->countVehicles();
        $dieselVehicleCount = $this->vehiculeRepository->countDieselVehicles();
        $essenceVehicleCount = $this->vehiculeRepository->countEssenceVehicles();

        return [
            'vehiclesCount' => $vehiclesCount,
            'alertVehiclesCount' => $this->vehiculeRepository->countAlertVehicles(),
            'essenceVehiclesCount' => $this->vehiculeRepository->countEssenceVehicles(),
            'dieselVehiclesCount' => $dieselVehicleCount,
            'dieselVehiclePercentage' => $vehiclesCount > 0 ?
                round($dieselVehicleCount*100/$vehiclesCount, 2) : 0,
            'essenceVehiclePercentage' => $vehiclesCount > 0 ?
                round($essenceVehicleCount*100/$vehiclesCount, 2) : 0
        ];
    }

    public function getNextVehicleId() : int
    {
        $maxId = $this->vehiculeRepository->getLastVehicleId() ?? 0;
        return (int) $maxId + 1;
    }

}
