<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenir extends Model
{
    use HasFactory;

    protected $fillable = ['vehicule_id', 'equipement_id', 'dernierKM'];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
}
