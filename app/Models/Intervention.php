<?php

namespace App\Models;

use App\Models\Piece;
use App\Models\Nombre;
use App\Models\Vehicule;
use App\Models\Mecanicien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intervention extends Model
{
    use HasFactory;

    protected $fillable = ['nature', 'DateIntervention', 'lieuIntervention', 'Panne', 'mecanicien_id', 'vehicule_id', 'DateLimite', 'Validation'];

    public function mecanicien()
    {
        return $this->belongsTo(Mecanicien::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function pieces()
    {
        return $this->belongsToMany(Piece::class, 'nombres')->withPivot('Nombre');
    }

    public function nombres()
    {
        return $this->hasMany(Nombre::class);
    }
}
