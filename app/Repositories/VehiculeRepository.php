<?php

namespace App\Repositories;

use App\Models\Vehicule;
use Illuminate\Support\Facades\DB;

class VehiculeRepository
{
    protected readonly Vehicule $vehicules;

    public function __construct(Vehicule $vehicules)
    {
        $this->vehicules = $vehicules;
    }

    public function getAllVehicles()
    {
        return DB::table('vehicules')
                    ->select('vehicules.*')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    public function countAlertVehicles()
    {
        return DB::table('vehicules')
            ->join('contenirs', 'vehicules.id', 'contenirs.vehicule_id') 
            ->join('equipements','equipements.id','contenirs.equipement_id') 
            ->whereRaw('vehicules.KMActuel-contenirs.dernierKM >= equipements.kilometrageMax')
            ->select('vehicules.*', 'contenirs.designation')
            ->count('vehicules.id');
    }

    public function countVehicles()
    {
        return DB::table('vehicules')->count();
    }

    public function countEssenceVehicles()
    {
        return DB::table('vehicules')->where("Energie", "Essence")->count();
    }

    public function countDieselVehicles()
    {
        return DB::table('vehicules')->where("Energie", "Diesel")->count();
    }


}