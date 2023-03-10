<?php

namespace App\Models;

use App\Models\PieceN;
use App\Models\Contenir;
use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = ['designation', 'kilometrageMax'];

    public function contenir()
    {
        return $this->hasOne(Contenir::class);
    }
    public function vehicules()
    {
        return $this->belongsToMany(Vehicule::class, 'contenirs')->withPivot('dernierKM');
    }

    public function piece_n_ss()
    {
        return $this->hasMany(PieceN::class);
    }
}
