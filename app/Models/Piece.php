<?php

namespace App\Models;

use App\Models\Nombre;
use App\Models\Intervention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Piece extends Model
{
    use HasFactory;

    protected $fillable = ['Piece'];

    public function nombres()
    {
        return $this->hasMany(Nombre::class);
    }

    public function interventions()
    {
        return $this->belongsToMany(Intervention::class, 'nombres')->withPivot('Nombre');
    }
}
