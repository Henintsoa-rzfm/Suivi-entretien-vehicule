<?php

namespace App\Models;

use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visite extends Model
{
    use HasFactory;

    protected $fillable = ['DateVisite', 'Date_exp_Visite', 'vehicule_id'];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
