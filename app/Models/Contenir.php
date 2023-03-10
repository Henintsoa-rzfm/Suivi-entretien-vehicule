<?php

namespace App\Models;

use App\Models\Vehicule;
use App\Models\Equipement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contenir extends Model
{
    use HasFactory;

    protected $fillable = ['vehicule_id','equipement_id', 'dernierKM'];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }

}
