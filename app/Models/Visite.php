<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;

    protected $fillable = ['DateVisite', 'Date_exp_Visite', 'vehicule_id'];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
