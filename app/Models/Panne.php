<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panne extends Model
{
    use HasFactory;

    protected $fillable = ['TypePanne'];

    public function intervention()
    {
        return $this->hasOne(Intervention::class);
    }

    public function vehicules()
    {
        return $this->belongsToMany(Vehicule::class, 'dpannes');
    }

    public function dpannes()
    {
        return $this->HasMany(DPanne::class);
    }
}
