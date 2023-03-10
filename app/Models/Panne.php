<?php

namespace App\Models;

use App\Models\Vehicule;
use App\Models\Intervention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
