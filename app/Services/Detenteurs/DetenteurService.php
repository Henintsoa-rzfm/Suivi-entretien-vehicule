<?php

namespace App\Services\Detenteurs;

use Carbon\Carbon;
use App\Repositories\Interfaces\DetenteurRepositoryInterface;

class DetenteurService
{
    private DetenteurRepositoryInterface $detenteurRepository;

    public function __construct(DetenteurRepositoryInterface $detenteurRepository) {
        $this->detenteurRepository = $detenteurRepository;
    }

    public function getAllDetenteurs()
    {
        $detenteurs = $this->detenteurRepository->all();
        return $detenteurs;
    }

    public function create(array $detenteur)
    {
        return $this->detenteurRepository->create($detenteur);
    }

    public function update($id, array $data)
    {
        return $this->detenteurRepository->update($id, $data);
    }

    public function find($id)
    {
        return $this->detenteurRepository->find($id);
    }

    public function getNextId()
    {
        $detenteurLastId = $this->detenteurRepository->getMaxId();
        return $detenteurLastId+1;
    }

    public function getDashboardStats()
    {
        return [
            'nbD'        => $this->detenteurRepository->countWithoutAucun(),
            'mois'       => $this->detenteurRepository->countByMonth(now()->month),
            'day'        => $this->detenteurRepository->countByDay(now()->day),
            'semaine'    => $this->detenteurRepository->countByWeek(
                                Carbon::now()->startOfWeek(),
                                Carbon::now()->endOfWeek()
                            ),
        ];
    }

}