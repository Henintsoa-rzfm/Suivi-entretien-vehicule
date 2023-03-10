<?php

namespace App\Models;

use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assurance extends Model
{
    use HasFactory;

    protected $fillable = ['DateAssurance', 'Date_exp_Assurance', 'vehicule_id'];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
