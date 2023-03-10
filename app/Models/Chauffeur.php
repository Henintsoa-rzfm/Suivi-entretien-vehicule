<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chauffeur extends Model
{
    use HasFactory;

    protected $fillable = ['MatrCh', 'Chauffeur'];

    public function vehicule()
    {
        return $this->hasOne(Vehicule::class);
    }
}
