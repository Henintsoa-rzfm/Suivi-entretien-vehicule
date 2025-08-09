<?php

namespace App\Services\Chauffeurs;

use Carbon\Carbon;
use App\Repositories\Interfaces\ChauffeurRepositoryInterface;

class ChauffeurService
{
    private ChauffeurRepositoryInterface $chauffeurRepository;

    public function __construct(ChauffeurRepositoryInterface $chauffeurRepository) {
        $this->chauffeurRepository = $chauffeurRepository;
    }

    public function getAllChauffeurs()
    {
        $chauffeurs = $this->chauffeurRepository->all();
        return $chauffeurs;
    }

    public function create(array $chauffeur)
    {
        return $this->chauffeurRepository->create($chauffeur);
    }

    public function update($id, array $data)
    {
        return $this->chauffeurRepository->update($id, $data);
    }

    public function find($id)
    {
        return $this->chauffeurRepository->find($id);
    }

    public function getNextId()
    {
        $chauffeurLastId = $this->chauffeurRepository->getMaxId();
        return $chauffeurLastId+1;
    }

    public function getDashboardStats()
    {
        return [
        'nbC'    => $this->chauffeurRepository->countWithoutAucun(),
        'mois'   => $this->chauffeurRepository->countByMonth(now()->month),
        'day'    => $this->chauffeurRepository->countByDay(now()->day),
        'semaine'=> $this->chauffeurRepository->countByWeek(
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
        ),
        ];
    }

}