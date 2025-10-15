<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
