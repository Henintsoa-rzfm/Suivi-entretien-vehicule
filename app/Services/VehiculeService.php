<?php

namespace App\Services;

use App\Exceptions\VehiculeException;
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
        $this->validateRequiredFields($data);
        $this->validatePlaque($data);
        $this->validateDates($data);
        $this->validateEnergieAndConsommation($data);
        $this->validateCV($data);
        $this->validateKMActuel($data);
        $this->validateStringLengths($data);

        return $this->vehiculeRepository->store($data);
    }

    private function validateRequiredFields(array $data): void
    {
        $required = ['PlaqueImmatric', 'Vehicule', 'Energie', 'Consommation', 'CV', 'AnneeMenCirc', 'DateEntree', 'KMActuel'];
        foreach ($required as $field) {
            if (!isset($data[$field])) {
                throw new VehiculeException("Le champ {$field} est requis.");
            }
        }
    }

    private function validatePlaque(array $data): void
    {
        // Faux négatif
        if (Vehicule::where('PlaqueImmatric' , $data['PlaqueImmatric'])->exists()) {
            throw new VehiculeException('La plaque d\'immatriculation existe déjà.');
        }
        if (strlen($data['PlaqueImmatric']) < 1) {
            throw new VehiculeException('La plaque d\'immatriculation doit comporter au moins 1 caractère.');
        }
        if (strlen($data['PlaqueImmatric']) > 10) {
            throw new VehiculeException('La plaque d\'immatriculation ne peut pas dépasser 10 caractères.');
        }
    }

    private function validateDates(array $data): void
    {
        if (!strtotime($data['AnneeMenCirc']) || !strtotime($data['DateEntree'])) {
            throw new VehiculeException('Les champs AnneeMenCirc et DateEntree doivent être des dates valides.');
        }
        if ($data['AnneeMenCirc'] > now()) {
            throw new VehiculeException('L\'année de mise en circulation ne peut pas être dans le futur.');
        }
        if ($data['DateEntree'] > now()->toDateString()) {
            throw new VehiculeException('La date d\'entrée ne peut pas être dans le futur.');
        }
        if ($data['DateEntree'] < $data['AnneeMenCirc']) {
            throw new VehiculeException('La date d\'entrée doit être après l\'année de mise en circulation.');
        }
        if ($data['AnneeMenCirc'] < '1900-01-01') {
            throw new VehiculeException('L\'année de mise en circulation doit être après le 1er janvier 1900.');
        }
        if ($data['DateEntree'] < '1900-01-01') {
            throw new VehiculeException('La date d\'entrée doit être après le 1er janvier 1900.');
        }
    }

    private function validateEnergieAndConsommation(array $data): void
    {
        if (!in_array($data['Energie'], ['Essence', 'Diesel'])) {
            throw new VehiculeException('Le type d\'énergie doit être soit "Essence" soit "Diesel".');
        }
        if (!is_numeric($data['Consommation'])) {
            throw new VehiculeException('La consommation doit être un nombre.');
        }
        if ($data['Consommation'] < 0) {
            throw new VehiculeException('La consommation ne peut pas être négative.');
        }
        if ($data['Energie'] === 'Essence' && $data['Consommation'] > 20) {
            throw new VehiculeException('La consommation pour un véhicule essence doit être ≤ 20 L/100km.');
        }
        if ($data['Energie'] === 'Diesel' && $data['Consommation'] > 15) {
            throw new VehiculeException('La consommation pour un véhicule diesel doit être ≤ 15 L/100km.');
        }
    }

    private function validateCV(array $data): void
    {
        if (!is_numeric($data['CV'])) {
            throw new VehiculeException('La puissance en CV doit être un nombre.');
        }
        if ($data['CV'] < 1 || $data['CV'] > 1000) {
            throw new VehiculeException('La puissance en CV doit être comprise entre 1 et 1000.');
        }
    }

    private function validateKMActuel(array $data): void
    {
        if (!is_numeric($data['KMActuel'])) {
            throw new VehiculeException('Le kilométrage actuel doit être un nombre.');
        }
        if ($data['KMActuel'] < 0) {
            throw new VehiculeException('Le kilométrage actuel ne peut pas être négatif.');
        }
    }

    private function validateStringLengths(array $data): void
    {
        if (strlen($data['Vehicule']) < 1) {
            throw new VehiculeException('Le nom du véhicule doit comporter au moins 1 caractère.');
        }
        if (strlen($data['Vehicule']) > 255) {
            throw new VehiculeException('Le nom du véhicule ne peut pas dépasser 255 caractères.');
        }
    }

    public function findById(int $id): Vehicule
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
            'essenceVehiclesCount' => $essenceVehicleCount,
            'dieselVehiclesCount' => $dieselVehicleCount,
            'dieselVehiclePercentage' => $vehiclesCount > 0
                ? round($dieselVehicleCount * 100 / $vehiclesCount, 2) : 0,
            'essenceVehiclePercentage' => $vehiclesCount > 0
                ? round($essenceVehicleCount * 100 / $vehiclesCount, 2) : 0,
        ];
    }
}
