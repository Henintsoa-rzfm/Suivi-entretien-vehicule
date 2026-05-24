<?php

namespace App\Repositories;

use App\Models\Vehicule;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class VehiculeRepository
{
    public function getAllVehicles(): LengthAwarePaginator
    {
        return DB::table('vehicules')
            ->select('vehicules.*')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

    }

    public function store(array $data): Vehicule
    {
        return Vehicule::create($data);
    }

    public function findById(int $id): Vehicule
    {
        return Vehicule::findOrfail($id);
    }

    public function update(array $data, int $id): void
    {
        Vehicule::findOrfail($id)->update($data);
    }

    public function destroy(int $id): void
    {
        Vehicule::findOrFail($id)->delete();
    }

    public function countAlertVehicles(): int
    {
        return (int) DB::table('vehicules')
            ->join('contenirs', 'vehicules.id', 'contenirs.vehicule_id')
            ->join('equipements', 'equipements.id', 'contenirs.equipement_id')
            ->whereRaw('vehicules.KMActuel-contenirs.dernierKM >= equipements.kilometrageMax')
            ->select('vehicules.*', 'contenirs.designation')
            ->count('vehicules.id');
    }

    public function countVehicles(): int
    {
        return (int) Vehicule::count();
    }

    public function countEssenceVehicles(): int
    {
        return (int) Vehicule::essence()->count();
    }

    public function countDieselVehicles(): int
    {
        return (int) Vehicule::diesel()->count();
    }

}
