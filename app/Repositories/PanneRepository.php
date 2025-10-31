<?php 
declare(strict_types=1);

namespace App\Repositories;

use App\Models\DPanne;

class PanneRepository 
{
    protected readonly DPanne $dPanne;
    
    public function __construct(DPanne $dPanne)
    {
        $this->dPanne = $dPanne;
    }

    public function countDPannes() : int
    {
        return (int)DPanne::all()->count();
    }
}

