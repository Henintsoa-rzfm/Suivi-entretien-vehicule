<?php

namespace App\Repositories;

use App\Models\Vehicule;
use Illuminate\Pagination\LengthAwarePaginator;
// use Illuminate\Pagination\LengthAwarePaginator;
// use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class VehiculeRepository
{
    protected readonly Vehicule $vehicules;

    public function __construct(Vehicule $vehicules)
    {
        $this->vehicules = $vehicules;
    }

    public function getAllVehicles(): LengthAwarePaginator
    {
        return DB::table('vehicules')
            ->select('vehicules.*')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

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
        return (int) DB::table('vehicules')->count();
    }

    public function countEssenceVehicles(): int
    {
        return (int) DB::table('vehicules')->where('Energie', 'Essence')->count();
    }

    public function countDieselVehicles(): int
    {
        return (int) DB::table('vehicules')->where('Energie', 'Diesel')->count();
    }

    public function getLastVehicleId() : ?int
    {
        return DB::table('vehicules')->max('id');
    }
}
