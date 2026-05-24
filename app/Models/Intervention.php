<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    protected $fillable = ['nature', 'DateIntervention', 'lieuIntervention', 'Panne', 'user_id', 'vehicule_id', 'DateLimite', 'Validation'];

    public function user()
    {
        return $this->belongsTo(User::class);
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
