<?php

namespace App\Services;

use App\Models\Vehicule;
use App\Repositories\VehiculeRepository;

class VehiculeService
{
    protected readonly VehiculeRepository $vehiculeRepository;

    public function __construct(VehiculeRepository $vehiculeRepository)
    {
        $this->vehiculeRepository = $vehiculeRepository;
    }

    public function getAllVehicles()
    {
        return $this->vehiculeRepository->getAllVehicles();
    }

    public function store(array $data): Vehicule
    {
        return $this->vehiculeRepository->store($data);
    }

    public function findById(int $id) : Vehicule
    {
        return $this->vehiculeRepository->findById($id);
    }

    public function update(array $data, int $id): void
    {
         $this->vehiculeRepository->update($data, $id);
    }

    public function destroy(int $id): void
    {
        $this->vehiculeRepository->destroy($id);
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



}
