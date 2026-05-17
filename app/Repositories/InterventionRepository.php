<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class InterventionRepository
{
    public function getAllInterventions()
    {
        return DB::table('interventions')
            ->join('vehicules', 'interventions.vehicule_id', '=', 'vehicules.id')
            ->select('interventions.*', 'vehicules.PlaqueImmatric')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function countInterventions(): int
    {
        return (int) DB::table('interventions')->count();
    }

    public function countInterventionsPendingStatus() : int
    {
        return (int)DB::table('interventions')
                ->whereIn('Validation', ['En attente'])
                ->count();
    }

    public function countInterventionsValidatedStatus() : int
    {
        return (int)DB::table('interventions')
                ->whereIn('Validation', ['Validée'])
                ->count();
    }

    public function countInterventionsFinishedStatus() : int
    {
        return (int)DB::table('interventions')
                ->whereIn('Validation', ['Validée'])
                ->count();
    }


}



?>
