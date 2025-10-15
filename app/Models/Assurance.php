<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assurance extends Model
{
    use HasFactory;

    protected $fillable = ['DateAssurance', 'Date_exp_Assurance', 'vehicule_id'];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
