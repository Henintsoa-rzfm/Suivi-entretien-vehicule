<?php

namespace App\Models;

use App\Models\Panne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DPanne extends Model
{
    use HasFactory;

    protected $fillable = ['vehicule_id', 'panne_id', 'DatePanne'];


    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function panne()
    {
        return $this->belongsTo(Panne::class);
    }
}
