<?php
namespace App\Repositories;

use App\Models\Intervention;

class InterventionRepository
{
    public function getAllInterventions()
    {
        return Intervention::with('vehicule')
            ->latest()
            ->get();
    }

    public function countInterventions(): int
    {
        return (int) Intervention::count();
    }

    public function countInterventionsPendingStatus() : int
    {
        return (int) Intervention::whereIn('Validation', ['En attente'])
                ->count();
    }

    public function countInterventionsValidatedStatus() : int
    {
        return (int)Intervention::whereIn('Validation', ['Validée'])
                ->count();
    }

    public function countInterventionsFinishedStatus() : int
    {
        return (int) Intervention::whereIn('Validation', ['Validée'])
                ->count();
    }


}



?>
