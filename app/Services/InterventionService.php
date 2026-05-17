<?php

namespace App\Services;

use App\Repositories\InterventionRepository;

class InterventionService
{
    protected readonly InterventionRepository $interventionRepository;

    public function __construct(InterventionRepository $interventionRepository)
    {
        $this->interventionRepository = $interventionRepository;
    }

    public function getAllInterventions()
    {
        if ($this->interventionRepository->getAllInterventions()->isEmpty()) {
            return 'Aucune intervention trouvée.';
        }
        return $this->interventionRepository->getAllInterventions();
    }

    public function getInterventionsStats(): array
    {
        return [
            'pendingCount' => $this->interventionRepository->countInterventionsPendingStatus(),
            'validatedCount' => $this->interventionRepository->countInterventionsValidatedStatus(),
            'finishedCount' => $this->interventionRepository->countInterventionsFinishedStatus(),
            'totalCount' => $this->interventionRepository->countInterventions(),
        ];
    }
}
